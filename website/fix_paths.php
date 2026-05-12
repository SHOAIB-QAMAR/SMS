<?php
/**
 * fix_paths.php (REVISED)
 * Automatically converts all relative include/require paths to use $_SERVER['DOCUMENT_ROOT']
 * and fixes double quote issues from previous run.
 */

function fixPaths($dir) {
    $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    
    foreach ($files as $file) {
        if ($file->isDir() || $file->getExtension() !== 'php' || $file->getFilename() === 'fix_paths.php') {
            continue;
        }

        $filePath = $file->getRealPath();
        $content = file_get_contents($filePath);
        $modified = false;

        // 1. Fix double quotes from previous run
        // Example: include($_SERVER['DOCUMENT_ROOT'] . "/path.php""); -> include($_SERVER['DOCUMENT_ROOT'] . "/path.php");
        $tempContent = preg_replace('/(\$_SERVER\[\'DOCUMENT_ROOT\'\]\s*\.\s*[\'"][^\'"]+\.php)([\'"]{2})(\s*\)?)/i', '$1"$3', $content, -1, $count);
        if ($count > 0) {
            $content = $tempContent;
            $modified = true;
        }
        
        // Also handle the case where it might be .php"" without parenthesis
        $tempContent = preg_replace('/(\$_SERVER\[\'DOCUMENT_ROOT\'\]\s*\.\s*[\'"][^\'"]+\.php)([\'"]{2})/i', '$1"', $content, -1, $count);
        if ($count > 0) {
            $content = $tempContent;
            $modified = true;
        }

        // 2. Perform original conversion for any missed files (with better regex)
        $projectRoot = realpath(__DIR__);
        
        $newContent = preg_replace_callback('/(include|require)(_once)?(\s*\(?\s*)([\'"])([^\'"]+)(\4\s*\)?)/i', function($matches) use ($filePath, $projectRoot, &$modified) {
            $type = $matches[1] . $matches[2];
            $prefix = $matches[3];
            $quote = $matches[4];
            $path = $matches[5];
            $suffix = $matches[6];

            // Skip if it already uses DOCUMENT_ROOT or is an absolute path or is a remote path
            if (strpos($path, '$_SERVER') !== false || strpos($path, 'http') === 0 || strpos($path, '/') === 0 || strpos($matches[0], '$_SERVER') !== false) {
                return $matches[0];
            }

            // Calculate the absolute path of the included file
            $currentDir = dirname($filePath);
            $absolutePath = realpath($currentDir . DIRECTORY_SEPARATOR . $path);

            if ($absolutePath && strpos($absolutePath, $projectRoot) === 0) {
                $relativePathFromRoot = str_replace($projectRoot, '', $absolutePath);
                $relativePathFromRoot = str_replace('\\', '/', $relativePathFromRoot);
                
                $modified = true;
                // Return without adding extra quotes
                // If prefix had (, suffix should have )
                return "{$type}{$prefix}\$_SERVER['DOCUMENT_ROOT'] . \"{$relativePathFromRoot}\"";
            }

            return $matches[0];
        }, $content);

        if ($modified || $newContent !== $content) {
            file_put_contents($filePath, $newContent);
            echo "Fixed: $filePath\n";
        }
    }
}

echo "Starting path fixing (Revised)...\n";
fixPaths(__DIR__);
echo "Done!\n";

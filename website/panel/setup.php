<?php
/**
 * Automated Database Setup Script
 * School Management System
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Configuration - Pulling from the central database config
include_once $_SERVER['DOCUMENT_ROOT'] . "/database/db.php";
// The variables $host, $user, $password, and $db are now available from db.php
$server = $host; 

$config_path = __DIR__ . '/assets/config.php';
if (file_exists($config_path)) {
    $config_content = file_get_contents($config_path);
    if (preg_match('/\$server\s*=\s*["\'](.*)["\']/', $config_content, $matches))
        $server = $matches[1];
    if (preg_match('/\$user\s*=\s*["\'](.*)["\']/', $config_content, $matches))
        $user = $matches[1];
    if (preg_match('/\$password\s*=\s*["\'](.*)["\']/', $config_content, $matches))
        $password = $matches[1];
    if (preg_match('/\$db\s*=\s*["\'](.*)["\']/', $config_content, $matches))
        $db = $matches[1];
}

$status = "";
$message = "";
$details = [];

if (isset($_POST['install'])) {
    // 1. Connect to MySQL Server
    $conn = @mysqli_connect($server, $user, $password);

    if (!$conn) {
        $status = "error";
        $message = "Connection failed: " . mysqli_connect_error();
    } else {
        // 2. Create Database
        $sql_create_db = "CREATE DATABASE IF NOT EXISTS `$db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
        if (mysqli_query($conn, $sql_create_db)) {
            $details[] = "Database `$db` checked/created successfully.";

            // 3. Select Database
            mysqli_select_db($conn, $db);

            // 4. Import SQL File
            $sql_file = __DIR__ . '/database/_sms.sql';
            if (file_exists($sql_file)) {
                $sql_content = file_get_contents($sql_file);

                // Use multi_query to handle the dump
                if (mysqli_multi_query($conn, $sql_content)) {
                    do {
                        // Keep looping through results
                    } while (mysqli_next_result($conn));

                    if (mysqli_error($conn)) {
                        $status = "error";
                        $message = "Error during SQL execution: " . mysqli_error($conn);
                    } else {
                        $status = "success";
                        $message = "Database setup completed successfully!";
                        $details[] = "All tables and initial data imported.";
                    }
                } else {
                    $status = "error";
                    $message = "SQL execution failed: " . mysqli_error($conn);
                }
            } else {
                $status = "error";
                $message = "SQL file not found at $sql_file";
            }
        } else {
            $status = "error";
            $message = "Could not create database: " . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Setup | SMS</title>
    <!-- Inter Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --primary-hover: #4f46e5;
            --bg: #0f172a;
            --card-bg: rgba(30, 41, 59, 0.7);
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --success: #10b981;
            --error: #ef4444;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            background-image:
                radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.15) 0, transparent 50%),
                radial-gradient(at 100% 100%, rgba(168, 85, 247, 0.15) 0, transparent 50%);
            color: var(--text-main);
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .setup-card {
            background: var(--card-bg);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 40px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 8px;
            font-weight: 700;
            background: linear-gradient(to right, #818cf8, #c084fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        p.subtitle {
            color: var(--text-muted);
            margin-bottom: 32px;
        }

        .info-box {
            background: rgba(0, 0, 0, 0.2);
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 24px;
            font-size: 0.9rem;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .info-item:last-child {
            margin-bottom: 0;
        }

        .label {
            color: var(--text-muted);
        }

        .value {
            font-weight: 600;
            color: #fff;
        }

        .btn {
            background: var(--primary);
            color: white;
            border: none;
            padding: 14px 28px;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: all 0.2s;
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.4);
        }

        .btn:active {
            transform: translateY(0);
        }

        .result {
            margin-top: 24px;
            padding: 20px;
            border-radius: 12px;
            animation: slideIn 0.4s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .result.success {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: var(--success);
        }

        .result.error {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: var(--error);
        }

        .details {
            margin-top: 12px;
            font-size: 0.85rem;
            color: var(--text-muted);
            padding-left: 10px;
        }

        .footer-links {
            margin-top: 32px;
            text-align: center;
        }

        .footer-links a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="setup-card">
        <h1>Database Setup</h1>
        <p class="subtitle">Quickly initialize your school management database.</p>

        <div class="info-box">
            <div class="info-item">
                <span class="label">Host:</span>
                <span class="value"><?php echo htmlspecialchars($server); ?></span>
            </div>
            <div class="info-item">
                <span class="label">User:</span>
                <span class="value"><?php echo htmlspecialchars($user); ?></span>
            </div>
            <div class="info-item">
                <span class="label">Database:</span>
                <span class="value"><?php echo htmlspecialchars($db); ?></span>
            </div>
            <div class="info-item">
                <span class="label">SQL File:</span>
                <span class="value">database/_sms.sql</span>
            </div>
        </div>

        <?php if ($status === ""): ?>
            <form method="POST">
                <button type="submit" name="install" class="btn">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    Run Auto-Setup
                </button>
            </form>
        <?php endif; ?>

        <?php if ($status !== ""): ?>
            <div class="result <?php echo $status; ?>">
                <div style="font-weight: 700; display: flex; align-items: center; gap: 8px;">
                    <?php if ($status === "success"): ?>
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                    <?php else: ?>
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd"></path>
                        </svg>
                    <?php endif; ?>
                    <?php echo $message; ?>
                </div>

                <?php if (!empty($details)): ?>
                    <div class="details">
                        <?php foreach ($details as $detail): ?>
                            • <?php echo htmlspecialchars($detail); ?><br>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if ($status === "success"): ?>
                    <div style="margin-top: 20px;">
                        <a href="index.php" class="btn" style="text-decoration: none;">Go to Application</a>
                    </div>
                <?php else: ?>
                    <div style="margin-top: 20px;">
                        <button onclick="window.location.reload();" class="btn" style="background: rgba(255,255,255,0.1);">Try
                            Again</button>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="footer-links">
            <p style="font-size: 0.8rem; color: var(--text-muted);">
                Need help? <a href="mailto:support@oranbyte.com">Contact Support</a>
            </p>
        </div>
    </div>

</body>

</html>
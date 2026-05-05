<?php
session_start();

session_unset();
session_destroy();
header('Location: ../../anshi.php');
exit();
?>
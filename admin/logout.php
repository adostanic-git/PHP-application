<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

session_start();
session_unset();
session_destroy();
setcookie(session_name(), '', time() - 3600, '/');

header("Location: login.php");
exit();

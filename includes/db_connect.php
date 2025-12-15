<?php
// includes/db_connect.php

// Save current directory
$original_cwd = getcwd();

// Change to admin/config directory so includes work naturally
// We assume this file is in 'includes/' folder, so we go up one level then to admin/config
chdir(__DIR__ . '/../admin/config/');

// Include db.php
// This will load Config.php, custom.php, settings.php and create $conn
include 'db.php';

// Restore original directory
chdir($original_cwd);
?>

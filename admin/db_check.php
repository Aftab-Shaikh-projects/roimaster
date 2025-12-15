<?php
include_once 'config/custom.php';
// Config.php is likely included by custom.php

$con = new Config;
$conn = $con->db();

$res = mysqli_query($conn, "SHOW COLUMNS FROM properties LIKE 'roi'");
if (mysqli_num_rows($res) > 0) {
    echo "COLUMN_EXISTS";
} else {
    echo "COLUMN_MISSING";
}
?>

<?php
include 'config/custom.php';
// Config.php is already included in custom.php

$con = new Config;
$conn = $con->db();

$sql = "ALTER TABLE `properties` ADD COLUMN `price_high` DECIMAL(15,2) DEFAULT 0 AFTER `price`";

if (mysqli_query($conn, $sql)) {
    echo "Table 'properties' updated successfully with `price_high` column.";
} else {
    // Check if duplicate column error
    if (mysqli_errno($conn) == 1060) {
        echo "Column `price_high` already exists.";
    } else {
        echo "Error updating table: " . mysqli_error($conn);
    }
}
?>

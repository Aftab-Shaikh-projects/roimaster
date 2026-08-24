<?php
include 'config/custom.php';
include 'config/Config.php';

$con = new Config;
$conn = $con->db();

$sql = "ALTER TABLE `properties` 
ADD COLUMN `roi` VARCHAR(50) DEFAULT NULL AFTER `price`,
ADD COLUMN `city` VARCHAR(100) DEFAULT NULL AFTER `location`,
ADD COLUMN `sub_location` VARCHAR(100) DEFAULT NULL AFTER `city`,
ADD COLUMN `comm_type` VARCHAR(100) DEFAULT NULL AFTER `type`";

if (mysqli_query($conn, $sql)) {
    echo "Table 'properties' updated successfully with new columns.";
} else {
    echo "Error updating table: " . mysqli_error($conn);
}
?>

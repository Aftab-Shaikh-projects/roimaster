<?php
include 'config/custom.php'; // Assuming this sets up DB connection variables
include_once 'config/Config.php';

$con = new Config;
$conn = $con->db();

// Create Enquiries Table
$sql = "CREATE TABLE IF NOT EXISTS `property_enquiries` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `property_id` INT(11) NOT NULL,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `phone` VARCHAR(20) NOT NULL,
    `message` TEXT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if (mysqli_query($conn, $sql)) {
    echo "<h1>Table 'property_enquiries' created successfully.</h1>";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
?>

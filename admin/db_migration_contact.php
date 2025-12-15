<?php
include 'config/custom.php';
include_once 'config/Config.php';

$con = new Config;
$conn = $con->db();

// Create Contact Enquiries Table
$sql = "CREATE TABLE IF NOT EXISTS `contact_enquiries` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `phone` VARCHAR(20) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `subject` VARCHAR(100) NOT NULL COMMENT 'Interested In',
    `message` TEXT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if (mysqli_query($conn, $sql)) {
    echo "<h1>Table 'contact_enquiries' created successfully.</h1>";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
?>

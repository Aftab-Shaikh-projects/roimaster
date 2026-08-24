<?php
include 'config/custom.php';
// Database connection is needed, usually custom.php includes Config.php or similar, 
// but let's be safe and do what worked before.
include_once 'config/Config.php';

$con = new Config;
$conn = $con->db();

// Create Table
$sql = "CREATE TABLE IF NOT EXISTS `city_master` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `active` ENUM('Y','N') DEFAULT 'Y',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if (mysqli_query($conn, $sql)) {
    echo "<h1>Table 'city_master' created successfully.</h1>";
    
    // Insert Default Cities
    $cities = ['Mumbai', 'Pune', 'Delhi', 'Bangalore', 'Hyderabad'];
    foreach($cities as $city) {
        $check = mysqli_query($conn, "SELECT * FROM `city_master` WHERE `name`='$city'");
        if(mysqli_num_rows($check) == 0) {
            mysqli_query($conn, "INSERT INTO `city_master` (`name`) VALUES ('$city')");
            echo "Inserted: $city <br>";
        }
    }
    
} else {
    echo "<h1>Error creating table: " . mysqli_error($conn) . "</h1>";
}
?>

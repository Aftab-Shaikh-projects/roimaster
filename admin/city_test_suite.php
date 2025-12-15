<?php
include 'config/custom.php';
include_once 'config/Config.php';

$con = new Config;
$conn = $con->db();

echo "<h1>City Test Suite</h1>";

// 1. Truncate
mysqli_query($conn, "TRUNCATE TABLE `city_master`");
echo "Truncated table.<br>";

// 2. Insert Defaults (Lowercase)
$defaults = ['mumbai', 'pune', 'delhi'];
foreach($defaults as $d) {
    mysqli_query($conn, "INSERT INTO `city_master` (`name`) VALUES ('$d')");
}
echo "Inserted defaults.<br>";

// 3. Verify Defaults
$res = mysqli_query($conn, "SELECT * FROM `city_master`");
echo "Current Rows:<br>";
while($row = mysqli_fetch_assoc($res)) {
    echo $row['id'] . ": " . $row['name'] . "<br>";
}

// 4. Test Logic: Add 'Hyderabad' via simulated input
$city_new = 'Hyderabad';
$final_city = strtolower(trim($city_new)); // Logic from add_property.php

$chk = mysqli_query($conn, "SELECT * FROM `city_master` WHERE `name`='$final_city'");
if(mysqli_num_rows($chk) == 0) {
    mysqli_query($conn, "INSERT INTO `city_master` (`name`) VALUES ('$final_city')");
    echo "Inserted New: $final_city ($city_new cleaned)<br>";
} else {
    echo "New city already exists.<br>";
}

// 5. Final Verify
$res2 = mysqli_query($conn, "SELECT * FROM `city_master` WHERE `name`='hyderabad'");
if($row = mysqli_fetch_assoc($res2)) {
    if($row['name'] === 'hyderabad') {
        echo "<h2 style='color:green'>SUCCESS: 'hyderabad' found in lowercase.</h2>";
    } else {
        echo "<h2 style='color:red'>FAILURE: Found '".$row['name']."'</h2>";
    }
} else {
    echo "<h2 style='color:red'>FAILURE: 'hyderabad' not found.</h2>";
}
?>

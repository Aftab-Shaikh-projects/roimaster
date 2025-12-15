<?php
include 'config/custom.php';
// Include Config.php directly if needed
include_once 'config/Config.php';

$con = new Config;
$conn = $con->db();

echo "<h1>Testing City Storage Logic</h1>";

// Simulate Post Data
$city_input = 'Other';
$city_new = 'Hyderabad';

if($city_input == 'Other' && !empty($city_new)) {
    // Logic from form
    $final_city = strtolower(trim($city_new));
    
    // Add to City Master if not exists
    $chk_city = mysqli_query($conn, "SELECT * FROM `city_master` WHERE `name`='$final_city'");
    if(mysqli_num_rows($chk_city) == 0) {
        mysqli_query($conn, "INSERT INTO `city_master` (`name`) VALUES ('$final_city')");
        echo "<p>Inserted '$final_city' into city_master.</p>";
    } else {
        echo "<p>'$final_city' already exists in city_master.</p>";
    }
    
    // Check DB manually now
    $check_db = mysqli_query($conn, "SELECT * FROM `city_master` WHERE `name`='$final_city'");
    if($row = mysqli_fetch_assoc($check_db)) {
        echo "<p>Verification: Found '".$row['name']."' in DB (Should be lowercase).</p>";
        if($row['name'] === 'hyderabad') {
             echo "<h2 style='color:green'>SUCCESS: Lowecase Storage Confirmed</h2>";
        } else {
             echo "<h2 style='color:red'>FAILURE: Storage Case Mismatch</h2>";
        }
    }
}
?>

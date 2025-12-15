<?php
header('Content-Type: text/plain');
include 'config/custom.php';
include_once 'config/Config.php';

$con = new Config;
$conn = $con->db();

echo "Current City List:\n";
$res = mysqli_query($conn, "SELECT * FROM `city_master`");
while($row = mysqli_fetch_assoc($res)) {
    echo $row['id'] . ": " . $row['name'] . "\n";
}
?>

<?php
include 'config/custom.php'; // Includes Config.php
$con = new Config;
$conn = $con->db();

echo "<h1>Testing City Fetch Logic</h1>";

$city_sql = "SELECT * FROM `city_master` WHERE `active`='Y' ORDER BY `name` ASC";
$city_res = mysqli_query($conn, $city_sql);

if(mysqli_num_rows($city_res) > 0) {
    echo "<select>";
    while($row = mysqli_fetch_assoc($city_res)) {
        echo "<option value='".$row['name']."'>".$row['name']."</option>";
    }
    echo "</select>";
    echo "<p>Success: Cities fetched.</p>";
} else {
    echo "<p>Failure: No cities found.</p>";
}
?>

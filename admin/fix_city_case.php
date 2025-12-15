<?php
include 'config/custom.php';
include_once 'config/Config.php';

$con = new Config;
$conn = $con->db();

echo "<h1>Fixing City Capitalization</h1>";

$res = mysqli_query($conn, "SELECT * FROM `city_master`");
while($row = mysqli_fetch_assoc($res)) {
    $id = $row['id'];
    $name = $row['name'];
    $lower_name = strtolower(trim($name));
    
    if($name !== $lower_name) {
        mysqli_query($conn, "UPDATE `city_master` SET `name`='$lower_name' WHERE `id`='$id'");
        echo "Updated '$name' to '$lower_name'<br>";
    }
}
echo "<h3>Done. All cities are now lowercase.</h3>";
?>

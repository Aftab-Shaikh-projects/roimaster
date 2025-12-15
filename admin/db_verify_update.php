<?php
// Include DB (ignore HTML output)
include 'config/db.php';

// Add Columns (Suppress errors if they exist)
$sqls = [
    "ALTER TABLE `properties` ADD COLUMN `roi` VARCHAR(50) DEFAULT NULL AFTER `price`",
    "ALTER TABLE `properties` ADD COLUMN `city` VARCHAR(100) DEFAULT NULL AFTER `location`",
    "ALTER TABLE `properties` ADD COLUMN `sub_location` VARCHAR(100) DEFAULT NULL AFTER `city`",
    "ALTER TABLE `properties` ADD COLUMN `comm_type` VARCHAR(100) DEFAULT NULL AFTER `type`"
];

foreach($sqls as $sql) {
    mysqli_query($conn, $sql);
}

// Verify
$needed = ['roi', 'city', 'sub_location', 'comm_type'];
$missing = [];

$res = mysqli_query($conn, "SHOW COLUMNS FROM properties");
$existing = [];
while($row = mysqli_fetch_assoc($res)) {
    $existing[] = $row['Field'];
}

foreach($needed as $n) {
    if(!in_array($n, $existing)) $missing[] = $n;
}

echo "<br><br><br><h1>MIGRATION STATUS</h1>";
if(empty($missing)) {
    echo "<h1>SUCCESS: All columns exist</h1>";
} else {
    echo "<h1>FAILURE: Missing columns: " . implode(', ', $missing) . "</h1>";
    echo "<p>MySQL Error: " . mysqli_error($conn) . "</p>";
}
?>

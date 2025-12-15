<?php
include '../config/custom.php';
// Include Config.php directly if needed or via settings if preferred in this project structure
// Assuming standard structure:
include '../config/Config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // CSRF Check (Assuming Config::checkCsrf() exists and works)
    if (!Config::checkCsrf()) {
        set_alert("Form validation expired!", "danger", "");
        Config::redirect("../city_list.php");
        exit;
    }

    $con = new Config;
    $conn = $con->db();
    
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    
    if ($action == 'add') {
        $name = strtolower(trim(res($_POST['name'])));
        
        if (!empty($name)) {
            $check = mysqli_query($conn, "SELECT * FROM `city_master` WHERE `name`='$name'");
            if (mysqli_num_rows($check) > 0) {
                set_alert("City already exists!", "danger", "");
            } else {
                $sql = "INSERT INTO `city_master` (`name`) VALUES ('$name')";
                if (mysqli_query($conn, $sql)) {
                    set_alert("City added successfully!", "success", "");
                } else {
                    set_alert("Database error!", "danger", "");
                }
            }
        } else {
            set_alert("City name is required!", "danger", "");
        }
        
    } elseif ($action == 'delete') {
        $id = res($_POST['delete_id']);
        if (!empty($id)) {
            $sql = "DELETE FROM `city_master` WHERE `id`='$id'";
            if (mysqli_query($conn, $sql)) {
                set_alert("City deleted successfully!", "success", "");
            } else {
                set_alert("Database error!", "danger", "");
            }
        }
    }
    
    Config::redirect("../city_list.php");
    exit;
}
?>

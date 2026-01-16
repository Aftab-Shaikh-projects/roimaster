<?php

include "../config/vary_con.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. Get Data
    $id = $_POST['id'];
    $status = $_POST['status'];
    
    // 2. Security Check
    $id = mysqli_real_escape_string($conn, $id);
    $status = mysqli_real_escape_string($conn, $status);

    // 3. Update Query
    $sql = "UPDATE `video_consultations` SET `status` = '$status' WHERE `id` = '$id'";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['msg'] = "Status updated to <strong>$status</strong> successfully!";
        $_SESSION['msg_type'] = "success";
    } else {
        $_SESSION['msg'] = "Error updating status.";
        $_SESSION['msg_type'] = "danger";
    }

    // 4. Redirect back to list page
    // Change 'video_requests.php' to whatever your main file name is
    header("Location: ../video_requests.php");
    exit();
}
?>
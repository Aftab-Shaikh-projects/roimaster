<?php

include '../admin/config/custom.php';
include_once '../admin/config/Config.php';



$con = new Config;
$conn = $con->db();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

    $prop_id = mysqli_real_escape_string($conn, $_POST['property_id']);
  
    
    $name    = mysqli_real_escape_string($conn, trim($_POST['name']));
    $mobile  = mysqli_real_escape_string($conn, trim($_POST['mobile']));
    $email   = mysqli_real_escape_string($conn, trim($_POST['email']));
    $vc_date = mysqli_real_escape_string($conn, trim($_POST['vc_date']));
    $vc_time = mysqli_real_escape_string($conn, trim($_POST['vc_time']));
    $remark  = mysqli_real_escape_string($conn, trim($_POST['remark']));

    if (empty($name) || empty($mobile) || empty($vc_date) || empty($vc_time)) {
        $_SESSION['alert'] = [
            'type' => 'warning',
            'title' => 'Missing Information',
            'message' => 'Please fill all required fields (Name, Mobile, Date, Time).'
        ];
        echo "<script>window.history.back();</script>";
        exit;
    }

 
    $sql = "INSERT INTO `video_consultations` (`property_id`, `name`, `mobile`, `email`, `vc_date`, `vc_time`, `remark`) 
            VALUES ('$prop_id', '$name', '$mobile', '$email', '$vc_date', '$vc_time', '$remark')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['alert'] = [
            'type' => 'success',
            'title' => 'Request Received',
            'message' => 'Video Presentation Request Sent Successfully! Our team will confirm the time shortly.'
        ];
        
        header("Location: ../property-details.php?id=".base64_encode(base64_encode($prop_id))); 
        exit;
    } else {
        $_SESSION['alert'] = [
            'type' => 'error',
            'title' => 'System Error',
            'message' => 'Something went wrong. Please try again later.'
        ];
        echo "<script>window.history.back();</script>";
        exit;
    }
} else {

    header("Location: ../index.php");
}
?>
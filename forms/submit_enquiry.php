<?php
include '../admin/config/custom.php';
include_once '../admin/config/Config.php';

$con = new Config;
$conn = $con->db();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize Input
    $property_id = mysqli_real_escape_string($conn, $_POST['property_id']);
    $name = mysqli_real_escape_string($conn, trim($_POST['name']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $phone = mysqli_real_escape_string($conn, trim($_POST['phone']));
    $message = mysqli_real_escape_string($conn, trim($_POST['message']));
    $Date = mysqli_real_escape_string($conn, trim($_POST['Date']));

    // Validation (Basic)
    if (empty($name) || empty($email) || empty($phone)) {
        $_SESSION['alert'] = [
            'type' => 'warning',
            'title' => 'Missing Definition',
            'message' => 'Please fill all required fields (Name, Email, Phone).'
        ];
        echo "<script>window.history.back();</script>";
        exit;
    }

    // Insert Query
    $sql = "INSERT INTO `property_enquiries` (`property_id`, `name`, `email`, `phone`, `message`, `Date`) 
            VALUES ('$property_id', '$name', '$email', '$phone', '$message','$Date')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['alert'] = [
            'type' => 'success',
            'title' => 'Enquiry Received',
            'message' => 'Thank you! Our premium sales team will contact you shortly.'
        ];
        header("Location: ../property-details.php?id=".base64_encode(base64_encode($property_id))); // Double Encode to match logic
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
    // Direct Access Block
    header("Location: ../index.php");
}
?>

<?php
include '../admin/config/custom.php'; // Include session via custom file or manually

// Ensure session is started if not already
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once '../admin/config/Config.php';

$con = new Config;
$conn = $con->db();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize Input (mysqli_real_escape_string requires active link)
    $name = isset($_POST['name']) ? mysqli_real_escape_string($conn, trim($_POST['name'])) : '';
    $phone = isset($_POST['phone']) ? mysqli_real_escape_string($conn, trim($_POST['phone'])) : '';
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, trim($_POST['email'])) : '';
    $subject = isset($_POST['subject']) ? mysqli_real_escape_string($conn, trim($_POST['subject'])) : 'General';
    $message = isset($_POST['message']) ? mysqli_real_escape_string($conn, trim($_POST['message'])) : '';

    // Validation (Basic)
    if (empty($name) || empty($phone) || empty($email)) {
        $_SESSION['alert'] = [
            'type' => 'warning',
            'title' => 'Incomplete Form',
            'message' => 'Please provide your Name, Phone Number, and Email.'
        ];
        echo "<script>window.history.back();</script>";
        exit;
    }

    // Insert Query
    $sql = "INSERT INTO `contact_enquiries` (`name`, `email`, `phone`, `subject`, `message`) 
            VALUES ('$name', '$email', '$phone', '$subject', '$message')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['alert'] = [
            'type' => 'success',
            'title' => 'Message Sent',
            'message' => 'Thank you for contacting ROIMaster. We will get back to you shortly.'
        ];
        header("Location: ../contact.php");
        exit;
    } else {
        $_SESSION['alert'] = [
            'type' => 'error',
            'title' => 'System Error',
            'message' => 'Could not send message. Please try again later.'
        ];
        echo "<script>window.history.back();</script>";
        exit;
    }
} else {
    // Direct Access Block
    header("Location: ../index.php");
}
?>

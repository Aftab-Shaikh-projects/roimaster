<?php
// Ensure session is started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include '../admin/config/custom.php';
include_once '../admin/config/Config.php';

// LOAD THE CONFIG FILE HERE
require_once 'mail_config.php'; 

$con = new Config;
$conn = $con->db();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Sanitize Inputs
    $prop_id = mysqli_real_escape_string($conn, $_POST['property_id']);
    $name    = mysqli_real_escape_string($conn, trim($_POST['name']));
    $mobile  = mysqli_real_escape_string($conn, trim($_POST['mobile']));
    $email   = mysqli_real_escape_string($conn, trim($_POST['email']));
    $vc_date = mysqli_real_escape_string($conn, trim($_POST['vc_date']));
    $vc_time = mysqli_real_escape_string($conn, trim($_POST['vc_time']));
    $remark  = mysqli_real_escape_string($conn, trim($_POST['remark']));

    // Validation
    if (empty($name) || empty($mobile) || empty($vc_date) || empty($vc_time)) {
        $_SESSION['alert'] = [
            'type' => 'warning',
            'title' => 'Missing Information',
            'message' => 'Please fill all required fields (Name, Mobile, Date, Time).'
        ];
        echo "<script>window.history.back();</script>";
        exit;
    }

    // --- FETCH PROPERTY TITLE ---
    $prop_sql = "SELECT `title` FROM `properties` WHERE `id` = '$prop_id'";
    $prop_res = mysqli_query($conn, $prop_sql);
    
    if($prop_row = mysqli_fetch_assoc($prop_res)) {
        $property_title = $prop_row['title'];
    } else {
        $property_title = "Unknown Property (ID: $prop_id)";
    }
    // ----------------------------

    // Insert Query
    $sql = "INSERT INTO `video_consultations` (`property_id`, `name`, `mobile`, `email`, `vc_date`, `vc_time`, `remark`) 
            VALUES ('$prop_id', '$name', '$mobile', '$email', '$vc_date', '$vc_time', '$remark')";

    if (mysqli_query($conn, $sql)) {
        
        // --- EMAIL SENDING LOGIC ---
        
        $clean_name = stripslashes($name);
        $clean_remark = stripslashes($remark);

        // --- FIX: CONVERT TIME TO AM/PM ---
        // strtotime converts "14:30" to a timestamp
        // date("h:i A") converts timestamp to "02:30 PM"
        $formatted_time = date("h:i A", strtotime($vc_time));
        // ----------------------------------

        $subject = "Video Request: " . $property_title;
        
        $email_body = "
        <div style='background-color: #f4f6f8; font-family: Helvetica, Arial, sans-serif; padding: 40px 0;'>
            <div style='max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05);'>
                
                <div style='background-color: #06142E; padding: 30px; text-align: center;'>
                    <h2 style='color: #C5A47E; margin: 0; font-size: 24px; letter-spacing: 1px; text-transform: uppercase;'>New Video Request</h2>
                    <p style='color: #8c9bb5; margin: 5px 0 0 0; font-size: 13px;'>Live Tour Enquiry</p>
                </div>

                <div style='padding: 30px 40px;'>
                    <p style='color: #555555; font-size: 16px; margin-bottom: 20px; line-height: 1.5;'>
                        You have received a new video presentation request for <strong>$property_title</strong>.
                    </p>
                    
                    <table style='width: 100%; border-collapse: separate; border-spacing: 0;'>
                        <tr>
                            <td style='padding: 12px 0; border-bottom: 1px solid #eeeeee; color: #888888; width: 35%; font-size: 14px;'>Property Name</td>
                            <td style='padding: 12px 0; border-bottom: 1px solid #eeeeee; color: #333333; font-weight: bold; font-size: 14px;'>$property_title</td>
                        </tr>
                        <tr>
                            <td style='padding: 12px 0; border-bottom: 1px solid #eeeeee; color: #888888; font-size: 14px;'>Client Name</td>
                            <td style='padding: 12px 0; border-bottom: 1px solid #eeeeee; color: #333333; font-weight: bold; font-size: 14px;'>$clean_name</td>
                        </tr>
                        <tr>
                            <td style='padding: 12px 0; border-bottom: 1px solid #eeeeee; color: #888888; font-size: 14px;'>Mobile</td>
                            <td style='padding: 12px 0; border-bottom: 1px solid #eeeeee; color: #333333; font-weight: bold; font-size: 14px;'><a href='tel:$mobile' style='color: #06142E; text-decoration: none;'>$mobile</a></td>
                        </tr>
                        <tr>
                            <td style='padding: 12px 0; border-bottom: 1px solid #eeeeee; color: #888888; font-size: 14px;'>Email</td>
                            <td style='padding: 12px 0; border-bottom: 1px solid #eeeeee; color: #333333; font-size: 14px;'>$email</td>
                        </tr>
                        <tr>
                            <td style='padding: 12px 0; border-bottom: 1px solid #eeeeee; color: #888888; font-size: 14px;'>Preferred Date</td>
                            <td style='padding: 12px 0; border-bottom: 1px solid #eeeeee; color: #333333; font-size: 14px;'>$vc_date</td>
                        </tr>
                        <tr>
                            <td style='padding: 12px 0; border-bottom: 1px solid #eeeeee; color: #888888; font-size: 14px;'>Preferred Time</td>
                            <td style='padding: 12px 0; border-bottom: 1px solid #eeeeee; color: #333333; font-size: 14px;'>$formatted_time</td>
                        </tr>
                        <tr>
                            <td colspan='2' style='padding: 20px 0 10px 0; color: #888888; font-size: 14px;'>Remark / Questions:</td>
                        </tr>
                        <tr>
                            <td colspan='2' style='padding: 15px; background-color: #f9f9f9; border-radius: 5px; color: #555555; font-size: 14px; line-height: 1.6; font-style: italic;'>
                                \"$clean_remark\"
                            </td>
                        </tr>
                    </table>

                    <div style='margin-top: 30px; text-align: center;'>
                        <a href='mailto:$email' style='background-color: #C5A47E; color: #06142E; text-decoration: none; padding: 12px 25px; border-radius: 4px; font-weight: bold; font-size: 14px; display: inline-block;'>Reply to Client</a>
                    </div>
                </div>

                <div style='background-color: #f0f0f0; padding: 20px; text-align: center; border-top: 1px solid #e0e0e0;'>
                    <p style='margin: 0; color: #999999; font-size: 12px;'>&copy; " . date('Y') . " Your Real Estate Company. All rights reserved.</p>
                </div>
            </div>
        </div>
        ";

        // Send Email
        sendSMTPMail($_POST['email'], $_POST['name'], $subject, $email_body);

        // --- END EMAIL SENDING LOGIC ---

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
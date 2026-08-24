<?php
include "../config/vary_con.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST['id']) && isset($_POST['prop_id'])) {
        $id = res(dec($_POST['id']));
        $prop_id = res(dec($_POST['prop_id']));

        // Get File Path
        $sql = "SELECT image_path FROM `property_gallery` WHERE `id` = '$id'";
        $res = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            $path = $row['image_path'];
            
            // Delete record
            $del_sql = "DELETE FROM `property_gallery` WHERE `id` = '$id'";
            if (mysqli_query($conn, $del_sql)) {
                // Delete File (Need to handle relative path cleanly)
                // Path stored: "admin/uploads/gallery/..."
                // Current script: "admin/forms/delete...php"
                // File system path needs to be resolved.
                // admin folder is parent of forms.
                // so we need to go up from forms (../) then enter admin (which we are in parent of forms), wait.
                // If path is "admin/uploads/...", 
                // Script is in "c:/.../admin/forms/"
                // Root is "c:/.../admin/" (parent of forms)
                // If path starts with "admin/", we need to go up two levels? No.
                // Let's assume path is relative to Site Root "roimaster/".
                // So from "admin/forms/", we go "../../" to reach "roimaster/", then append "admin/uploads...".
                
                $file_sys_path = "../../" . $path;
                if (file_exists($file_sys_path)) {
                    unlink($file_sys_path);
                }
                
                set_alert("Image Deleted Successfully", "success", "");
            } else {
                set_alert("Database Error", "danger", "");
            }
        } else {
             set_alert("Image not found", "danger", "");
        }
        
        Config::redirect("../view_property.php?id=" . enc($prop_id));
        
    } else {
        Config::redirect("../property_list.php");
    }
}
?>

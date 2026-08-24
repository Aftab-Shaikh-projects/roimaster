<?php
include "../config/vary_con.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (!isset($_POST['prop_id']) || empty($_POST['prop_id'])) {
         set_alert("Invalid Request", "danger", "");
         Config::redirect("../property_list.php");
    }

    $prop_id = res(dec($_POST['prop_id']));
    $target_dir = "../uploads/gallery/";
    
    // Create Dir if not exists
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $upload_count = 0;
    $errors = [];

    // Loop through files
    if (isset($_FILES['gallery_images'])) {
        $total_files = count($_FILES['gallery_images']['name']);

        for ($i = 0; $i < $total_files; $i++) {
            $file_name = $_FILES['gallery_images']['name'][$i];
            $file_tmp = $_FILES['gallery_images']['tmp_name'][$i];
            $file_error = $_FILES['gallery_images']['error'][$i];

            if ($file_error === 0) {
                $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

                if (in_array($file_ext, $allowed)) {
                    $new_name = uniqid('IMG_', true) . '.' . $file_ext;
                    $target_file = $target_dir . $new_name;
                    $db_path = "uploads/gallery/" . $new_name; // Path stored in DB relative to admin root or absolute? Usually relative if displaying from admin. Wait, frontend needs access.
                    // Frontend is in ../../, so typical best practice is to store full URL or consistent relative path.
                    // Let's store full URL for simplicity in both Admin and Frontend usage, OR relative to project root.
                    // Actually, simpler: store "admin/uploads/gallery/filename" if accessed from root, or just "uploads/gallery/filename" if served from admin.
                    // To be safe and compatible with the current setup where image URLs were full strings, I will store the relative path from the domain root "admin/uploads/gallery/..."
                    // But wait, the previous images were external URLs.
                    // Let's store "admin/uploads/gallery/$new_name" and prefix with domain if needed, or just let it be.
                    
                    
                    if (move_uploaded_file($file_tmp, $target_file)) {
                        // Insert into DB
                        // Storing path accessible from web root: "admin/uploads/gallery/..."
                        // Since this file is in admin/forms/, target_dir is ../uploads.
                        // We want to store "admin/uploads/gallery/filename.jpg"
                        $web_path = "admin/uploads/gallery/" . $new_name; 
                        
                        // BUT, if user is in "client/roimaster/roimaster/", checking from there...
                        // Let's just store the relative path "admin/uploads/gallery/" and handle the prefix in frontend if needed.
                        // Actually, better: if the frontend properties.php is in "roimaster/", valid path is "admin/uploads/gallery/..."
                        
                        $sql = "INSERT INTO `property_gallery` (`property_id`, `image_path`) VALUES ('$prop_id', '$web_path')";
                        mysqli_query($conn, $sql);
                        $upload_count++;
                    } else {
                        $errors[] = "$file_name: Upload failed";
                    }
                } else {
                    $errors[] = "$file_name: Invalid file type";
                }
            }
        }
    }

    if ($upload_count > 0) {
        set_alert("$upload_count images uploaded successfully", "success", "");
    } else {
        set_alert("No images uploaded", "warning", implode(", ", $errors));
    }
    
    Config::redirect("../view_property.php?id=" . enc($prop_id));
}
?>

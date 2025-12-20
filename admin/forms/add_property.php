<?php
include "../config/vary_con.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (isset($_POST["delete_id"])) {
    // DELETE
    $delete_id = res(dec($_POST["delete_id"]));
    $sql = "DELETE FROM `properties` WHERE `id`='$delete_id'";
    if (mysqli_query($conn, $sql)) {
      set_alert("Property Deleted Successfully", "success", "");
      Config::redirect("../property_list.php");
    } else {
      set_alert("Something went wrong!", "danger", "Data not deleted.");
      Config::redirect("../property_list.php");
    }
  } else if (isset($_POST["activate_id"])) {
    // TOGGLE STATUS (Example logic)
    $activate_id = res(dec($_POST["activate_id"]));
    // Assume we toggle or set to active. For now just set active
    $sql = "UPDATE `properties` SET `active`='Y' WHERE `id`='$activate_id'";

    if (mysqli_query($conn, $sql)) {
      set_alert("Property Activated Successfully", "success", "");
      Config::redirect("../property_list.php");
    } else {
      set_alert("Something went wrong!", "danger", "Data not updated.");
      Config::redirect("../property_list.php");
    }
  } else {
    // ADD / EDIT
    $title = res($_POST["title"]);
    $price = res($_POST["price"]);
    $price_high = isset($_POST["price_high"]) ? res($_POST["price_high"]) : 0;
    // Auto-construct Location string for DB (Standardized format)
    // We do this AFTER resolving city logic below
    
    $bhk = res($_POST["bhk"]);
    $area = res($_POST["area"]);
    $type = res($_POST["type"]);
    $possession = res($_POST["possession"]);
    $map_url = res($_POST["map_url"]);
    $description = res($_POST["description"]);
    $features = res($_POST["features"]); 
    $active = res($_POST["active"]);
    
    // New Fields
    $roi = res($_POST["roi"]);
    
    // City Logic
    $city_input = res($_POST["city"]);
    $city_new = isset($_POST["city_new"]) ? res($_POST["city_new"]) : '';
    
    if($city_input == 'Other' && !empty($city_new)) {
        // Use the new city name
        $final_city = strtolower(trim($city_new));
        
        // Add to City Master if not exists
        $chk_city = mysqli_query($conn, "SELECT * FROM `city_master` WHERE `name`='$final_city'");
        if(mysqli_num_rows($chk_city) == 0) {
            mysqli_query($conn, "INSERT INTO `city_master` (`name`) VALUES ('$final_city')");
        }
        
        $city = $final_city;
    } else {
        // Use selected city
        $city = strtolower(trim($city_input));
    }

    $sub_location = res($_POST["sub_location"]);
    $location = ucwords($sub_location) . ", " . ucwords($city); // Auto-generate location
    $comm_type = res($_POST["comm_type"]);

    // Handle Image Upload
    $image = "";
    if (isset($_POST['old_image'])) {
        $image = res($_POST['old_image']);
    }

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $upload_dir = "../uploads/properties/";
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        $file_name = $_FILES['image']['name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'mp4', 'webm'];
        
        if (in_array($file_ext, $allowed)) {
            $new_name = uniqid('PROP_', true) . '.' . $file_ext;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $new_name)) {
                // Store path relative to site root if possible, or consistent relative path
                // Since this script is in admin/forms, we moved to ../uploads
                // We store "admin/uploads/properties/..."
                $image = "admin/uploads/properties/" . $new_name;
            }
        }
    }

    if (isset($_POST["edit_id"]) && !empty($_POST["edit_id"])) {
      // UPDATE
      $edit_id = res(dec($_POST["edit_id"]));
      $sql = "UPDATE `properties` SET 
              `title`='$title', 
              `price`='$price', 
              `price_high`='$price_high',
              `location`='$location', 
              `bhk`='$bhk', 
              `area`='$area', 
              `type`='$type', 
              `possession`='$possession', 
              `image`='$image',
              `map_url`='$map_url', 
              `description`='$description', 
              `features`='$features',
              `roi`='$roi',
              `city`='$city',
              `sub_location`='$sub_location',
              `comm_type`='$comm_type',
              `active`='$active'
              WHERE `id`='$edit_id'";

      if (mysqli_query($conn, $sql)) {
        set_alert("Property Updated Successfully", "success", "");
        Config::redirect("../property_list.php");
      } else {
        set_alert("Something went wrong!", "danger", "Data not updated.");
        Config::redirect("../add_property.php?id=".enc($edit_id));
      }
    } else {
      // INSERT
      if (empty($image)) {
           // Default placeholder if desired, or error. 
           // For now, let it be empty or require validation frontend side (which is there).
      }
      
      $sql = "INSERT INTO `properties` (`title`, `price`, `price_high`, `location`, `bhk`, `area`, `type`, `possession`, `image`, `map_url`, `description`, `features`, `roi`, `city`, `sub_location`, `comm_type`, `active`) 
              VALUES ('$title', '$price', '$price_high', '$location', '$bhk', '$area', '$type', '$possession', '$image', '$map_url', '$description', '$features', '$roi', '$city', '$sub_location', '$comm_type', '$active')";

      if (mysqli_query($conn, $sql)) {
        set_alert("Property Added Successfully", "success", "");
        Config::redirect("../property_list.php");
      } else {
        set_alert("Something went wrong!", "danger", "Data not saved.");
        Config::redirect("../add_property.php");
      }
    }
  }
}

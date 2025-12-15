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
    $location = res($_POST["location"]);
    $bhk = res($_POST["bhk"]);
    $area = res($_POST["area"]);
    $type = res($_POST["type"]);
    $possession = res($_POST["possession"]);
    $map_url = res($_POST["map_url"]);
    $description = res($_POST["description"]);
    $features = res($_POST["features"]); 
    $active = res($_POST["active"]);

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
        $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
        
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
              `location`='$location', 
              `bhk`='$bhk', 
              `area`='$area', 
              `type`='$type', 
              `possession`='$possession', 
              `image`='$image',
              `map_url`='$map_url', 
              `description`='$description', 
              `features`='$features',
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
      
      $sql = "INSERT INTO `properties` (`title`, `price`, `location`, `bhk`, `area`, `type`, `possession`, `image`, `map_url`, `description`, `features`, `active`) 
              VALUES ('$title', '$price', '$location', '$bhk', '$area', '$type', '$possession', '$image', '$map_url', '$description', '$features', '$active')";

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

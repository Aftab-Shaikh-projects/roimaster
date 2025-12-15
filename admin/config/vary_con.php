<?php
include 'db.php';

if (isset($_SESSION["admin_login"]) && $_SESSION["admin_login"] == true) {
  $user_id_e = $_SESSION["admin_id"];
  $user_id = dec($user_id_e);
  $user_sql = "SELECT * FROM `admin` WHERE `id`='$user_id'";
  $user_res = mysqli_query($conn, $user_sql);
  if (!$user_res) {
    set_alert("Authetication time out!", "danger", "Please login again.");
    Config::redirect("login");
  }
  if (mysqli_num_rows($user_res) != 1) {
    set_alert("Authetication time out!", "danger", "Please login again.");
    Config::redirect("login");
  }
  $user = mysqli_fetch_assoc($user_res);
} else {
  set_alert("Authetication time out!", "danger", "Please login again.");
  Config::redirect("login");
}

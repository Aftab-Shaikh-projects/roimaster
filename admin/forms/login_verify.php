<?php
include '../config/db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $user = $_POST["user"];
  $pass = $_POST["password"];
  $sql = "SELECT * FROM `admin` WHERE `username`='$user' OR `email`='$user' OR `mobile`='$user'";
  $res = mysqli_query($conn, $sql);
  if ($res) {
    $num = mysqli_num_rows($res);
    if ($num == 1) {
      $row = mysqli_fetch_assoc($res);
      $db_pass = $row["password"];
      if ($pass == $db_pass) {
        $_SESSION["admin_login"] = true;
        $_SESSION["admin_id"] = enc($row["id"]);
        set_alert("Login Successfull!", "success", "Welcome.");
        Config::redirect("../");
        exit;
      }
    }
  }
}

set_alert("Authentication failed!", "danger", "User and password not match.");
Config::redirect();

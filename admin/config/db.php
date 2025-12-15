<?php
include 'custom.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (!Config::checkCsrf()) {
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
      echo json_encode(["mess" => "Form validation expired!", "color" => "danger", "other" => ""]);
      exit;
    }
    set_alert("Form validation expired!", "danger", "");
    Config::redirect();
    exit;
  }
}
include 'settings.php';
try {
  $con = new Config;
  $conn = $con->db();

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
} catch (PDOException $e) {
  // If connection fails, display an error message
  echo "Connection failed: " . $e->getMessage();
}

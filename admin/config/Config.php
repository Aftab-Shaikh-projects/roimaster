<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
class Config
{
  public static $app_area = "dev";
  private static $servername = "localhost";
  private static $username;
  private static $password;
  private static $dbname;

  public function __construct()
  {
    switch (self::$app_area) {
      case 'dev':
        self::$username = "root";
        self::$password = "";
        self::$dbname = "roimaster";
        break;

      default:
        self::$username = "u483526650_roimaster";
        self::$password = "3qH;P&|Rc#W2";
        self::$dbname = "u483526650_roimaster";
        break;
    }
  }
  public function db(): mysqli
  {
    $servername = self::$servername;
    $username = self::$username;
    $password = self::$password;
    $dbname = self::$dbname;
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
  }
  public function closeDb($conn): void
  {
    $conn->close();
  }
  public static function csrf(): string
  {
    $num = rand(1000000,  999999999999999);
    $encode = enc($num);
    $_SESSION["csrf"] = $encode;
    $html = "<input type='hidden' name='csrf' value = '$encode'>";
    return $html;
  }
  public static function checkCsrf(): bool
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (!isset($_POST["csrf"])) {
        return false;
      }
      $csrf_input = $_POST["csrf"];

      $csrf_session = $_SESSION["csrf"];
      if ($csrf_input != $csrf_session) {
        return false;
      }
      return true;
    } else {
      return true;
    }
  }
  public static function redirect($to = "")
  {
    if ($to == "") {
      $request_uri = $_SERVER['HTTP_REFERER'];
    } else {
      $request_uri = $to;
    }
    header("Location:$request_uri");
    exit;
  }
  public static function timeDef($fdate, $todate)
  {
    // Create DateTime objects
    $start = new DateTime($fdate);
    $end = new DateTime($todate);

    // Calculate the difference
    $interval = $start->diff($end);

    // Format the result as HH:MM:SS
    return sprintf('%02d:%02d:%02d', $interval->h, $interval->i, $interval->s);
  }
  public static function logo_text()
  {
    return '<span style="color:#2478b3;"><span>NE</span><b>XG</b><span style="color:#000000;">enn</span><span class="text-danger"> Technologies</span></span>';
  }
  public static function set_old_data($arr)
  {
    unset($_SESSION["old_data"]);
    $_SESSION["old_data"] = $arr;
  }
  public static function old_data($name)
  {
    $res = '';
    if (isset($_SESSION["old_data"])) {
      $data = $_SESSION["old_data"];
      if (isset($data[$name])) {
        $res = $data[$name];
      }
    }
    return $res;
  }
}

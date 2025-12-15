<?php
$today = date("Y-m-d");
include 'Config.php';
function RES($post)
{
  global $conn;
  return mysqli_real_escape_string($conn, $post);
}

function HE($echo)
{
  return htmlentities($echo);
}

function HEQ($echo)
{
  return htmlentities($echo, ENT_QUOTES);
}

function HENQ($echo)
{
  return htmlentities($echo, ENT_NOQUOTES);
}

function GetCurType($t)
{
  $arr = ["INR" => ["Rupee", "Paise", "&#8377;"], "USD" => ["USD", "Cents", "&#36;"]];
  $v = $arr[$t];
  if (count($v) > 0)
    return $v;
  else
    return false;
}

function AmountFormat($num)
{

  if ($num == "") {
    return "0.00";
  }
  $num = str_replace(",", "", $num);
  $num = number_format($num, 2) ?? "00.0";
  $num = str_replace(",", "", $num);
  $num2 = $num;
  if ($num < 0) { //>
    $num2 = str_replace("-", "", $num);
  }
  $n = explode(".", $num2);
  $a = str_split($n[0]);
  $output = '';
  foreach (array_reverse($a) as $key => $value) {
    if ($key == 2) {
      $output .= $value . ",";
    } else if ($key > 3 && ($key + 1) % 2 == 1) {
      $output .= $value . ",";
    } else
      $output .= $value;
  }
  $c = str_split($output);
  $d = array_reverse($c);
  if ($d[0] == ",") {
    array_shift($d);
  }
  $output = implode("", $d);
  if ($num < 0) { //>
    return "-" . $output . "." . $n[1];
  }
  return $output . "." . $n[1];
}

function AmountDeFormat($num)
{
  if ($num == "") {
    return 0;
  }
  $num = preg_replace('/[^0-9.]/', '', $num);
  $num = str_replace(",", "", $num);
  $num = number_format($num, 2);
  $num = str_replace(",", "", $num);
  return $num;
}

function only_num($num)
{
  $num = preg_replace('/[^0-9.]/', '', $num);
  return $num;
}



function week_day($i, $val = 0)
{
  $arr = [
    "mon" => ["Monday", 1],
    "tue" => ["Tuesday", 2],
    "wed" => ["Wednesday", 3],
    "thu" => ["Thursday", 4],
    "fri" => ["Friday", 5],
    "sat" => ["Saturday", 6],
    "sun" => ["Sunday", 7],
    "1" => ["mon", "Monday"],
    "2" => ["tue", "Tuesday"],
    "3" => ["wed", "Wednesday"],
    "4" => ["thu", "Thursday"],
    "5" => ["fri", "Friday"],
    "6" => ["sat", "Saturday"],
    "7" => ["sun", "Sunday"]
  ];

  $d = strtolower($i);
  if (isset($arr[$d])) {
    return $arr[$d][$val];
  } else {
    return $i;
  }
}

function number_of_days($day, $s_day, $e_day)
{
  $s_day = get_date_by_def($s_day, 1, "-");
  $target_day = week_day($day, 1); //(1 for Monday, 7 for Sunday)
  $start_date = strtotime($s_day);
  $end_date = strtotime($e_day);
  $days_diff = floor(($end_date - $start_date) / (60 * 60 * 24)); // Calculate the difference in days
  $occurrences = floor(($days_diff + (date('N', $start_date) - $target_day + 7) % 7) / 7); // Calculate the number of occurrences
  return $occurrences;
}


function Country($code)
{
  $code = strtoupper($code);
  if ($code == 'AF')
    return 'Afghanistan';
  if ($code == 'AX')
    return 'Aland Islands';
  if ($code == 'AL')
    return 'Albania';
  if ($code == 'DZ')
    return 'Algeria';
  if ($code == 'AS')
    return 'American Samoa';
  if ($code == 'AD')
    return 'Andorra';
  if ($code == 'AO')
    return 'Angola';
  if ($code == 'AI')
    return 'Anguilla';
  if ($code == 'AQ')
    return 'Antarctica';
  if ($code == 'AG')
    return 'Antigua and Barbuda';
  if ($code == 'AR')
    return 'Argentina';
  if ($code == 'AM')
    return 'Armenia';
  if ($code == 'AW')
    return 'Aruba';
  if ($code == 'AU')
    return 'Australia';
  if ($code == 'AT')
    return 'Austria';
  if ($code == 'AZ')
    return 'Azerbaijan';
  if ($code == 'BS')
    return 'Bahamas the';
  if ($code == 'BH')
    return 'Bahrain';
  if ($code == 'BD')
    return 'Bangladesh';
  if ($code == 'BB')
    return 'Barbados';
  if ($code == 'BY')
    return 'Belarus';
  if ($code == 'BE')
    return 'Belgium';
  if ($code == 'BZ')
    return 'Belize';
  if ($code == 'BJ')
    return 'Benin';
  if ($code == 'BM')
    return 'Bermuda';
  if ($code == 'BT')
    return 'Bhutan';
  if ($code == 'BO')
    return 'Bolivia';
  if ($code == 'BA')
    return 'Bosnia and Herzegovina';
  if ($code == 'BW')
    return 'Botswana';
  if ($code == 'BV')
    return 'Bouvet Island (Bouvetoya)';
  if ($code == 'BR')
    return 'Brazil';
  if ($code == 'IO')
    return 'British Indian Ocean Territory (Chagos Archipelago)';
  if ($code == 'VG')
    return 'British Virgin Islands';
  if ($code == 'BN')
    return 'Brunei Darussalam';
  if ($code == 'BG')
    return 'Bulgaria';
  if ($code == 'BF')
    return 'Burkina Faso';
  if ($code == 'BI')
    return 'Burundi';
  if ($code == 'KH')
    return 'Cambodia';
  if ($code == 'CM')
    return 'Cameroon';
  if ($code == 'CA')
    return 'Canada';
  if ($code == 'CV')
    return 'Cape Verde';
  if ($code == 'KY')
    return 'Cayman Islands';
  if ($code == 'CF')
    return 'Central African Republic';
  if ($code == 'TD')
    return 'Chad';
  if ($code == 'CL')
    return 'Chile';
  if ($code == 'CN')
    return 'China';
  if ($code == 'CX')
    return 'Christmas Island';
  if ($code == 'CC')
    return 'Cocos (Keeling) Islands';
  if ($code == 'CO')
    return 'Colombia';
  if ($code == 'KM')
    return 'Comoros the';
  if ($code == 'CD')
    return 'Congo';
  if ($code == 'CG')
    return 'Congo the';
  if ($code == 'CK')
    return 'Cook Islands';
  if ($code == 'CR')
    return 'Costa Rica';
  if ($code == 'CI')
    return 'Cote d\'Ivoire';
  if ($code == 'HR')
    return 'Croatia';
  if ($code == 'CU')
    return 'Cuba';
  if ($code == 'CY')
    return 'Cyprus';
  if ($code == 'CZ')
    return 'Czech Republic';
  if ($code == 'DK')
    return 'Denmark';
  if ($code == 'DJ')
    return 'Djibouti';
  if ($code == 'DM')
    return 'Dominica';
  if ($code == 'DO')
    return 'Dominican Republic';
  if ($code == 'EC')
    return 'Ecuador';
  if ($code == 'EG')
    return 'Egypt';
  if ($code == 'SV')
    return 'El Salvador';
  if ($code == 'GQ')
    return 'Equatorial Guinea';
  if ($code == 'ER')
    return 'Eritrea';
  if ($code == 'EE')
    return 'Estonia';
  if ($code == 'ET')
    return 'Ethiopia';
  if ($code == 'FO')
    return 'Faroe Islands';
  if ($code == 'FK')
    return 'Falkland Islands (Malvinas)';
  if ($code == 'FJ')
    return 'Fiji the Fiji Islands';
  if ($code == 'FI')
    return 'Finland';
  if ($code == 'FR')
    return 'France, French Republic';
  if ($code == 'GF')
    return 'French Guiana';
  if ($code == 'PF')
    return 'French Polynesia';
  if ($code == 'TF')
    return 'French Southern Territories';
  if ($code == 'GA')
    return 'Gabon';
  if ($code == 'GM')
    return 'Gambia the';
  if ($code == 'GE')
    return 'Georgia';
  if ($code == 'DE')
    return 'Germany';
  if ($code == 'GH')
    return 'Ghana';
  if ($code == 'GI')
    return 'Gibraltar';
  if ($code == 'GR')
    return 'Greece';
  if ($code == 'GL')
    return 'Greenland';
  if ($code == 'GD')
    return 'Grenada';
  if ($code == 'GP')
    return 'Guadeloupe';
  if ($code == 'GU')
    return 'Guam';
  if ($code == 'GT')
    return 'Guatemala';
  if ($code == 'GG')
    return 'Guernsey';
  if ($code == 'GN')
    return 'Guinea';
  if ($code == 'GW')
    return 'Guinea-Bissau';
  if ($code == 'GY')
    return 'Guyana';
  if ($code == 'HT')
    return 'Haiti';
  if ($code == 'HM')
    return 'Heard Island and McDonald Islands';
  if ($code == 'VA')
    return 'Holy See (Vatican City State)';
  if ($code == 'HN')
    return 'Honduras';
  if ($code == 'HK')
    return 'Hong Kong';
  if ($code == 'HU')
    return 'Hungary';
  if ($code == 'IS')
    return 'Iceland';
  if ($code == 'IN')
    return 'India';
  if ($code == 'ID')
    return 'Indonesia';
  if ($code == 'IR')
    return 'Iran';
  if ($code == 'IQ')
    return 'Iraq';
  if ($code == 'IE')
    return 'Ireland';
  if ($code == 'IM')
    return 'Isle of Man';
  if ($code == 'IL')
    return 'Israel';
  if ($code == 'IT')
    return 'Italy';
  if ($code == 'JM')
    return 'Jamaica';
  if ($code == 'JP')
    return 'Japan';
  if ($code == 'JE')
    return 'Jersey';
  if ($code == 'JO')
    return 'Jordan';
  if ($code == 'KZ')
    return 'Kazakhstan';
  if ($code == 'KE')
    return 'Kenya';
  if ($code == 'KI')
    return 'Kiribati';
  if ($code == 'KP')
    return 'Korea';
  if ($code == 'KR')
    return 'Korea';
  if ($code == 'KW')
    return 'Kuwait';
  if ($code == 'KG')
    return 'Kyrgyz Republic';
  if ($code == 'LA')
    return 'Lao';
  if ($code == 'LV')
    return 'Latvia';
  if ($code == 'LB')
    return 'Lebanon';
  if ($code == 'LS')
    return 'Lesotho';
  if ($code == 'LR')
    return 'Liberia';
  if ($code == 'LY')
    return 'Libyan Arab Jamahiriya';
  if ($code == 'LI')
    return 'Liechtenstein';
  if ($code == 'LT')
    return 'Lithuania';
  if ($code == 'LU')
    return 'Luxembourg';
  if ($code == 'MO')
    return 'Macao';
  if ($code == 'MK')
    return 'Macedonia';
  if ($code == 'MG')
    return 'Madagascar';
  if ($code == 'MW')
    return 'Malawi';
  if ($code == 'MY')
    return 'Malaysia';
  if ($code == 'MV')
    return 'Maldives';
  if ($code == 'ML')
    return 'Mali';
  if ($code == 'MT')
    return 'Malta';
  if ($code == 'MH')
    return 'Marshall Islands';
  if ($code == 'MQ')
    return 'Martinique';
  if ($code == 'MR')
    return 'Mauritania';
  if ($code == 'MU')
    return 'Mauritius';
  if ($code == 'YT')
    return 'Mayotte';
  if ($code == 'MX')
    return 'Mexico';
  if ($code == 'FM')
    return 'Micronesia';
  if ($code == 'MD')
    return 'Moldova';
  if ($code == 'MC')
    return 'Monaco';
  if ($code == 'MN')
    return 'Mongolia';
  if ($code == 'ME')
    return 'Montenegro';
  if ($code == 'MS')
    return 'Montserrat';
  if ($code == 'MA')
    return 'Morocco';
  if ($code == 'MZ')
    return 'Mozambique';
  if ($code == 'MM')
    return 'Myanmar';
  if ($code == 'NA')
    return 'Namibia';
  if ($code == 'NR')
    return 'Nauru';
  if ($code == 'NP')
    return 'Nepal';
  if ($code == 'AN')
    return 'Netherlands Antilles';
  if ($code == 'NL')
    return 'Netherlands the';
  if ($code == 'NC')
    return 'New Caledonia';
  if ($code == 'NZ')
    return 'New Zealand';
  if ($code == 'NI')
    return 'Nicaragua';
  if ($code == 'NE')
    return 'Niger';
  if ($code == 'NG')
    return 'Nigeria';
  if ($code == 'NU')
    return 'Niue';
  if ($code == 'NF')
    return 'Norfolk Island';
  if ($code == 'MP')
    return 'Northern Mariana Islands';
  if ($code == 'NO')
    return 'Norway';
  if ($code == 'OM')
    return 'Oman';
  if ($code == 'PK')
    return 'Pakistan';
  if ($code == 'PW')
    return 'Palau';
  if ($code == 'PS')
    return 'Palestinian Territory';
  if ($code == 'PA')
    return 'Panama';
  if ($code == 'PG')
    return 'Papua New Guinea';
  if ($code == 'PY')
    return 'Paraguay';
  if ($code == 'PE')
    return 'Peru';
  if ($code == 'PH')
    return 'Philippines';
  if ($code == 'PN')
    return 'Pitcairn Islands';
  if ($code == 'PL')
    return 'Poland';
  if ($code == 'PT')
    return 'Portugal, Portuguese Republic';
  if ($code == 'PR')
    return 'Puerto Rico';
  if ($code == 'QA')
    return 'Qatar';
  if ($code == 'RE')
    return 'Reunion';
  if ($code == 'RO')
    return 'Romania';
  if ($code == 'RU')
    return 'Russian Federation';
  if ($code == 'RW')
    return 'Rwanda';
  if ($code == 'BL')
    return 'Saint Barthelemy';
  if ($code == 'SH')
    return 'Saint Helena';
  if ($code == 'KN')
    return 'Saint Kitts and Nevis';
  if ($code == 'LC')
    return 'Saint Lucia';
  if ($code == 'MF')
    return 'Saint Martin';
  if ($code == 'PM')
    return 'Saint Pierre and Miquelon';
  if ($code == 'VC')
    return 'Saint Vincent and the Grenadines';
  if ($code == 'WS')
    return 'Samoa';
  if ($code == 'SM')
    return 'San Marino';
  if ($code == 'ST')
    return 'Sao Tome and Principe';
  if ($code == 'SA')
    return 'Saudi Arabia';
  if ($code == 'SN')
    return 'Senegal';
  if ($code == 'RS')
    return 'Serbia';
  if ($code == 'SC')
    return 'Seychelles';
  if ($code == 'SL')
    return 'Sierra Leone';
  if ($code == 'SG')
    return 'Singapore';
  if ($code == 'SK')
    return 'Slovakia (Slovak Republic)';
  if ($code == 'SI')
    return 'Slovenia';
  if ($code == 'SB')
    return 'Solomon Islands';
  if ($code == 'SO')
    return 'Somalia, Somali Republic';
  if ($code == 'ZA')
    return 'South Africa';
  if ($code == 'GS')
    return 'South Georgia and the South Sandwich Islands';
  if ($code == 'ES')
    return 'Spain';
  if ($code == 'LK')
    return 'Sri Lanka';
  if ($code == 'SD')
    return 'Sudan';
  if ($code == 'SR')
    return 'Suriname';
  if ($code == 'SJ')
    return 'Svalbard & Jan Mayen Islands';
  if ($code == 'SZ')
    return 'Swaziland';
  if ($code == 'SE')
    return 'Sweden';
  if ($code == 'CH')
    return 'Switzerland, Swiss Confederation';
  if ($code == 'SY')
    return 'Syrian Arab Republic';
  if ($code == 'TW')
    return 'Taiwan';
  if ($code == 'TJ')
    return 'Tajikistan';
  if ($code == 'TZ')
    return 'Tanzania';
  if ($code == 'TH')
    return 'Thailand';
  if ($code == 'TL')
    return 'Timor-Leste';
  if ($code == 'TG')
    return 'Togo';
  if ($code == 'TK')
    return 'Tokelau';
  if ($code == 'TO')
    return 'Tonga';
  if ($code == 'TT')
    return 'Trinidad and Tobago';
  if ($code == 'TN')
    return 'Tunisia';
  if ($code == 'TR')
    return 'Turkey';
  if ($code == 'TM')
    return 'Turkmenistan';
  if ($code == 'TC')
    return 'Turks and Caicos Islands';
  if ($code == 'TV')
    return 'Tuvalu';
  if ($code == 'UG')
    return 'Uganda';
  if ($code == 'UA')
    return 'Ukraine';
  if ($code == 'AE')
    return 'United Arab Emirates';
  if ($code == 'GB')
    return 'United Kingdom';
  if ($code == 'US')
    return 'United States of America';
  if ($code == 'UM')
    return 'United States Minor Outlying Islands';
  if ($code == 'VI')
    return 'United States Virgin Islands';
  if ($code == 'UY')
    return 'Uruguay, Eastern Republic of';
  if ($code == 'UZ')
    return 'Uzbekistan';
  if ($code == 'VU')
    return 'Vanuatu';
  if ($code == 'VE')
    return 'Venezuela';
  if ($code == 'VN')
    return 'Vietnam';
  if ($code == 'WF')
    return 'Wallis and Futuna';
  if ($code == 'EH')
    return 'Western Sahara';
  if ($code == 'YE')
    return 'Yemen';
  if ($code == 'XK')
    return 'Kosovo';
  if ($code == 'ZM')
    return 'Zambia';
  if ($code == 'ZW')
    return 'Zimbabwe';
  return '';
}
function today()
{
  return date("d-M-Y");
}
function d($value)
{
  return date("d-M-Y", strtotime($value));
}

function T($value)
{
  return date("d-M-Y", $value);
}

function DT($value)
{
  return date("d-M-Y H:i:s", strtotime($value));
}
function TT($value)
{
  return date("d-M-Y H:i:s", $value);
}


function Get_Row($c, $t, $i, bool $test = false)
{
  $sql = "SELECT * FROM `$t` WHERE `id`='$i'";
  if ($test) {
    return $sql;
  }
  $res = mysqli_query($c, $sql);
  if ($res) {
    if (mysqli_num_rows($res) > 0) {
      return mysqli_fetch_assoc($res);
    } else {
      return false;
    }
  } else {
    return false;
  }
}

function emptyTO_0_($a)
{
  if (isset($a)) {
    if ($a != "") {
      return $a;
    } else {
      return "0";
    }
  } else {
    return "0";
  }
}
function emptyTO__($a)
{
  if (isset($a)) {
    if ($a != "") {
      return $a;
    } else {
      return "--";
    }
  } else {
    return "--";
  }
}
function PRE($a)
{
  echo "<pre>";
  print_r($a);
  echo "</pre>";
}

function get_tin($s)
{
  $state_codes = [
    ["st_n" => "Andhra Pradesh", "st_tin" => "37", "st_co" => "AD"],
    ["st_n" => "Arunachal Pradesh", "st_tin" => "12", "st_co" => "AR"],
    ["st_n" => "Assam", "st_tin" => "18", "st_co" => "AS"],
    ["st_n" => "Bihar", "st_tin" => "10", "st_co" => "BR"],
    ["st_n" => "Chattisgarh", "st_tin" => "22", "st_co" => "CG"],
    ["st_n" => "Delhi", "st_tin" => "07", "st_co" => "DL"],
    ["st_n" => "Goa", "st_tin" => "30", "st_co" => "GA"],
    ["st_n" => "Gujarat", "st_tin" => "24", "st_co" => "GJ"],
    ["st_n" => "Haryana", "st_tin" => "06", "st_co" => "HR"],
    ["st_n" => "Himachal Pradesh", "st_tin" => "02", "st_co" => "HP"],
    ["st_n" => "Jammu and Kashmir", "st_tin" => "01", "st_co" => "JK"],
    ["st_n" => "Jharkhand", "st_tin" => "20", "st_co" => "JH"],
    ["st_n" => "Karnataka", "st_tin" => "29", "st_co" => "KA"],
    ["st_n" => "Kerala", "st_tin" => "32", "st_co" => "KL"],
    ["st_n" => "Lakshadweep Islands", "st_tin" => "31", "st_co" => "LD"],
    ["st_n" => "Madhya Pradesh", "st_tin" => "23", "st_co" => "MP"],
    ["st_n" => "Maharashtra", "st_tin" => "27", "st_co" => "MH"],
    ["st_n" => "Manipur", "st_tin" => "14", "st_co" => "MN"],
    ["st_n" => "Meghalaya", "st_tin" => "17", "st_co" => "ML"],
    ["st_n" => "Mizoram", "st_tin" => "15", "st_co" => "MZ"],
    ["st_n" => "Nagaland", "st_tin" => "13", "st_co" => "NL"],
    ["st_n" => "Odisha", "st_tin" => "21", "st_co" => "OD"],
    ["st_n" => "Pondicherry", "st_tin" => "34", "st_co" => "PY"],
    ["st_n" => "Punjab", "st_tin" => "03", "st_co" => "PB"],
    ["st_n" => "Rajasthan", "st_tin" => "08", "st_co" => "RJ"],
    ["st_n" => "Sikkim", "st_tin" => "11", "st_co" => "SK"],
    ["st_n" => "Tamil Nadu", "st_tin" => "33", "st_co" => "TN"],
    ["st_n" => "Telangana", "st_tin" => "36", "st_co" => "TS"],
    ["st_n" => "Tripura", "st_tin" => "16", "st_co" => "TR"],
    ["st_n" => "Uttar Pradesh", "st_tin" => "09", "st_co" => "UP"],
    ["st_n" => "Uttarakhand", "st_tin" => "05", "st_co" => "UK"],
    ["st_n" => "West Bengal", "st_tin" => "19", "st_co" => "WB"]
  ];
  $s = ucwords(strtolower($s));
  $index = array_search($s, array_column($state_codes, 'st_n'));
  if ($index != "") {
    return $state_codes[$index]["st_tin"];
  } else {
    return "--";
  }
}

if (isset($_FILES)) {
  if (count($_FILES) > 0) {
    foreach ($_FILES as $key => $value) {
      if (is_array($value["type"])) {
        foreach ($value as $k => $v) {
          $filename = $value["name"];
          foreach ($filename as $nk => $nv) {
            if ($value["type"][$nk] != "" && $value["type"][$nk] != "image/png" && $value["type"][$nk] != "image/jpeg" && $value["type"][$nk] != "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" && $value["type"][$nk] != "application/vnd.openxmlformats-officedocument.presentationml.presentation" && $value["type"][$nk] != "application/pdf" && $value["type"][$nk] != "application/vnd.openxmlformats-officedocument.wordprocessingml.document" && $value["type"][$nk] != "video/mp4") {

              if ("https://192.168.1.113" . $_SERVER["REQUEST_URI"] == $_SERVER["HTTP_REFERER"]) {
                echo '<div style="display:flex;width:auto;">
                <h3 style="padding: 10px;color:white;background: red;border-radius: 10px;">Illegal file upload!</h3>
              </div>';
                echo '<script>
                      setTimeout(function() {
                        window.location.replace("index.php");
                      }, 3000);
                      </script>';
              } else {
                echo "Illegal file upload!";
              }
              exit;
            }
            // if ($value["type"][$nk] == "application/octet-stream" || $value["type"][$nk] == "application/x-javascript" || $value["type"][$nk] == "text/css") {
            // exit;
            // }
          }
        }
      } elseif ($value["type"] != "" && $value["type"] != "image/png" && $value["type"] != "image/jpeg" && $value["type"] != "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" && $value["type"] != "application/vnd.openxmlformats-officedocument.presentationml.presentation" && $value["type"] != "application/pdf" && $value["type"] != "application/vnd.openxmlformats-officedocument.wordprocessingml.document" && $value["type"] != "video/mp4") {

        if ("https://192.168.1.113" . $_SERVER["REQUEST_URI"] == $_SERVER["HTTP_REFERER"]) {
          echo '<div style="display:flex;width:auto;">
          <h3 style="padding: 10px;color:white;background: red;border-radius: 10px;">Illegal file upload!</h3>
        </div>';
          echo '<script>
                  setTimeout(function() {
                  window.location.replace("index.php");
                  }, 3000);
                </script>';
        } else {
          echo "Illegal file upload!";
        }
        exit;
      }
      // elseif ($value["type"] == "application/octet-stream" || $value["type"] == "application/x-javascript" || $value["type"] == "text/css") {
      // exit;
      // }
    }
  }
}



function format_price_indian($num) {
    // Clean string first (remove commas, spaces)
    $num = preg_replace('/[^\d.]/', '', $num);
    $num = floatval($num); // Ensure it's treated as a number

    if ($num >= 10000000) {
        $val = $num / 10000000;
        // Use number_format to ensure 2 decimal places and avoid default integer rounding of improper calls
        return "₹ " . number_format($val, 2) . " Cr";
    } elseif ($num >= 100000) {
        $val = $num / 100000;
        return "₹ " . number_format($val, 2) . " Lac";
    } else {
        // Assume flat amount for small nums, keep 0 decimals for clean look unless user specifically wants decimals for small amounts too?
        // User complaint "1.5 = 2" suggests they want decimals.
        // If input is 1.5 (very small), it becomes 2. So we must allow decimals.
        return "₹ " . number_format($num, 2);
    }
}

function timediffrence(string $date)
{
  $now = new DateTime();
  $future_date = new DateTime($date);
  $interval = $future_date->diff($now);
  if ($future_date > $now) {
    return $interval->format("%a:%h:%i:%s");
  } else {
    return "Time Out";
  }
}

function get_day_def($f_date, $t_date)
{
  $now = new DateTime($f_date);
  $future_date = new DateTime($t_date);
  $interval = $future_date->diff($now);
  if ($future_date > $now) {
    return $interval->format("%a");
  } else {
    return 0;
  }
}
function get_month_def($f_date, $t_date)
{
  $now = new DateTime($f_date);
  $future_date = new DateTime($t_date);
  $interval = $future_date->diff($now);
  if ($future_date > $now) {
    return $interval->format("%a");
  } else {
    return 0;
  }
}
function get_year_def($f_date, $t_date)
{
  $now = new DateTime($f_date);
  $future_date = new DateTime($t_date);
  $interval = $future_date->diff($now);
  if ($future_date > $now) {
    return $interval->format("%a");
  } else {
    return 0;
  }
}

function post(string $name, bool $bool = true)
{
  if ($bool == true) {
    if (isset($_POST[$name])) {
      return "value='$_POST[$name]'";
    }
  } elseif ($bool == false) {
    if (isset($_POST[$name])) {
      return $_POST[$name];
    }
  }
  return null;
}

function dateDifference($date1, $date2)
{
  $date1Obj = new DateTime($date1);
  $date2Obj = new DateTime($date2);

  $interval = $date1Obj->diff($date2Obj);

  $years = $interval->y;
  $months = $interval->m;
  $days = $interval->d;

  $differenceString = "";
  if ($years > 0) {
    $differenceString .= $years . " years, ";
  }
  if ($months > 0) {
    $differenceString .= $months . " months, ";
  }
  $differenceString .= $days . " days";

  return $differenceString;
}

// Number Abbrevuation
function formatNumberAbbreviation($number)
{
  if ($number >= 10000000) {
    return round($number / 10000000, 2) . " crore";
  } else if ($number >= 100000) {
    return round($number / 100000, 2) . " lakh";
  } else if ($number >= 1000) {
    return round($number / 1000, 2) . "k";
  }
  return $number;
}














// task add and project task chart














function date_addtions($startdate, $numberofdays)
{
  $startdate = date_create($startdate);
  $enddate = date_add($startdate, date_interval_create_from_date_string(($numberofdays - 1) . 'days'));
  echo date_format($enddate, "d-M-Y");
}
function date_adds($startdate, $numberofdays)
{
  $startdate = date_create($startdate);
  $enddate = date_add($startdate, date_interval_create_from_date_string(($numberofdays - 1) . 'days'));
  return date_format($enddate, "d-M-Y");
}

function get_date_by_def($date, $def, $a_s)
{
  return T(strtotime("$a_s$def day", strtotime($date)));
}

function ma_day_date(string $day, string $date)
{
  $day = week_day($day, 1);
  $date = date("N", strtotime($date));
  if ($day == $date) {
    return 1;
  } else {
    return 0;
  }
}
function a_m_day_date(string $day, array $date)
{
  $count = 0;
  foreach ($date as $key => $value) {
    if (is_array($value)) {
      $count += ma_day_date($day, $value[0]);
    } else {
      $count += ma_day_date($day, $value);
    }
  }
  return $count;
}

function g_pos_start($from_date, $to_date, $p_start_date, $colors = null, $msg_color = null)
{
  $left = 0;
  $p_d = $p_start_date;
  $f_d = $from_date;
  $t_d = $to_date;
  $start_year_p = date("Y", strtotime($p_d));
  $start_month_p = date("m", strtotime($p_d));
  $start_days_p = date("t", strtotime($p_d));
  $start_year = date("Y", strtotime($f_d));
  $start_month = date("m", strtotime($f_d));
  $month_day = date("t", strtotime($f_d));
  $start_date = date("d", strtotime($f_d));
  $end_date = date("d", strtotime($t_d));
  $end_month = date("m", strtotime($t_d));
  $end_year = date("Y", strtotime($t_d));
  if ($colors != "") {
    $bg_color = $colors->get_color();
    if ($msg_color != "") {
      $bg_color = $colors->getid_color($msg_color);
    }
  } else {
    $bg_color = "#ff4747";
  }

  $start_month += (12 * ($start_year - $start_year_p));
  $end_month += (12 * ($end_year - $start_year_p));
  $width = 0;
  for ($i = $start_month; $i <= $end_month; $i++) { //>
    $m = $i % 12;
    $y = ceil($i / 12);
    $y = $start_year_p + $y;
    if ($i == $start_month) {
      $sd = $start_date;
    } else {
      $sd = 1;
    }
    if ($i == $end_month) {
      $ed = $end_date;
    } else {
      $ed = date("t", strtotime("$m/01/$y"));
    }
    $def = ($ed - $sd) + 1;
    $md = date("t", strtotime("$m/01/$y"));
    $width += $def / ($md / 100);
  }
  for ($i = $start_month_p; $i <= $start_month; $i++) {
    $m = $i % 12;
    $y = ceil($i / 12);
    $y = $start_year_p + $y;
    if ($i == $start_month) {
      $sd = $start_date - 1;
    } else {
      $sd = date("t", strtotime("$m/01/$y"));
    }
    $md = date("t", strtotime("$m/01/$y"));
    $left += (($sd) / $md) * 100;
  }

  echo
  'left:' . $left . '%; width:' . $width . '%; background-color:' . $bg_color . ';';
}

function emptyTO_mess($a, $mess = "--", $cc = "")
{
  if (isset($a)) {
    if ($a != "") {
      return HEQ("$a $cc");
    } else {
      return HEQ("$mess");
    }
  } else {
    return HEQ("$mess");
  }
}

function addactive($class, ...$page)
{
  $a = strtolower(basename($_SERVER['SCRIPT_NAME']));

  foreach ($page as $p) {
    if ($a == $p) {
      return $class;
    }
  }
}
function tarnsaparent(...$page)
{
  $a = strtolower(basename($_SERVER['SCRIPT_NAME']));

  foreach ($page as $p) {
    if ($a == $p) {
      echo "light";
    } else {
      echo "transparent";
    }
  }
}

function bread_crump(array $a)
{
  echo '<div class="d-flex bread_crump text_12_18">';
  foreach ($a as $key => $value) {
    if ($key == count($a) - 1) {
      echo '<span class="bread_link">' . $value . '</span>';
    } else if ($key == 0) {
      echo '<span class="bread_link">' . $value . '<span>&lt;</span></span>';
    } else {
      echo '<span class="bread_link">' . $value . '<span>&lt;</span></span>';
    }
  }
  echo "</div>";
}


function ot_note_icon($message = "New")
{
  return '<div class="blink_note_icon">' . $message . '</div>';
}

function get_task_request_urgency($t)
{
  $r = "";
  switch ($t) {
    case '1':
      $r = '<b class="text-primary">Low</b>';
      break;
    case '2':
      $r = '<b class="text-warning">Medium</b>';
      break;
    case '3':
      $r = '<b class="text-danger">High</b>';
      break;
    default:
      $r = "";
      break;
  }
  return $r;
}

function get_task_rquest_stat($s /* status */, $me = true /* i am creater */, $d = false /* check by me */)
{
  $r = "";
  switch ($s) {
    case '0':
      $r = '<b class="text-danger">Draft</b>';
      break;
    case '1':
      if ($me) {
        $r = '<b class="text-success">Sent</b>';
      } elseif (!$d) {
        $r = '<b class="text-warning">Pending</b>';
      } elseif ($d) {
        $r = '<b class="text-dark">Waiting for approval</b>';
      }
      break;
    case '2':
      $r = '<b class="text-success">Approved</b>';
      break;
    case '3':
      $r = '<b class="text-danger">Reject</b>';
      break;
    default:
      $r = "--";
      break;
  }
  return $r;
}

function emptyDate($date, $format = "d", $mess = "--")
{
  if ($date == "") {
    return $mess;
  } else {
    switch ($format) {
      case 'd':
        $date = d($date);
        break;
      case 'dt':
        $date = dt($date);
        break;
      case 't':
        $date = t($date);
        break;
      case 'tt':
        $date = tt($date);
        break;
      case 'db':
        $date = date("Y-m-d", strtotime($date));
        break;
      case 'db-dt':
        $date = date("Y-m-d H:i:s", strtotime($date));
        break;
      case 'db-t-dt':
        $date = date("Y-m-d H:i:s", $date);
        break;
      case 'db-t-d':
        $date = date("Y-m-d", $date);
        break;
      case 'd_dt_12':
        $date = date("Y-m-d h:i a", strtotime($date));
        break;
      case 't_dt_12':
        $date = date("Y-m-d  h:i a", $date);
        break;
      default:

        break;
    }
  }
  return $date;
}


function numberToFloor($number)
{
  $ordinal = array(
    0 => 'Zeroth',
    1 => 'First',
    2 => 'Second',
    3 => 'Third',
    4 => 'Fourth',
    5 => 'Fifth',
    6 => 'Sixth',
    7 => 'Seventh',
    8 => 'Eighth',
    9 => 'Ninth',
    10 => 'Tenth',
    11 => 'Eleventh',
    12 => 'Twelfth',
    13 => 'Thirteenth',
    14 => 'Fourteenth',
    15 => 'Fifteenth',
    16 => 'Sixteenth',
    17 => 'Seventeenth',
    18 => 'Eighteenth',
    19 => 'Nineteenth',
    20 => 'Twentieth',
    30 => 'Thirtieth',
    40 => 'Fortieth',
    50 => 'Fiftieth',
    60 => 'Sixtieth',
    70 => 'Seventieth',
    80 => 'Eightieth',
    90 => 'Ninetieth',
    100 => 'Hundredth'
  );

  $numbers = array(
    1 => 'One',
    2 => 'Two',
    3 => 'Three',
    4 => 'Four',
    5 => 'Five',
    6 => 'Six',
    7 => 'Seven',
    8 => 'Eight',
    9 => 'Nine'
  );

  if ($number < 21 || $number % 10 === 0) {
    return $ordinal[$number];
  } elseif ($number < 100) {
    $tensDigit = (int) ($number / 10) * 10;
    $onesDigit = $number % 10;
    return $ordinal[$tensDigit] . '-' . $ordinal[$onesDigit];
  } elseif ($number < 1000) {
    $hundredsDigit = (int) ($number / 100);
    $remainder = $number % 100;
    if ($remainder == 0) {
      return $ordinal[$hundredsDigit * 100];
    } elseif ($remainder < 21 || $remainder % 10 === 0) {
      return $numbers[$hundredsDigit] . ' hundred ' . $ordinal[$remainder];
    } else {
      $tensDigit = (int) ($remainder / 10) * 10;
      $onesDigit = $remainder % 10;
      return $numbers[$hundredsDigit] . ' hundred ' . $ordinal[$tensDigit] . '-' . $ordinal[$onesDigit];
    }
  } else {
    return 'Number out of range';
  }
}


function fund_doc_stat($s = null)
{
  $r = "";
  switch ($s) {
    case '0': //unverified
      $r = '<span class="text-secondary"><i class="mdi mdi-check-circle"></i></span>';
      break;
    case '1': //Pending
      $r = '<span class="text-warning"><i class="mdi mdi-timer-sand"></i></span>';
      break;
    case '2': //accept
      $r = '<span class="text-success"><i class="mdi mdi-check-circle"></i></span>';
      break;
    case '3': //reject
      $r = '<span class="text-danger"><i class="mdi mdi-close-circle"></i></span>';
      break;
    case '4': //fraud
      $r = '<span class="text-warning"><i class="mdi mdi-alert-box"></i></span>';
      break;
    case '5': //Change
      $r = '<span class="text-info"><i class="mdi mdi-sync-alert"></i></span>';
      break;
    default: //Info
      $r = '<span class="text-info"><i class="mdi mdi-information"></i></span>';
      break;
  }
  return $r;
}


function cal_abs_max_val($val)
{

  $res = 0;
  $val = only_num($val);
  $val = ceil($val);
  $num_l = strlen($val);
  $base = 10;
  for ($i = 1; $i < $num_l - 1; $i++) {
    $base *= 10;
  }
  if ($val % $base == 0) {
    $res = $val;
  } else {
    $nv = $val + $base;
    $remo = substr($nv, 1);
    $res = $nv - $remo;
  }
  return $res;
}

function enc($val)
{
  return base64_encode(base64_encode($val));
}
function dec($val)
{
  return base64_decode(base64_decode($val));
}

function set_alert($mess, $color, $other)
{
  $_SESSION["error_mess"] = ["mess" => $mess, "color" => $color, "other" => $other];
}
function redirect($to = '')
{
  if ($to == "") {
    $request_uri = $_SERVER['HTTP_REFERER'];
  } else {
    $request_uri = $to;
  }
?>
  <script>
    window.location.href = `<?= $request_uri ?>`;
  </script>
<?php
  exit;
}

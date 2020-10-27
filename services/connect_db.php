<?php 
// DB credentials.
$localhost = "localhost";
$username = "root";
$password = "";
$dbname = "dailybell";
// db connection
$connect = new mysqli($localhost, $username, $password, $dbname,"3308");
// check connection
if($connect->connect_error) {
  die("Connection Failed : " . $connect->connect_error);
} else {
    // echo "<script>console.log('DB Connected!')</script>";
}
// function console_log($output, $with_script_tags = true)
// {
//     $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
//         ');';
//     if ($with_script_tags) {
//         $js_code = '<script>' . $js_code . '</script>';
//     }
//     echo $js_code;
// }
?>
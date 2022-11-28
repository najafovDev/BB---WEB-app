<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
ini_set('memory_limit', '1024M'); // or you could use 1G

define("DB_HOST", "localhost");
define("DB_USER", "davam016_test");
define("DB_PASSWORD", "jeR}&b#ii%A2");
define("DB_DATABASE", "davam016_test");

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM user_details ORDER BY id";
$result = $conn -> query($sql);

$myArray = array();

if ($result) {
    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $myArray[] = $row;
}
echo json_encode($myArray);
}
$result->close();

$conn -> close();

?>

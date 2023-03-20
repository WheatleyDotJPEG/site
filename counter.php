<?php
// connect to the database
$db_host = "localhost"; // database host
$db_name = "your_database_name"; // database name
$db_user = "your_database_user"; // database user
$db_pass = "your_database_password"; // database password

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// get the IP address of the current visitor
$ip_address = $_SERVER['REMOTE_ADDR'];

// check if the IP address already exists in the database
$sql = "SELECT * FROM visitors WHERE ip_address = '$ip_address'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    // insert a new row with the current IP address and visit time
    $visit_time = date('Y-m-d H:i:s');
    $sql = "INSERT INTO visitors (ip_address, visit_time) VALUES ('$ip_address', '$visit_time')";
    mysqli_query($conn, $sql);
}

// get the total number of rows in the visitors table
$sql = "SELECT COUNT(*) AS count FROM visitors";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$visitor_count = $row['count'];

// display the visitor count
echo "This website has been visited $visitor_count times.";

// close the database connection
mysqli_close($conn);
?>

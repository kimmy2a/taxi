<?php
$host =getenv('HOST');
$username =getenv('USERNAME');
$password =getenv('PASSWORD');
$database =getenv('DATABASE');

echo "host=$host , user=$username, pass=$password, database=$database";

$connection = mysqli_connect(
    $host,
    $username,
    $password,
    $database);
if( $connection == false ){
    echo "database connection error";
}
?>
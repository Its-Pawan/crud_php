<?php
$server = "localhost";
$username = 'root';
$password = '';
$database = 'crud_app';

try {
    $conn = new mysqli($server, $username, $password, $database);   
    date_default_timezone_set('Asia/Kolkata');
    echo'Connecting Database Successful';
} catch (Exception $e) {
    echo 'Failed to connect, Reason-> '. $e->getMessage();
    exit();
}
?>
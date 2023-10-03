<?php
function connect()
{
    $host = "127.0.0.1";
    $username = "root";
    $password = "khoirul";
    $conn = new PDO("mysql:host=$host;dbname=taniku", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}
?>

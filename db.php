<?php

use PSpell\Config;

$servername = "127.0.0.1";
$username = "root";
$password = "";
$db = "hashpatal";
// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $sql = "CREATE DATABASE IF NOT EXISTS $db";
    $run_query = mysqli_query($conn, $sql);
    $conn = new mysqli($servername, $username, $password, $db);
    $query = file($_SERVER['DOCUMENT_ROOT'] . "/db.sql");
    $templine = '';
    foreach ($query as $line) {
        if (substr($line, 0, 2) == '--' || $line == '')
            continue;
        $templine .= $line;
        if (substr(trim($line), -1, 1) == ';') {
            try {
                mysqli_query($conn, $templine);
            } catch (Exception $e) {
                echo $e;
                die();
            }
            $templine = '';
        }
    }
    try {
        mysqli_query($conn, $sql);
    } catch (Exception $err) {
        echo $err;
    }
    define('conn', $conn);
}


// 9D9sS6#*{jB-
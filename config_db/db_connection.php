<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "temporia";
$port = "3308";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname;port=$port", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

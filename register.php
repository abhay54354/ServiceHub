<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "service_hub";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Receive form data
$name = $_POST['name'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // secure password

// Insert into database
$sql = "INSERT INTO users (name, email, username, password) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $email, $username, $password);

if ($stmt->execute()) {
  echo "Registration successful!";
} else {
  echo "Error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>

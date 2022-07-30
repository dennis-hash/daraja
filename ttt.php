<?php
$servername = "localhost";
$username = "dennis";
$password = "12414-Denn!s";
$db = "projectDB";
// Create connection
$conn = new mysqli($servername, $username, $password,$db);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$semail=trim($_POST['semail']);
$password=trim($_POST['pwd']);
//now insert the received values into database using defined variables
$sqli ="INSERT INTO admintb(semail,pwd) VALUES ('$semail','$password')";
if ($conn->query($sqli) === TRUE) {
    echo "account created successfully";
} else {
    echo "Error: " . $sqli . "<br>" . $conn->error;
}
$conn->close();

?>
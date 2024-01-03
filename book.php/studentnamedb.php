<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "student";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST["name"]);

    $sql = "INSERT INTO student_a (name) VALUES ('$name')";

    if ($conn->query($sql) === TRUE) {
        echo "Name added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();

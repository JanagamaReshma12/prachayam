<?php

$con = new mysqli('localhost', 'root', "", 'book_task');


if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if (!$con) {
    die(mysqli_error($con));
}

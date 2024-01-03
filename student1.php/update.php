<?php

$con = new mysqli('localhost', 'root', "", 'book_task');


$id = $_GET['updateid'];


if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $class = $_POST['class'];
    $photos = $_POST['photos'];
    $videos = $_POST['videos'];

  
    $sql = "UPDATE `student_table` SET name='$name', class='$class', photos='$photos', videos='$videos' WHERE id=$id";

    $result = mysqli_query($con, $sql);
    if ($result) {
        //echo "Updated successfully";
        header('location:display.php');
    } else {
        die(mysqli_error($con));
    }
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Hello, world!</title>
</head>

<body>
    <div class="container my-5">

        <form action="" method="post">
            <div class="form-group">
                <label>Name:</label>

                <input type="text" class="form-control" placeholder="Enter your name" name="name" autocomplete="off">
            </div>

            <div class="form-group">
                <label>Class:</label>

                <input type="text" class="form-control" placeholder="Enter your class" name="class" autocomplete="off">
            </div>

            <div class="form-group">
                <label>Photo:</label>

                <input type="file" class="form-control" placeholder="Enter your photos" name="photos" autocomplete="off">
            </div>

            <div class="form-group">
                <label>Video:</label>

                <input type="file" class="form-control" placeholder="Enter your videos" name="videos" autocomplete="off">
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Save</button>
        </form>
    </div>
</body>

</html>
<?php

$con = new mysqli('localhost', 'root', "", 'book_task');


if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $class = $_POST['class'];

    $uploadsDirectoryRelative = 'uploads' . DIRECTORY_SEPARATOR;

    if (!is_dir($uploadsDirectoryRelative)) {
        mkdir($uploadsDirectoryRelative, 0777, true);
    }

    $photos_tmp_name = $_FILES["photos"]["tmp_name"];
    $videos_tmp_name = $_FILES["videos"]["tmp_name"];

    $photoName = basename($_FILES["photos"]["name"]);
    $videoName = basename($_FILES["videos"]["name"]);

    $photoPath = $uploadsDirectoryRelative . $photoName;
    $videoPath = $uploadsDirectoryRelative . $videoName;

    if (
        move_uploaded_file($photos_tmp_name, $photoPath) &&
        move_uploaded_file($videos_tmp_name, $videoPath)
    ) {
        
        $sql = "INSERT INTO `student_table` (name, class, photos, videos) VALUES ('$name', '$class', '$photoPath', '$videoPath')";

        $result = mysqli_query($con, $sql);
        if ($result) {
          
            header('location:display.php');
        } else {
            die(mysqli_error($con));
        }
    } else {
        echo "Error uploading files. Check directory permissions.";
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

        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Name:</label>
                <input type="text" class="form-control" placeholder="Enter your name" name="name" autocomplete="off" required>
            </div>

            <div class="form-group">
                <label>Class:</label>
                <input type="text" class="form-control" placeholder="Enter your class" name="class" autocomplete="off" required>
            </div>

            <div class="form-group">
                <label>Photo:</label>
                <input type="file" class="form-control" name="photos" accept="image/*" required>
            </div>

            <div class="form-group">
                <label>Video:</label>
                <input type="file" class="form-control" name="videos" accept="video/*" required>
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Save</button>
        </form>
    </div>
</body>

</html>
<?php

$con = new mysqli('localhost', 'root', "", 'book_task');


if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $author = $_POST['author'];
    $publication = $_POST['publication'];
    $year = $_POST['year'];


    $sql = "INSERT INTO `booktask_table` (name, author, publication, year) VALUES ('$name', '$author', '$publication', '$year')";

    $result = mysqli_query($con, $sql);
    if ($result) {
      
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
                <label>Author:</label>

                <input type="text" class="form-control" placeholder="Enter your author" name="author" autocomplete="off">
            </div>

            <div class="form-group">
                <label>Publication:</label>

                <input type="text" class="form-control" placeholder="Enter your publication" name="publication" autocomplete="off">
            </div>

            <div class="form-group">
                <label>Year:</label>

                <input type="date" class="form-control" placeholder="Enter your year" name="year" autocomplete="off">
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
</body>

</html>
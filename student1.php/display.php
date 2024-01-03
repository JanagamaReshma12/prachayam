<!-- display.php -->
<?php
include 'studentdb.php'; // Include the file that contains the database connection code
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Operations.</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Hello, world!</title>
</head>

<body>
    <div class="container">
        <button class="btn btn-success my-5"><a href="student.php" class="text-light">Add User</a></button>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Sl.No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Class</th>
                    <th scope="col">Photos</th>
                    <th scope="col">Videos</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>

                <?php
               
                if ($con) {
                    $sql = "SELECT * FROM student_table";

                    $result = mysqli_query($con, $sql);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['id'];
                            $name = $row['name'];
                            $class = $row['class'];
                            $photos = $row['photos'];
                            $videos = $row['videos'];

                            echo '<tr>
                                <th scope="row">' . $id . '</th>
                                <td>' . $name . '</td>
                                <td>' . $class . '</td>
                                <td><img src="' . $photos . '" alt="Photo" style="max-width: 100px; max-height: 100px;"></td>
                                <td>
                                    <video width="320" height="240" controls>
                                        <source src="' . $videos . '" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </td>
                                <td>
                                    <button class="btn btn-primary">
                                        <a href="update.php?updateid=' . $id . '" class="text-light">Update</a>
                                    </button>
                                    <button class="btn btn-danger">
                                        <a href="delete.php?deleteid=' . $id . '" class="text-light">Delete</a>
                                    </button>
                                </td>
                            </tr>';
                        }
                    } else {
                        echo "Error: " . mysqli_error($con);
                    }
                } else {
                    echo "Connection not established.";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
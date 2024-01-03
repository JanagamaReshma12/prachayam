<?php
include 'bookdb.php';

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
        <button class="btn btn-success my-5"><a href="book.php" class="text-light">Add User</a></button>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Sl.No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Author</th>
                    <th scope="col">Publication</th>
                    <th scope="col">Year</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $sql = "select * from booktask_table";

                $result = mysqli_query($con, $sql);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        $name = $row['name'];
                        $author = $row['author'];
                        $publication = $row['publication'];
                        $year = $row['year'];
                        echo '<tr>
                        <th scope="row">' . $id . '</th>
                        <td>' . $name . '</td>
                        <td>' . $author . '</td>
                        <td>' . $publication . '</td>
                        <td>' . $year . '</td>

                        <td>
                        <button class="btn btn-primary" >
                        <a href="update.php?updateid= ' . $id . '" class="text-light">Update</a></button>


                        <button class="btn btn-danger">
                        <a href="delete.php?deleteid= ' . $id . '" class="text-light">Delete</a></button>
                </td>
                    </tr>';
                    }
                }
                ?>



            </tbody>
        </table>

    </div>

</body>

</html>
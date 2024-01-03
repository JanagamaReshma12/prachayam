<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "student";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST['delete'])) {
    $deleteId = $_POST['delete'];
    $sqlDelete = "DELETE FROM student_a WHERE id = $deleteId";

    if ($conn->query($sqlDelete) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}


if (isset($_GET['edit'])) {
    $editId = $_GET['edit'];
    $sqlEdit = "SELECT * FROM student_a WHERE id = $editId";
    $resultEdit = $conn->query($sqlEdit);

    if ($resultEdit->num_rows > 0) {
        $rowEdit = $resultEdit->fetch_assoc();
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST["name"]);
    $class = $conn->real_escape_string($_POST["class"]);
    $photos_tmp_name = $_FILES["photos"]["tmp_name"];
    $videos_tmp_name = $_FILES["videos"]["tmp_name"];

    $uploadsDirectory = "uploads" . DIRECTORY_SEPARATOR;

    if (!is_dir($uploadsDirectory)) {
        mkdir($uploadsDirectory, 0777, true);
    }

    $photoName = basename($_FILES["photos"]["name"]);
    $videoName = basename($_FILES["videos"]["name"]);

    $photoPath = $uploadsDirectory . $photoName;
    $videoPath = $uploadsDirectory . $videoName;

    if (
        move_uploaded_file($photos_tmp_name, $photoPath) &&
        move_uploaded_file($videos_tmp_name, $videoPath)
    ) {

        if (isset($_POST['editId'])) {
            $editId = $_POST['editId'];
            $sql = "UPDATE student_a SET name='$name', class='$class', photos='$photoName', videos='$videoName' WHERE id=$editId";
        } else {
            $sql = "INSERT INTO student_a (name, class, photos, videos) VALUES ('$name', '$class', '$photoName', '$videoName')";
        }

        if ($conn->query($sql) === TRUE) {
            echo "Record added/updated successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading files. Check directory permissions.";
    }
}

$sqlSelect = "SELECT * FROM student_a";
$resultSelect = $conn->query($sqlSelect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book and Class Information Forms</title>
    <link rel="stylesheet" href="mystyle.css">
</head>

<body>

    <div class="form-container">
        <form action="student.php" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo isset($rowEdit['name']) ? $rowEdit['name'] : ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="class">Class:</label>
                <input type="text" id="class" name="class" value="<?php echo isset($rowEdit['class']) ? $rowEdit['class'] : ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="photos">Photos (Image):</label>
                <input type="file" id="photos" name="photos" accept="image/*" required>
            </div>

            <div class="form-group">
                <label for="videos">Videos:</label>
                <input type="file" id="videos" name="videos" accept="video/*" required>
            </div>

            <?php if (isset($rowEdit)) : ?>
                <input type="hidden" name="editId" value="<?php echo $rowEdit['id']; ?>">
                <button type="submit">Update</button>
            <?php else : ?>
                <button type="submit">Next</button>
            <?php endif; ?>

            <button type="button" class="cancel">Cancel</button>
        </form>
    </div><br><br>

    <table>
        <tr>
            <th>Name</th>
            <th>Class</th>
            <th>Photo</th>
            <th>Video</th>
            <th>Action</th>
        </tr>

        <?php

        while ($row = $resultSelect->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["class"]) . "</td>";
            echo "<td><img src='uploads/" . htmlspecialchars($row["photos"]) . "' alt='Photo' style='width: 50px; height: 50px;'></td>";
            echo "<td><video width='100' height='100' controls><source src='uploads/" . htmlspecialchars($row["videos"]) . "' type='video/mp4'></video></td>";
            echo "<td>";
            echo "<button onclick=\"editRecord({$row['id']})\">Edit</button>";
            echo "<button class='delete' onclick=\"deleteRecord({$row['id']})\">Delete</button>";
            echo "</td>";
            echo "</tr>";
        }
        ?>

    </table>

    <script>
        function editRecord(id) {
            window.location.href = 'student.php?edit=' + id;
        }

        function deleteRecord(id) {
            if (confirm('Are you sure you want to delete this record?')) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'student.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        location.reload();
                    }
                };
                xhr.send('delete=' + id);
            }
        }
    </script>

</body>

</html>

<?php
$conn->close();
?>
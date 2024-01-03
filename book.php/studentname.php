<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Name List</title>
    <link rel="stylesheet" href="mystyle.css">
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 5%;
    }

    h2 {
        color: #333;
    }

    form {
        max-width: 900px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
        display: block;
        margin-bottom: 8px;
        color: #333;
    }

    select {
        width: 100%;
        padding: 10px;
        margin-bottom: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    select:focus {
        outline: none;
        border-color: #007bff;
    }

    input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }
</style>

<body>

    <h2>Name List</h2>

    <form action="studentnamedb.php" method="post">
        <label for="name">Select a Name:</label>
        <select id="name" name="name">
            <?php
            $host = "localhost";
            $username = "root";
            $password = "";
            $database = "student";

            $conn = new mysqli($host, $username, $password, $database);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM student_a";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . htmlspecialchars($row["name"]) . "'>" . htmlspecialchars($row["name"]) . "</option>";
                }
            } else {
                echo "<option value=''>No names found</option>";
            }

            $conn->close();
            ?>
        </select><br><br>


        <label for="class">Select a Class:</label>
        <select id="class" name="class">
            <?php
            $conn = new mysqli($host, $username, $password, $database);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT DISTINCT class FROM student_a";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . htmlspecialchars($row["class"]) . "'>" . htmlspecialchars($row["class"]) . "</option>";
                }
            } else {
                echo "<option value=''>No classes found</option>";
            }

            $conn->close();
            ?>
        </select><br><br>

        <label for="photos">Select a Photo:</label>
        <select id="photos" name="photos">
            <?php
            $conn = new mysqli($host, $username, $password, $database);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT DISTINCT photos FROM student_a";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . htmlspecialchars($row["photos"]) . "'>" . htmlspecialchars($row["photos"]) . "</option>";
                }
            } else {
                echo "<option value=''>No photos found</option>";
            }

            $conn->close();
            ?>
        </select><br><br>

        <label for="videos">Select a Video:</label>
        <select id="videos" name="videos">
            <?php
            $conn = new mysqli($host, $username, $password, $database);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT DISTINCT videos FROM student_a";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . htmlspecialchars($row["videos"]) . "'>" . htmlspecialchars($row["videos"]) . "</option>";
                }
            } else {
                echo "<option value=''>No videos found</option>";
            }

            $conn->close();
            ?>
        </select><br><br>

        <br>
    </form>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>

    <div class="container mt-5">
        <h2 class="text-primary mb-4">Book List</h2>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          
            $selectedBook = $_POST["bookName"];
            $selectedStudent = $_POST["studentName"];
            $startDate = $_POST["startDate"];
            $endDate = $_POST["endDate"];

            echo '<table class="table mt-5">
                    <thead>
                        <tr>
                            <th>Selected Book Name</th>
                            <th>Selected Student Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>' . htmlspecialchars($selectedBook) . '</td>
                            <td>' . htmlspecialchars($selectedStudent) . '</td>
                            <td>' . htmlspecialchars($startDate) . '</td>
                            <td>' . htmlspecialchars($endDate) . '</td>
                        </tr>
                    </tbody>
                </table>';
        }
        ?>

        <form action="" method="post" id="myForm">

            <div class="form-group">
                <label for="bookName">Select a Book Name:</label>
                <select id="bookName" name="bookName" class="form-control">
                    <?php
                    $host = "localhost";
                    $username = "root";
                    $password = "";
                    $database = "book_task";

                    $conn = new mysqli($host, $username, $password, $database);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT DISTINCT name FROM booktask_table";
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
                </select>
            </div>

            <div class="form-group">
                <label for="studentName">Select a Student Name:</label>
                <select id="studentName" name="studentName" class="form-control">
                    <?php
                    $conn = new mysqli($host, $username, $password, $database);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM student_table";
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
                </select>
            </div>

            <div class="form-group">
                <label for="startDate">Start Date:</label>
                <input type="date" id="startDate" name="startDate" class="form-control">
            </div>

            <div class="form-group">
                <label for="endDate">End Date:</label>
                <input type="date" id="endDate" name="endDate" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>

</body>

</html>
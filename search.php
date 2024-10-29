<?php
require "connect/_connect.php";
$found = false;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = htmlspecialchars($_POST['id']);
    $sql = "Select * from students where id = '$id'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_fetch_row($result);

    if (mysqli_num_rows($result) > 0) {
        $found = true;
        mysqli_data_seek($result, 0);
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Search Stuent</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="my-5">
    <div class="container">
        <form action="search.php" method="post">
            <input type="text" class="form-control" id="inputPassword2" placeholder="Enter student id to search" name="id">
            <div class="my-2">
                <button type="submit" class="btn btn-primary mb-3">Search</button>
            </div>
        </form>
    </div>
    <?php
    if ($found) {
        echo '<table class="table table-bordered my-3"><thead><tr><th>Id</th><th>Name</th><th>Email</th><th>Course</th><th>Semester</th><th>Gender</th><th>Mobile No.</th></tr></thead><tbody>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr><td>' . $row['id'] . '</td><td>' . $row['name'] . '</td><td>' . $row['email'] . '</td><td>' . $row['course'] . '</td><td>' . $row['semester'] . '</td><td>' . $row['gender'] . '</td><td>' . $row['mobileno'] . '</td></tr>';
        }
        echo '</tbody></table>';
    } else if ($_SERVER['REQUEST_METHOD'] == "POST") {
        echo '<p class="text-danger">No student found with this ID.</p>';
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
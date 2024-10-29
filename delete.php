<?php
require "connect/_connect.php";
$found = false;
$message = ""; 
$studentData = null; 

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['view'])) {
    $del = htmlspecialchars($_POST['del']);
    if (!is_numeric($del)) {
        $message = '<p class="text-danger">Invalid student ID. Please enter a numeric value.</p>';
    } else {
        $sql = "SELECT * FROM students WHERE id = '$del'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $studentData = mysqli_fetch_assoc($result);
            $found = true; 
        } else {
            $message = '<p class="text-danger">No student found with this ID.</p>';
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['delete'])) {
    // Proceed with deletion
    $del = htmlspecialchars($_POST['del']);
    $sql = "DELETE FROM students WHERE id = '$del'";
    mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
        $message = "Student with ID $del deleted successfully.";
    } else {
        $message = '<p class="text-danger">No student found with this ID.</p>';
    }
}
mysqli_close($conn);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Delete Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="my-5">
    <div class="container">
        <form action="delete.php" method="post">
            <input type="text" class="form-control" id="inputPassword2" placeholder="Enter student id to delete" name="del" required>
            <div class="my-2">
                <button type="submit" name="view" class="btn btn-primary mb-3">View Student</button>
            </div>
        </form>
        <?php
        if ($message) {
            echo $message;
        }
        if ($found && $studentData) {
            echo '<div class="alert alert-warning my-3">Are you sure you want to delete the following student?</div>';
            echo '<table class="table table-bordered">';
            echo '<thead><tr><th>Id</th><th>Name</th><th>Email</th><th>Course</th><th>Semester</th><th>Gender</th><th>Mobile No.</th></tr></thead>';
            echo '<tbody>';
            echo '<tr><td>' . $studentData['id'] . '</td><td>' . $studentData['name'] . '</td><td>' . $studentData['email'] . '</td><td>' . $studentData['course'] . '</td><td>' . $studentData['semester'] . '</td><td>' . $studentData['gender'] . '</td><td>' . $studentData['mobileno'] . '</td></tr>';
            echo '</tbody></table>';
            echo '<form action="delete.php" method="post">';
            echo '<input type="hidden" name="del" value="' . $studentData['id'] . '">';
            echo '<button type="submit" name="delete" class="btn btn-danger">Confirm Delete</button>';
            echo '</form>';
        }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
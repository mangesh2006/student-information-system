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
} elseif ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['update'])) {
    $oldId = htmlspecialchars($_POST['old_id']);
    $newId = htmlspecialchars($_POST['del']);
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $course = htmlspecialchars($_POST['course']);
    $semester = htmlspecialchars($_POST['semester']);
    $gender = htmlspecialchars($_POST['gender']);
    $mobileno = htmlspecialchars($_POST['mobileno']);
    $sql = "UPDATE students SET id='$newId', name='$name', email='$email', course='$course', semester='$semester', gender='$gender', mobileno='$mobileno' WHERE id='$oldId'";
    mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
        $message = "Student with ID $oldId updated successfully to ID $newId.";
    } else {
        $message = '<p class="text-danger">Failed to update. No student found with this ID.</p>';
    }
}
mysqli_close($conn);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="my-5">
    <div class="container">
        <form action="update.php" method="post">
            <input type="text" class="form-control" id="inputPassword2" placeholder="Enter student id to update" name="del" required>
            <div class="my-2">
                <button type="submit" name="view" class="btn btn-primary mb-3">View Student</button>
            </div>
        </form>
        <?php
        if ($message) {
            echo $message;
        }
        if ($found && $studentData) {
            echo '<div class="alert alert-warning my-3">Update the following student details:</div>';
            echo '<form action="update.php" method="post">';
            echo '<input type="hidden" name="old_id" value="' . $studentData['id'] . '">'; // Store the old ID for the update query
            echo '<div class="mb-3">';
            echo '<label for="id" class="form-label">ID</label>';
            echo '<input type="text" class="form-control" id="id" name="del" value="' . $studentData['id'] . '" required>';
            echo '</div>';
            echo '<div class="mb-3">';
            echo '<label for="name" class="form-label">Name</label>';
            echo '<input type="text" class="form-control" id="name" name="name" value="' . $studentData['name'] . '" required>';
            echo '</div>';
            echo '<div class="mb-3">';
            echo '<label for="email" class="form-label">Email</label>';
            echo '<input type="email" class="form-control" id="email" name="email" value="' . $studentData['email'] . '" required>';
            echo '</div>';
            echo '<div class="mb-3">';
            echo '<label for="course" class="form-label">Course</label>';
            echo '<input type="text" class="form-control" id="course" name="course" value="' . $studentData['course'] . '" required>';
            echo '</div>';
            echo '<div class="mb-3">';
            echo '<label for="semester" class="form-label">Semester</label>';
            echo '<input type="text" class="form-control" id="semester" name="semester" value="' . $studentData['semester'] . '" required>';
            echo '</div>';
            echo '<div class="mb-3">';
            echo '<label for="gender" class="form-label">Gender</label>';
            echo '<input type="text" class="form-control" id="gender" name="gender" value="' . $studentData['gender'] . '" required>';
            echo '</div>';
            echo '<div class="mb-3">';
            echo '<label for="mobileno" class="form-label">Mobile No.</label>';
            echo '<input type="text" class="form-control" id="mobileno" name="mobileno" value="' . $studentData['mobileno'] . '" required>';
            echo '</div>';
            echo '<button type="submit" name="update" class="btn btn-success">Update</button>';
            echo '</form>';
        }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
<?php
require "connect/_connect.php";
if (!$conn) {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Error</strong> Error while connecting to database.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
} else {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $course = htmlspecialchars($_POST['course']);
        $semester = htmlspecialchars($_POST['semester']);
        $gender = htmlspecialchars($_POST['gender']);
        $mobileno = htmlspecialchars($_POST['mobileno']);

        $sql = "Insert into students(name, email, course, semester, gender, mobileno) values ('$name', '$email', '$course', '$semester', '$gender', '$mobileno')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success</strong> Your record inserted successfully.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Success</strong> Your record not inserted.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        .container {
            border: 2px solid black;
            border-radius: 10px;
        }
    </style>
</head>

<body class="my-5">
    <div class="container">
        <form method="post" action="add.php">
            <div class="mb-3" require>
                <label for="name" class="form-label my-2">Name</label>
                <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name" placeholder="Enter Your Name" require>
            </div>
            <div class="mb-3" require>
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email" require>
            </div>
            <div class="mb-3" require>
                <label for="course" class="form-label">Course</label>
                <input type="text" class="form-control" id="course" name="course" placeholder="Enter Your Course" require>
            </div>
            <div class="mb-3" require>
                <label for="semester" class="form-label">Semeter</label>
                <input type="text" class="form-control" id="semester" name="semester" placeholder="Enter Your Semester" require>
            </div>
            <div class="mb-3 form-check" require>
                <input type="radio" class="form-check-input" id="gender" value="Male" name="gender" require>
                <label class="form-check-label" for="male">Male</label>
            </div>
            <div class="mb-3 form-check" require>
                <input type="radio" class="form-check-input" id="gender" value="Female" name="gender" require>
                <label class="form-check-label" for="male">Female</label>
            </div>
            <div class="mb-3" require>
                <label for="mobileno" class="form-label">Mobile no</label>
                <input type="tel" class="form-control" id="mobileno" name="mobileno" placeholder="Enter Your Mobile No." pattern="[0-9]{10}" require>
            </div>
            <button type="submit" class="btn btn-primary my-2">Submit</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
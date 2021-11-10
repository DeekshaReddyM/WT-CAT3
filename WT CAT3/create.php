<?php
// include connection
include 'db_connection.php';

// declare varibales and initialize with empty values
$idErr = $nameErr = $emailErr = $courseErr = $ageErr = $genderErr = $addressErr = "";
$id = $name = $email = $course = $age = $gender = $address = "";

// processing form data when form is submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["id"])) {
        $idErr = "*This field is required";
    } else {
        $id = test_input($_POST["id"]);
        // check if fname contains only letters
        if (!ctype_alpha($fname)) {
            $idErr = "Only numbers are allowed";
        }
    }

    if (empty($_POST["name"])) {
        $nameErr = "This field is required";
    } else {
        $name = test_input($_POST["name"]);
        // check if lname contains only letters
        if (!ctype_alpha($name)) {
            $nameErr = "Only letters are allowed";
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "*This field is required";
    } else {
        $email = test_input($_POST["email"]);
        // check e-mail address is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email address";
        }
    }

    if (empty($_POST["course"])) {
        $courseErr = "*This field is required";
    } else {
        $course = test_input($_POST["course"]);
    }

    if (empty($_POST["age"])) {
        $batchErr = "*This field is required";
    } else {
        $age = test_input($_POST["age"]);
        /* check if batch contains numbers only, also 
        check min and max value to be entered */
        if (!ctype_digit($age)) {
            $ageErr = "Age must be a numeric value";
        } elseif ($batch < 2013) {
            $ageErr = "Age must be greater than or equal to 20";
        } elseif ($batch > 2021) {
            $ageErr = "Batch must be less than or equal to 19";
        } else {
            // no code will execute
        }
    }

    if (empty($_POST["gender"])) {
        $genderErr = "*This field is required";
    } else {
        $gender = test_input($_POST["gender"]);
    }

    if (empty($_POST["address"])) {
        $addressErr = "*This field is required";
    } else {
        $address = test_input($_POST["address"]);
    }

    // if no errors then insert data into databse
    if (empty($idErr) && empty($nameErr) && empty($emailErr) && empty($courseErr) && empty($ageErr) && empty($genderErr) && empty($addressErr)) {

        $sql = "INSERT INTO students (id, name, email, course, age, gender, address) VALUES ('$fname', '$lname', '$email', '$course', '$batch' , '$city', '$state')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('New record created successfully');</script>";
            echo "<script>window.location.href='http://localhost/student/index.php';</script>";
            exit();
        }
    }
    mysqli_close($conn);
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <title>Create Data - PHP CRUD</title>
</head>

<body>
    <!-- submit form -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <h3 class="mb-4 text-center">Create Record</h3>
                <div class="form-body bg-light p-4">
                    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label for="id" class="form-label">id*</label>
                                <input type="text" class="form-control" id="id" name="id" value="<?= $id; ?>">
                                <small class="text-danger"><?= $idErr; ?></small>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="name" class="form-label">name*</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= $name; ?>">
                                <small class="text-danger"><?= $nameErr; ?></small>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="email" class="form-label">Email Address*</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= $email; ?>">
                                <small class="text-danger"><?= $emailErr; ?></small>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="course" class="form-label">Course*</label>
                                <input type="text" class="form-control" id="course" name="course" value="<?= $course; ?>">
                                <small class="text-danger"><?= $courseErr; ?></small>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="age" class="form-label">age*</label>
                                <input type="text" class="form-control" id="age" name="age" value="<?= $age; ?>">
                                <small class="text-danger"><?= $ageErr; ?></small>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="gender" class="form-label">gender*</label>
                                <input type="text" class="form-control" id="gender" name="gender" value="<?= $gender; ?>">
                                <small class="text-danger"><?= $cityErr; ?></small>
                            </div>
                            <div class="col-lg-6 mb-4">
                                <label for="address" class="form-label">address*</label>
                                <input type="text" class="form-control" id="address" name="address" value="<?= $address; ?>">
                                <small class="text-danger"><?= $stateErr; ?></small>
                            </div>
                            <div class="col-lg-12">
                                <input type="submit" class="btn btn-primary form-control" name="submit" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
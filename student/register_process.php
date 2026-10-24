
```php
<?php

include("../database/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $name = $_POST['name'];
    $rollno = $_POST['rollno'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $department = $_POST['department'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check Email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        echo "<script>
                alert('Invalid Email');
                window.location='register.php';
              </script>";
        exit();
    }

    // Check Password
    if ($password != $confirm_password)
    {
        echo "<script>
                alert('Passwords do not match');
                window.location='register.php';
              </script>";
        exit();
    }

    // Check duplicate roll number
    $check = "SELECT * FROM students WHERE roll_no='$rollno'";

    $result = mysqli_query($conn, $check);

    if (!$result)
    {
        die("Check Error: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) > 0)
    {
        echo "<script>
                alert('Roll Number already registered');
                window.location='register.php';
              </script>";
        exit();
    }

    // Insert data
    $sql = "INSERT INTO students
            (name, roll_no, email, phone, department, password)
            VALUES
            ('$name',
             '$rollno',
             '$email',
             '$phone',
             '$department',
             '$password')";

    if (mysqli_query($conn, $sql))
    {
        echo "<script>
                alert('Registration Successful!');
                window.location='login.php';
              </script>";

        exit();
    }
    else
    {
        die("Registration Failed: " . mysqli_error($conn));
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Student Registration</title>

    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f2f2f2;

            display: flex;
            justify-content: center;
            align-items: center;

            min-height: 100vh;
        }

        .register-box {
            width: 420px;

            background: white;

            padding: 30px;

            border-radius: 12px;

            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }

        .register-box h2 {
            text-align: center;

            margin-bottom: 25px;

            color: #333;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            display: block;

            margin-bottom: 6px;

            font-weight: bold;

            color: #333;
        }

        .input-group input,
        .input-group select {
            width: 100%;

            padding: 11px;

            border: 1px solid #ccc;

            border-radius: 6px;

            font-size: 15px;

            outline: none;
        }

        .input-group input:focus,
        .input-group select:focus {
            border-color: #007bff;
        }

        button {
            width: 100%;

            padding: 12px;

            background: #007bff;

            color: white;

            border: none;

            border-radius: 6px;

            font-size: 16px;

            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        .login-link {
            text-align: center;

            margin-top: 15px;
        }

        .login-link a {
            color: #007bff;

            text-decoration: none;
        }

    </style>

</head>

<body>

<div class="register-box">

    <h2>Student Registration</h2>

    <form method="POST" action="">

        <!-- NAME -->

        <div class="input-group">

            <label>Name</label>

            <input
                type="text"
                name="name"
                placeholder="Enter your name"
                required
            >

        </div>


        <!-- ROLL NUMBER -->

        <div class="input-group">

            <label>Roll Number</label>

            <input
                type="text"
                name="rollno"
                placeholder="Enter roll number"
                required
            >

        </div>


        <!-- EMAIL -->

        <div class="input-group">

            <label>Email</label>

            <input
                type="text"
                name="email"
                placeholder="Enter email"
                required
                oninvalid="this.setCustomValidity('Invalid Email')"
                oninput="this.setCustomValidity('')"
            >

        </div>


        <!-- PHONE -->

        <div class="input-group">

            <label>Phone</label>

            <input
                type="text"
                name="phone"
                placeholder="Enter phone number"
                required
            >

        </div>


        <!-- DEPARTMENT -->

        <div class="input-group">

            <label>Department</label>

            <select name="department" required>

                <option value="">
                    Select Department
                </option>

                <option value="CSE">
                    CSE
                </option>

                <option value="ECE">
                    ECE
                </option>

                <option value="EEE">
                    EEE
                </option>

                <option value="MECH">
                    MECH
                </option>

                <option value="CIVIL">
                    CIVIL
                </option>

            </select>

        </div>


        <!-- PASSWORD -->

        <div class="input-group">

            <label>Password</label>

            <input
                type="password"
                name="password"
                placeholder="Enter password"
                required
            >

        </div>


        <!-- CONFIRM PASSWORD -->

        <div class="input-group">

            <label>Confirm Password</label>

            <input
                type="password"
                name="confirm_password"
                placeholder="Confirm password"
                required
            >

        </div>


        <!-- REGISTER BUTTON -->

        <button type="submit">
            Register
        </button>

    </form>


    <div class="login-link">

        Already have an account?

        <a href="login.php">
            Login
        </a>

    </div>

</div>

</body>

</html>
```

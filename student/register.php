<!DOCTYPE html>
<html>

<head>

    <title>Student Registration</title>

    <!-- CSS FILE -->
    <link rel="stylesheet" href="../css/register.css">

</head>

<body class="register-page">

<div class="register-container">

    <div class="logo">
        <img src="../images/college-logo.png" width="90">
    </div>

    <h1>SMART STUDENT COMPLAINT MANAGEMENT SYSTEM</h1>

    <h2>Create New Account</h2>

    <form action="register_process.php" method="POST">

        <input type="text"
               name="name"
               placeholder="Enter Full Name"
               required>


        <input type="text"
               name="rollno"
               placeholder="Enter Roll Number"
               required>


        <input type="email"
               name="email"
               placeholder="Enter Email Address"
               required>


        <input type="text"
               name="phone"
               placeholder="Enter Mobile Number"
               required>


        <select name="department" required>

            <option value="">
                Select Department
            </option>

            <option>CME</option>
            <option>ECE</option>
            <option>MECH</option>

        </select>


        <!-- CREATE PASSWORD -->

        <input type="password"
               name="password"
               placeholder="Create Password"
               required>


        <!-- CONFIRM PASSWORD -->

        <input type="password"
               name="confirm_password"
               placeholder="Confirm Password"
               required>


        <!-- REGISTER BUTTON -->

        <button type="submit">
            REGISTER
        </button>


        <p>

            Already have an account?

            <a href="login.php">
                Login Here
            </a>

        </p>

    </form>

</div>

</body>

</html>
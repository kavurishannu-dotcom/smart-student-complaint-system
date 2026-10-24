<?php

session_start();

include("../database/db.php");

$message = "";

if(isset($_POST['login']))
{
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM admin
            WHERE email='$email'
            AND password='$password'";

    $result = mysqli_query($conn, $sql);

    if(!$result)
    {
        die("Database Error: " . mysqli_error($conn));
    }

    if(mysqli_num_rows($result) == 1)
    {
        $admin = mysqli_fetch_assoc($result);

        // CREATE ADMIN SESSION

        $_SESSION['admin_id'] =
            $admin['id'];

        $_SESSION['admin_username'] =
            $admin['username'];

        $_SESSION['admin_email'] =
            $admin['email'];


        // REDIRECT TO DASHBOARD

        header("Location: admin_dashboard.php");

        exit();
    }
    else
    {
        $message = "Invalid Email or Password";
    }
}

?>


<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Admin Login - SSCMS</title>


<style>


/* RESET */

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial,sans-serif;
}


/* BODY */

body{

    min-height:100vh;

    display:flex;

    justify-content:center;

    align-items:center;

    background:linear-gradient(
        135deg,
        #172b4d,
        #3b5998
    );

}


/* LOGIN BOX */

.login-box{

    width:400px;

    max-width:90%;

    background:white;

    padding:35px;

    border-radius:15px;

    box-shadow:0 10px 30px rgba(0,0,0,.3);

    text-align:center;

}


/* LOGO */

.logo{

    width:90px;

    height:90px;

    object-fit:contain;

    margin-bottom:15px;

}


/* HEADING */

h2{

    color:#172b4d;

    margin-bottom:25px;

}


/* NORMAL INPUT */

input{

    width:100%;

    padding:13px;

    margin:10px 0;

    border:1px solid #ccc;

    border-radius:6px;

    font-size:16px;

    outline:none;

}


input:focus{

    border-color:#172b4d;

}


/* PASSWORD CONTAINER */

.password-box{

    position:relative;

    width:100%;

}


/* PASSWORD INPUT */

.password-box input{

    width:100%;

    padding:13px 50px 13px 13px;

    margin:10px 0;

}


/* SHOW/HIDE BUTTON */

.password-toggle{

    position:absolute;

    right:8px;

    top:50%;

    transform:translateY(-50%);

    width:40px;

    height:40px;

    margin:0;

    padding:5px;

    background:transparent;

    border:none;

    cursor:pointer;

    display:flex;

    align-items:center;

    justify-content:center;

}


/* REMOVE BUTTON HOVER COLOR */

.password-toggle:hover{

    background:transparent;

}


/* EYE IMAGE - ONLY THIS IS LIGHT PURPLE */

.password-toggle img{

    width:25px;

    height:25px;

    object-fit:contain;

    filter:
        sepia(30%)
        saturate(700%)
        hue-rotate(220deg)
        brightness(110%)
        contrast(85%);

}


/* LOGIN BUTTON */

.login-button{

    width:100%;

    padding:13px;

    margin-top:15px;

    background:#172b4d;

    color:white;

    border:none;

    border-radius:6px;

    font-size:17px;

    cursor:pointer;

}


.login-button:hover{

    background:#263f68;

}


/* ERROR */

.error{

    color:red;

    margin-bottom:10px;

}


/* LINKS */

.links{

    margin-top:20px;

}


.links a{

    display:block;

    margin:10px;

    color:#172b4d;

    text-decoration:none;

    font-weight:bold;

}


.links a:hover{

    text-decoration:underline;

}

</style>

</head>


<body>


<div class="login-box">


<!-- COLLEGE LOGO -->

<img
    src="../images/college-logo.png"
    alt="College Logo"
    class="logo">


<!-- TITLE -->

<h2>👨‍💼 Admin Login</h2>


<?php

if($message != "")
{
    echo "<p class='error'>" .
         htmlspecialchars($message) .
         "</p>";
}

?>


<!-- LOGIN FORM -->

<form method="POST">


<!-- EMAIL -->

<input
    type="email"
    name="email"
    placeholder="Enter Admin Email"
    required>


<!-- PASSWORD -->

<div class="password-box">

    <input
        type="password"
        name="password"
        id="adminPassword"
        placeholder="Enter Password"
        required>


    <button
        type="button"
        class="password-toggle"
        onclick="togglePassword()">

        <img
            id="passwordIcon"
            src="../images/hide-password.png"
            alt="Show Password">

    </button>

</div>


<!-- LOGIN BUTTON -->

<button
    type="submit"
    name="login"
    class="login-button">

    🔐 Login

</button>


</form>


<!-- LINKS -->

<div class="links">


<a href="admin_forgot_password.php">

🔑 Forgot Password?

</a>


<a href="../index.php">

🏠 Back to Home

</a>


</div>


</div>


<!-- SHOW / HIDE PASSWORD SCRIPT -->

<script>

function togglePassword()
{

    const password =
        document.getElementById("adminPassword");

    const icon =
        document.getElementById("passwordIcon");


    if(password.type === "password")
    {

        // SHOW PASSWORD

        password.type = "text";

        icon.src =
            "../images/show-password.png";

        icon.alt =
            "Hide Password";

    }
    else
    {

        // HIDE PASSWORD

        password.type = "password";

        icon.src =
            "../images/hide-password.png";

        icon.alt =
            "Show Password";

    }

}

</script>


</body>

</html>
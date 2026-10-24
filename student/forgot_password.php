<?php

include("../database/db.php");

$message = "";
$message_type = "";

if(isset($_POST['reset']))
{
    $roll = trim($_POST['roll']);
    $email = trim($_POST['email']);
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);

    /* Check passwords */
    if($new_password != $confirm_password)
    {
        $message = "Passwords do not match";
        $message_type = "error";
    }
    else
    {
        /* Check student */
        $sql = "SELECT * FROM students
                WHERE roll_no='$roll'
                AND email='$email'";

        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) == 1)
        {
            /* Update password */
            $update = "UPDATE students
                       SET password='$new_password'
                       WHERE roll_no='$roll'
                       AND email='$email'";

            if(mysqli_query($conn, $update))
            {
                $message = "Password reset successful! You can now login.";
                $message_type = "success";
            }
            else
            {
                $message = "Password update failed";
                $message_type = "error";
            }
        }
        else
        {
            $message = "Roll Number and Email do not match";
            $message_type = "error";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Forgot Password - SSCMS</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial,sans-serif;
}

body{

    min-height:100vh;

    display:flex;

    justify-content:center;

    align-items:center;

    background:linear-gradient(
        135deg,
        #0b4f9c,
        #4ea3ff
    );

}

.box{

    width:420px;

    max-width:90%;

    background:white;

    padding:35px;

    border-radius:15px;

    box-shadow:0 10px 30px
    rgba(0,0,0,.3);

    text-align:center;

}

.logo{

    width:90px;

    height:90px;

    object-fit:contain;

    margin-bottom:15px;

}

h2{

    color:#003366;

    margin-bottom:25px;

}

input{

    width:100%;

    padding:13px;

    margin:10px 0;

    border:1px solid #ccc;

    border-radius:6px;

    font-size:16px;

}

button{

    width:100%;

    padding:13px;

    margin-top:15px;

    background:#003366;

    color:white;

    border:none;

    border-radius:6px;

    font-size:17px;

    cursor:pointer;

}

button:hover{

    background:#0055aa;

}

.message{

    padding:10px;

    margin-bottom:15px;

    border-radius:6px;

}

.error{

    color:#b00020;

    background:#ffe5e5;

}

.success{

    color:green;

    background:#e5ffe5;

}

.links{

    margin-top:20px;

}

.links a{

    display:block;

    margin:10px;

    color:#003366;

    text-decoration:none;

    font-weight:bold;

}

</style>

</head>

<body>

<div class="box">

    <img src="../images/college-logo.png"
         class="logo">

    <h2>🔑 Forgot Password</h2>

    <?php

    if($message != "")
    {
        echo "<p class='message $message_type'>";
        echo $message;
        echo "</p>";
    }

    ?>

    <form method="POST">

        <input
            type="text"
            name="roll"
            placeholder="Enter Roll Number"
            required
        >

        <input
            type="email"
            name="email"
            placeholder="Enter Registered Email"
            required
        >

        <input
            type="password"
            name="new_password"
            placeholder="Enter New Password"
            required
        >

        <input
            type="password"
            name="confirm_password"
            placeholder="Confirm New Password"
            required
        >

        <button
            type="submit"
            name="reset">

            🔄 Reset Password

        </button>

    </form>

    <div class="links">

        <a href="login.php">
            🔐 Back to Login
        </a>

        <a href="../index.php">
            🏠 Back to Home
        </a>

    </div>

</div>

</body>

</html>
<?php

include("../database/db.php");

$message = "";

if(isset($_POST['reset']))
{
    $email = trim($_POST['email']);
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);

    if($new_password != $confirm_password)
    {
        $message = "Passwords do not match";
    }
    else
    {
        $check = "SELECT * FROM admin
                  WHERE email='$email'";

        $result = mysqli_query($conn, $check);

        if(mysqli_num_rows($result) == 1)
        {
            $update = "UPDATE admin
                       SET password='$new_password'
                       WHERE email='$email'";

            if(mysqli_query($conn, $update))
            {
                echo "<script>

                    alert('Password Reset Successfully');

                    window.location='admin_login.php';

                </script>";

                exit();
            }
            else
            {
                $message = "Password update failed";
            }
        }
        else
        {
            $message = "Email not found";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width,
      initial-scale=1.0">

<title>Admin Forgot Password - SSCMS</title>

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
        #172b4d,
        #3b5998
    );

}

.box{

    width:400px;

    max-width:90%;

    background:white;

    padding:35px;

    border-radius:15px;

    box-shadow:0 10px 30px
    rgba(0,0,0,.3);

    text-align:center;

}

h2{

    color:#172b4d;

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

    background:#172b4d;

    color:white;

    border:none;

    border-radius:6px;

    font-size:17px;

    cursor:pointer;

}

button:hover{

    background:#3b5998;

}

.error{

    color:red;

    margin-bottom:15px;

}

a{

    display:block;

    margin-top:20px;

    color:#172b4d;

    text-decoration:none;

    font-weight:bold;

}

</style>

</head>

<body>

<div class="box">

    <h2>🔑 Admin Forgot Password</h2>

    <?php

    if($message != "")
    {
        echo "<p class='error'>";
        echo $message;
        echo "</p>";
    }

    ?>

    <form method="POST">

        <input
            type="email"
            name="email"
            placeholder="Enter Admin Email"
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

    <a href="admin_login.php">

        🔐 Back to Admin Login

    </a>

</div>

</body>

</html>
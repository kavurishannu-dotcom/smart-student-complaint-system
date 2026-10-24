
<?php

session_start();

include("../database/db.php");

$message = "";

if(isset($_POST['login']))
{
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM departments
            WHERE username='$username'
            AND password='$password'";

    $result = mysqli_query($conn, $sql);

    if(!$result)
    {
        die("Database Error: " . mysqli_error($conn));
    }

    if(mysqli_num_rows($result) == 1)
    {
        $department = mysqli_fetch_assoc($result);

        $_SESSION['department_id'] =
            $department['id'];

        $_SESSION['department_user'] =
            $department['username'];

        $_SESSION['department_name'] =
            $department['department_name'];

        header("Location: department_dashboard.php");
        exit();
    }
    else
    {
        $message = "Invalid Username or Password";
    }
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Department Login - SSCMS</title>


<!-- FONT AWESOME -->

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


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
        #164a41,
        #4caf50
    );

}


.login-box{

    width:400px;

    max-width:90%;

    background:white;

    padding:35px;

    border-radius:15px;

    box-shadow:0 10px 30px rgba(0,0,0,.3);

    text-align:center;

}


.logo{

    width:90px;

    height:90px;

    object-fit:contain;

    margin-bottom:15px;

}


h2{

    color:#164a41;

    margin-bottom:25px;

}


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

    border-color:#164a41;

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

    border:1px solid #ccc;

    border-radius:6px;

    font-size:16px;

}


/* EYE ICON */

.password-box i{

    position:absolute;

    right:15px;

    top:50%;

    transform:translateY(-50%);

    cursor:pointer;

    color:#164a41;

    font-size:19px;

    z-index:2;

}


.password-box i:hover{

    color:#26796a;

}


/* LOGIN BUTTON */

.login-button{

    width:100%;

    padding:13px;

    margin-top:15px;

    background:#164a41;

    color:white;

    border:none;

    border-radius:6px;

    font-size:17px;

    cursor:pointer;

}


.login-button:hover{

    background:#26796a;

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

    color:#164a41;

    text-decoration:none;

    font-weight:bold;

}


.links a:hover{

    color:#26796a;

    text-decoration:underline;

}

</style>

</head>


<body>


<div class="login-box">


<!-- COLLEGE LOGO -->

<img
    src="../images/college-logo.png"
    class="logo"
    alt="College Logo">


<!-- TITLE -->

<h2>

🏢 Department Login

</h2>


<!-- ERROR MESSAGE -->

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


<!-- USERNAME -->

<input

    type="text"

    name="username"

    placeholder="Enter Username"

    required>


<!-- PASSWORD -->

<div class="password-box">

    <input

        type="password"

        id="password"

        name="password"

        placeholder="Enter Password"

        required>


    <i

        class="fa-solid fa-eye"

        id="togglePassword"

        title="Show Password">

    </i>

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


<a href="forgot_password.php">

🔑 Forgot Password?

</a>


<a href="department_register.php">

📝 New Department? Register

</a>


<a href="../index.php">

🏠 Back to Home

</a>


</div>


</div>


<!-- SHOW / HIDE PASSWORD SCRIPT -->

<script>

const togglePassword =
document.getElementById("togglePassword");

const password =
document.getElementById("password");


togglePassword.addEventListener("click", function()
{

    if(password.type === "password")
    {

        // SHOW PASSWORD

        password.type = "text";

        this.classList.remove("fa-eye");

        this.classList.add("fa-eye-slash");

        this.title = "Hide Password";

    }

    else
    {

        // HIDE PASSWORD

        password.type = "password";

        this.classList.remove("fa-eye-slash");

        this.classList.add("fa-eye");

        this.title = "Show Password";

    }

});

</script>


</body>

</html>

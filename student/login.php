<?php

session_start();

include("../database/db.php");

$message = "";

if(isset($_POST['login']))
{
    $roll = trim($_POST['roll']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM students 
            WHERE roll_no='$roll' 
            AND password='$password'";

    $result = mysqli_query($conn, $sql);

    if(!$result)
    {
        die("Database Error: " . mysqli_error($conn));
    }

    if(mysqli_num_rows($result) == 1)
    {
        $student = mysqli_fetch_assoc($result);

        // CHECK STUDENT BLOCK STATUS
        if(isset($student['status']) && $student['status'] == "blocked")
        {
            $message = "Your account is blocked by department. Contact admin.";
        }
        else
        {
            $_SESSION['student_id'] = $student['id'];
            $_SESSION['student_name'] = $student['name'];
            $_SESSION['roll_no'] = $student['roll_no'];
            $_SESSION['department'] = $student['department'];

            header("Location: dashboard.php");
            exit();
        }
    }
    else
    {
        $message = "Invalid Roll Number or Password";
    }
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Student Login - SSCMS</title>


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
        #0b4f9c,
        #4ea3ff
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

    outline:none;

}


input:focus{

    border-color:#003366;

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

    color:#003366;

    font-size:19px;

    z-index:2;

}


.password-box i:hover{

    color:#0055aa;

}


/* LOGIN BUTTON */

.login-button{

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


.login-button:hover{

    background:#0055aa;

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

    color:#003366;

    text-decoration:none;

    font-weight:bold;

}


.links a:hover{

    color:#0055aa;

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

🎓 Student Login

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


<!-- ROLL NUMBER -->

<input

    type="text"

    name="roll"

    placeholder="Enter Roll Number"

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


<a href="register.php">

📝 New Student? Register

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
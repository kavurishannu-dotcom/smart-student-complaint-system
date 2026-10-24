<?php
session_start();

include "../config/connection.php";


/* Check login */
if(!isset($_SESSION['student_id'])){
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['student_id'];


/* Get student details */
$query = "SELECT * FROM students WHERE id='$student_id'";

$result = mysqli_query($conn,$query);


if(!$result){
    die("Database Error: ".mysqli_error($conn));
}


$student = mysqli_fetch_assoc($result);


if(!$student){
    die("Student record not found");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Student Profile</title>

<link rel="stylesheet" 
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

body{
    margin:0;
    font-family:Arial,sans-serif;
    background:linear-gradient(135deg,#1b5e20,#66bb6a);
}


/* PROFILE BOX */
body{

    margin:0;

    font-family:Arial,sans-serif;

    min-height:100vh;

    background:linear-gradient(
        -45deg,
        #1b5e20,
        #43a047,
        #2196f3,
        #9c27b0
    );

    background-size:400% 400%;

    animation:backgroundMove 10s ease infinite;

}


/* Animated Background */

@keyframes backgroundMove{

    0%{
        background-position:0% 50%;
    }

    50%{
        background-position:100% 50%;
    }

    100%{
        background-position:0% 50%;
    }

}
.profile-container{

    width:400px;

    margin:70px auto;

    background:rgba(255,255,255,0.9);

    padding:30px;

    border-radius:20px;

    text-align:center;

    box-shadow:0 10px 30px rgba(0,0,0,0.3);

    animation:cardMove 2s ease;

}


@keyframes cardMove{

    from{

        opacity:0;

        transform:translateY(50px);

    }

    to{

        opacity:1;

        transform:translateY(0);

    }

}


/* USER ICON */

.profile-icon{

    width:90px;
    height:90px;
    margin:auto;
    background:#1b5e20;
    color:white;
    border-radius:50%;

    display:flex;
    justify-content:center;
    align-items:center;

    font-size:40px;

}


h2{

    color:#1b5e20;
    margin-top:20px;

}


/* DETAILS */

.profile-details{

    text-align:left;
    margin-top:25px;

}


.profile-details p{

    padding:10px;
    font-size:16px;
    border-bottom:1px solid #ddd;

}


/* BUTTON */

.btn{

    display:inline-block;
    margin-top:25px;
    padding:12px 25px;

    background:#1b5e20;
    color:white;

    text-decoration:none;
    border-radius:8px;

}


.btn:hover{

    background:#2e7d32;

}


/* BACK ARROW */

.back-arrow{

    position:fixed;
    top:15px;
    left:15px;

    width:35px;
    height:35px;

    background:#1b5e20;
    color:white;

    border-radius:50%;

    display:flex;
    justify-content:center;
    align-items:center;

    text-decoration:none;
    font-size:16px;

}


.back-arrow:hover{

    background:#2e7d32;

}


</style>

</head>


<body>


<!-- Back to Dashboard/Login -->

<a href="dashboard.php" class="back-arrow">

<i class="fas fa-arrow-left"></i>

</a>



<div class="profile-container">


<div class="profile-icon">

<i class="fas fa-user"></i>

</div>


<h2>
Student Profile
</h2>



<div class="profile-details">


<p>
<b>Name:</b>
<?php echo $student['name']; ?>
</p>


<p>
<b>Email:</b>
<?php echo $student['email']; ?>
</p>


<p>
<b>Phone:</b>
<?php echo $student['phone']; ?>
</p>


<p>
<b>Department:</b>
<?php echo $student['department']; ?>
</p>


<p>
<b>Roll Number:</b>
<?php echo $student['roll_no']; ?>
</p>


</div>



<a href="dashboard.php" class="btn">
Back Dashboard
</a>



</div>


</body>

</html>
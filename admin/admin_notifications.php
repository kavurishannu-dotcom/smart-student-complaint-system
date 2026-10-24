<?php

session_start();

include("../database/db.php");


if(!isset($_SESSION['admin_id']))
{
    header("Location: admin_login.php");
    exit();
}


$message = "";


if(isset($_POST['send']))
{

    $student_id = $_POST['student_id'];
    $notification = trim($_POST['message']);


    $sql = "INSERT INTO notifications
            (student_id, message)
            VALUES
            ('$student_id',
             '$notification')";


    if(mysqli_query($conn, $sql))
    {
        $message = "Notification Sent Successfully!";
    }
    else
    {
        $message = "Error: " . mysqli_error($conn);
    }

}



/* GET STUDENTS */

$students = mysqli_query(
    $conn,
    "SELECT id, name, roll_no
     FROM students
     ORDER BY name"
);


?>


<!DOCTYPE html>
<html>

<head>

<title>Admin Notifications - SSCMS</title>


<style>

body{

font-family:Arial;
background:#f2f6fc;
padding:30px;

}


.container{

max-width:700px;
margin:auto;
background:white;
padding:30px;
border-radius:12px;
box-shadow:0 5px 20px rgba(0,0,0,.15);

}


h1{

color:#172b4d;

}


select,
textarea,
button{

width:100%;
padding:13px;
margin:10px 0;
box-sizing:border-box;

}


textarea{

height:150px;

}


button{

background:#172b4d;
color:white;
border:none;
cursor:pointer;

}


button:hover{

background:#3b5998;

}


.success{

color:green;
margin-bottom:15px;

}


.back{

display:inline-block;
margin-top:15px;
color:#172b4d;
font-weight:bold;

}


</style>


</head>


<body>


<div class="container">


<h1>🔔 Send Notification</h1>



<?php

if($message != "")
{

echo "<p class='success'>";
echo $message;
echo "</p>";

}

?>



<form method="POST">


<select name="student_id" required>


<option value="">

Select Student

</option>



<?php


while($student = mysqli_fetch_assoc($students))

{


?>


<option value="<?php echo $student['id']; ?>">


<?php

echo $student['name'];

echo " - ";

echo $student['roll_no'];

?>


</option>



<?php

}

?>


</select>



<textarea
name="message"
placeholder="Enter notification message"
required></textarea>



<button type="submit" name="send">

🔔 Send Notification

</button>



</form>



<a href="admin_dashboard.php" class="back">

🏠 Back to Dashboard

</a>


</div>


</body>

</html>
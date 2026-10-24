<?php

session_start();

include("../database/db.php");


if(!isset($_SESSION['student_id']))
{
    header("Location: login.php");
    exit();
}


$message = "";


if(isset($_POST['submit_complaint']))
{

    $student_id = $_SESSION['student_id'];

    $title = $_POST['title'];

    $department = $_POST['department'];

    $description = $_POST['description'];



    $sql = "INSERT INTO complaints
            (student_id, department, title, description, status)
            VALUES
            ('$student_id',
             '$department',
             '$title',
             '$description',
             'Pending')";



    if(mysqli_query($conn,$sql))
    {
        $message = "Complaint Submitted Successfully!";
    }
    else
    {
        $message = "Error: ".mysqli_error($conn);
    }

}

?>


<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">


<title>
Submit Complaint - SSCMS
</title>


<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Arial,sans-serif;
}


body{

background:#f2f6fc;

}


.container{

width:600px;
max-width:90%;
margin:50px auto;
background:white;
padding:35px;
border-radius:15px;
box-shadow:0 5px 20px rgba(0,0,0,.15);

}



h1{

text-align:center;
color:#003366;
margin-bottom:25px;

}



.message{

text-align:center;
color:green;
font-weight:bold;
margin-bottom:15px;

}



input,
select,
textarea{

width:100%;
padding:13px;
margin:10px 0;
border:1px solid #ccc;
border-radius:6px;
font-size:16px;

}



textarea{

height:150px;
resize:none;

}



button{

width:100%;
padding:14px;
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



.back{

display:block;
text-align:center;
margin-top:20px;
color:#003366;
text-decoration:none;
font-weight:bold;

}

</style>


</head>


<body>


<div class="container">


<h1>
📝 Submit Complaint
</h1>



<?php

if($message!="")
{
echo "<p class='message'>$message</p>";
}

?>



<form method="POST">


<input

type="text"

name="title"

placeholder="Enter Complaint Title"

required

>



<select name="department" required>


<option value="">
Select Department
</option>


<option value="CME">
CME
</option>


<option value="ECE">
ECE
</option>


<option value="MECH">
MECH
</option>


</select>




<textarea

name="description"

placeholder="Describe your complaint..."

required>

</textarea>




<button

type="submit"

name="submit_complaint">

🚀 Submit Complaint

</button>



</form>




<a href="dashboard.php" class="back">

🏠 Back to Dashboard

</a>



</div>


</body>


</html>
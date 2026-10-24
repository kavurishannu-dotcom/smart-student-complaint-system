<?php

session_start();

include("../database/db.php");

if(!isset($_SESSION['admin_id']))
{
    header("Location: admin_login.php");
    exit();
}


$sql = "SELECT * FROM students ORDER BY id DESC";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Manage Students - SSCMS</title>


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


.sidebar{
    position:fixed;
    left:0;
    top:0;
    width:250px;
    height:100vh;
    background:#172b4d;
    color:white;
    padding:25px 15px;
}


.sidebar h2{
    text-align:center;
    margin-bottom:35px;
}


.sidebar a{
    display:block;
    padding:15px;
    margin:10px 0;
    color:white;
    text-decoration:none;
    border-radius:8px;
}


.sidebar a:hover{
    background:#3b5998;
}


.main{
    margin-left:250px;
    padding:30px;
}


.header{

    background:white;
    padding:20px;
    border-radius:10px;
    box-shadow:0 3px 10px rgba(0,0,0,.1);
    margin-bottom:25px;

}


.header h1{
    color:#172b4d;
}


.table-box{

    background:white;
    padding:25px;
    border-radius:12px;
    box-shadow:0 3px 10px rgba(0,0,0,.1);
    overflow-x:auto;

}


table{

    width:100%;
    border-collapse:collapse;
    min-width:800px;

}


th{

    background:#172b4d;
    color:white;
    padding:14px;
    text-align:left;

}


td{

    padding:13px;
    border-bottom:1px solid #ddd;

}


tr:hover{

    background:#f2f6fc;

}


.back{

    display:inline-block;
    margin-top:20px;
    padding:12px 20px;
    background:#172b4d;
    color:white;
    text-decoration:none;
    border-radius:6px;

}


.back:hover{

    background:#3b5998;

}


@media(max-width:700px){

    .sidebar{

        width:100%;
        height:auto;
        position:relative;

    }


    .main{

        margin-left:0;

    }

}

</style>


</head>


<body>


<div class="sidebar">

<h2>👨‍💼 SSCMS ADMIN</h2>


<a href="admin_dashboard.php">
🏠 Dashboard
</a>


<a href="admin_student.php">
👨‍🎓 Students
</a>


<a href="admin_complaints.php">
📝 Complaints
</a>


<a href="admin_notifications.php">
🔔 Notifications
</a>


<a href="admin_logout.php">
🚪 Logout
</a>


</div>



<div class="main">


<div class="header">

<h1>
👨‍🎓 Registered Students
</h1>

</div>



<div class="table-box">


<table>


<tr>

<th>ID</th>

<th>Name</th>

<th>Roll Number</th>

<th>Department</th>

<th>Email</th>

<th>Phone</th>

</tr>



<?php


if(mysqli_num_rows($result) > 0)

{


while($student = mysqli_fetch_assoc($result))

{


?>


<tr>


<td>

<?php echo $student['id']; ?>

</td>


<td>

<?php echo $student['name']; ?>

</td>


<td>

<?php echo $student['roll_no']; ?>

</td>


<td>

<?php echo $student['department']; ?>

</td>


<td>

<?php echo $student['email']; ?>

</td>


<td>

<?php echo $student['phone']; ?>

</td>


</tr>


<?php

}

}

else

{

echo "<tr>";
echo "<td colspan='6'>No students found</td>";
echo "</tr>";

}


?>


</table>



<a href="admin_dashboard.php" class="back">

🏠 Back to Dashboard

</a>



</div>


</div>


</body>

</html>
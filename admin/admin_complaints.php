<?php

session_start();

include("../database/db.php");

if(!isset($_SESSION['admin_id']))
{
    header("Location: admin_login.php");
    exit();
}


/* GET ALL COMPLAINTS */

$sql = "SELECT complaints.*,
               students.name,
               students.roll_no,
               students.department
        FROM complaints
        INNER JOIN students
        ON complaints.student_id = students.id
        ORDER BY complaints.id DESC";


$result = mysqli_query($conn, $sql);


if(!$result)
{
    die("Database Error: " . mysqli_error($conn));
}

?>


<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Admin Complaints - SSCMS</title>


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


/* SIDEBAR */

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


/* MAIN */

.main{

    margin-left:250px;
    padding:30px;

}


/* HEADER */

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


/* TABLE */

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
    min-width:900px;

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


/* STATUS */

.pending{

    color:#d97706;
    font-weight:bold;

}


.resolved{

    color:green;
    font-weight:bold;

}


/* BACK BUTTON */

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
📝 Student Complaints
</h1>

</div>



<div class="table-box">


<table>


<tr>

<th>Complaint ID</th>

<th>Student Name</th>

<th>Roll Number</th>

<th>Title</th>

<th>Description</th>

<th>Department</th>

<th>Status</th>

</tr>



<?php


if(mysqli_num_rows($result) > 0)

{

while($complaint = mysqli_fetch_assoc($result))

{

?>


<tr>


<td>

<?php echo $complaint['id']; ?>

</td>


<td>

<?php echo $complaint['name']; ?>

</td>


<td>

<?php echo $complaint['roll_no']; ?>

</td>


<td>

<?php echo $complaint['title']; ?>

</td>


<td>

<?php echo $complaint['description']; ?>

</td>


<td>

<?php echo $complaint['department']; ?>

</td>


<td>


<span class="<?php

if($complaint['status']=="Resolved")
{
    echo "resolved";
}
else
{
    echo "pending";
}

?>">


<?php echo $complaint['status']; ?>


</span>


</td>


</tr>


<?php

}

}

else

{

echo "<tr>";
echo "<td colspan='7'>No complaints found</td>";
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
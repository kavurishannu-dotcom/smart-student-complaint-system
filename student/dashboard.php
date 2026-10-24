<?php

session_start();

include("../database/db.php");
mysqli_select_db($conn, "complaint_system");

if(!isset($_SESSION['student_id']))
{
    header("Location: login.php");

    exit();
}


$student_id =
$_SESSION['student_id'];


/* TOTAL COMPLAINTS */

$total_sql =

"SELECT COUNT(*) AS total

 FROM complaints

 WHERE student_id='$student_id'";


$total_result =
mysqli_query($conn, $total_sql);


$total_row =
mysqli_fetch_assoc($total_result);


$total_complaints =
$total_row['total'];


/* PENDING COMPLAINTS */

$pending_sql =

"SELECT COUNT(*) AS total

 FROM complaints

 WHERE student_id='$student_id'

 AND status='Pending'";


$pending_result =
mysqli_query($conn, $pending_sql);


$pending_row =
mysqli_fetch_assoc($pending_result);


$pending_complaints =
$pending_row['total'];


/* RESOLVED COMPLAINTS */

$resolved_sql =

"SELECT COUNT(*) AS total

 FROM complaints

 WHERE student_id='$student_id'

 AND status='Resolved'";


$resolved_result =
mysqli_query($conn, $resolved_sql);


$resolved_row =
mysqli_fetch_assoc($resolved_result);


$resolved_complaints =
$resolved_row['total'];


/* NOTIFICATIONS */

$notification_sql =

"SELECT COUNT(*) AS total

 FROM notifications

 WHERE student_id='$student_id'";


$notification_result =
mysqli_query($conn, $notification_sql);


$notification_row =
mysqli_fetch_assoc($notification_result);


$total_notifications =
$notification_row['total'];

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"

      content="width=device-width,

      initial-scale=1.0">

<title>

Student Dashboard - SSCMS

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


.sidebar{

    position:fixed;

    left:0;

    top:0;

    width:250px;

    height:100vh;

    background:#003366;

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

    transition:.3s;

}


.sidebar a:hover{

    background:#0055aa;

    transform:translateX(5px);

}


.main{

    margin-left:250px;

    padding:30px;

}


.topbar{

    background:white;

    padding:20px;

    border-radius:10px;

    box-shadow:0 3px 10px

    rgba(0,0,0,.1);

    margin-bottom:30px;

}


.topbar h1{

    color:#003366;

}


.welcome{

    background:linear-gradient(

        135deg,

        #0b4f9c,

        #4ea3ff

    );

    color:white;

    padding:30px;

    border-radius:12px;

    margin-bottom:30px;

    box-shadow:

    0 5px 15px

    rgba(0,0,0,.2);

}


.welcome h2{

    margin-bottom:15px;

}


.welcome p{

    margin:8px 0;

}


.cards{

    display:grid;

    grid-template-columns:

    repeat(

        auto-fit,

        minmax(200px,1fr)

    );

    gap:20px;

}


.card{

    display:block;

    text-decoration:none;

    color:inherit;

    background:white;

    padding:25px;

    border-radius:12px;

    box-shadow:

    0 3px 10px

    rgba(0,0,0,.1);

    text-align:center;

    transition:.3s;

}


.card:hover{

    transform:translateY(-8px);

    box-shadow:

    0 8px 20px

    rgba(0,0,0,.2);

}


.card h2{

    color:#003366;

    margin-bottom:10px;

}


.card p{

    font-size:32px;

    font-weight:bold;

    color:#0055aa;

}


@media(max-width:700px)

{

    .sidebar{

        width:100%;

        height:auto;

        position:relative;

    }


    .main{

        margin-left:0;

        padding:15px;

    }

}

</style>

</head>


<body>


<div class="sidebar">


<h2>

🎓 SSCMS

</h2>


<a href="dashboard.php">

🏠 Dashboard

</a>


<a href="submit_complaint.php">

📝 Submit Complaint

</a>


<a href="my_complaints.php">

📋 My Complaints

</a>


<a href="notifications.php">

🔔 Notifications

</a>


<a href="profile.php">

👤 My Profile

</a>


<a href="logout.php">

🚪 Logout

</a>


</div>


<div class="main">


<div class="topbar">


<h1>

Student Dashboard

</h1>


</div>


<div class="welcome">


<h2>

Welcome,

<?php

echo $_SESSION['student_name'];

?>

👋

</h2>


<p>

🆔 Roll Number:

<?php

echo $_SESSION['roll_no'];

?>

</p>


<p>

🏫 Department:

<?php

echo $_SESSION['department'];

?>

</p>


<br>


<p>

Manage your complaints quickly and easily.

</p>


</div>


<div class="cards">


<div class="card">


<h2>

📝 Total Complaints

</h2>


<p>

<?php

echo $total_complaints;

?>

</p>


</div>


<div class="card">


<h2>

⏳ Pending

</h2>


<p>

<?php

echo $pending_complaints;

?>

</p>


</div>


<div class="card">


<h2>

✅ Resolved

</h2>


<p>

<?php

echo $resolved_complaints;

?>

</p>


</div>


<a href="notifications.php"

   class="card">


<h2>

🔔 Notifications

</h2>


<p>

<?php

echo $total_notifications;

?>

</p>


</a>


</div>


</div>


</body>

</html>
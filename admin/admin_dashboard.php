<?php

session_start();

include("../database/db.php");

if(!isset($_SESSION['admin_id']))
{
    header("Location: admin_login.php");
    exit();
}


/* TOTAL STUDENTS */

$student_query = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total FROM students"
);

$student_data = mysqli_fetch_assoc($student_query);

$total_students = $student_data['total'];

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width,
      initial-scale=1.0">

<title>Admin Dashboard - SSCMS</title>

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


/* TOPBAR */

.topbar{

    background:white;

    padding:20px;

    border-radius:10px;

    box-shadow:0 3px 10px
    rgba(0,0,0,.1);

    margin-bottom:30px;

}

.topbar h1{

    color:#172b4d;

}


/* WELCOME */

.welcome{

    background:linear-gradient(
        135deg,
        #172b4d,
        #3b5998
    );

    color:white;

    padding:30px;

    border-radius:12px;

    margin-bottom:30px;

}

.welcome h2{

    margin-bottom:10px;

}


/* CARDS */

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

    background:white;

    padding:25px;

    border-radius:12px;

    box-shadow:0 3px 10px
    rgba(0,0,0,.1);

    text-align:center;

}

.card h2{

    color:#172b4d;

    margin-bottom:10px;

}

.card p{

    font-size:32px;

    font-weight:bold;

    color:#3b5998;

}


/* MOBILE */

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


<!-- SIDEBAR -->

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


<!-- MAIN CONTENT -->

<div class="main">


    <div class="topbar">

        <h1>

            Admin Dashboard

        </h1>

    </div>


    <div class="welcome">

        <h2>

            Welcome,

            <?php

            echo $_SESSION['admin_username'];

            ?>

            👋

        </h2>


        <p>

            Email:

            <?php

            echo $_SESSION['admin_email'];

            ?>

        </p>


        <br>


        <p>

            Manage the Smart Student Complaint Management System.

        </p>

    </div>


    <div class="cards">


        <!-- TOTAL STUDENTS -->

        <div class="card">

            <h2>

                👨‍🎓 Students

            </h2>

            <p>

                <?php

                echo $total_students;

                ?>

            </p>

        </div>


        <!-- COMPLAINTS -->

        <div class="card">

            <h2>

                📝 Complaints

            </h2>

            <p>

                0

            </p>

        </div>


        <!-- PENDING -->

        <div class="card">

            <h2>

                ⏳ Pending

            </h2>

            <p>

                0

            </p>

        </div>


        <!-- RESOLVED -->

        <div class="card">

            <h2>

                ✅ Resolved

            </h2>

            <p>

                0

            </p>

        </div>


    </div>


</div>


</body>

</html>
<?php

session_start();

include("../database/db.php");

if (!isset($_SESSION['department_id']))
{
    header("Location: department_login.php");
    exit();
}

$department_id =
    $_SESSION['department_id'];


/* ================================
   GET DEPARTMENT DETAILS
   ================================ */

$department_sql = "
    SELECT department_name, name
    FROM departments
    WHERE id = ?
";

$department_stmt =
    mysqli_prepare(
        $conn,
        $department_sql
    );

if (!$department_stmt)
{
    die(
        "Database Error: "
        . mysqli_error($conn)
    );
}

mysqli_stmt_bind_param(
    $department_stmt,
    "i",
    $department_id
);

mysqli_stmt_execute(
    $department_stmt
);

$department_result =
    mysqli_stmt_get_result(
        $department_stmt
    );

$department_row =
    mysqli_fetch_assoc(
        $department_result
    );

if (!$department_row)
{
    die("Department not found.");
}


/*
    Your database contains:

    CME
    ECE
    MECH

    Therefore department_name is
    used as the department CODE.
*/

$department_code =
    trim($department_row['department_name']);

$department_name =
    trim($department_row['department_name']);

mysqli_stmt_close(
    $department_stmt
);


$total_complaints = 0;
$pending_complaints = 0;
$progress_complaints = 0;
$resolved_complaints = 0;
$total_notifications = 0;


/* ================================
   GET COMPLAINT COUNTS
   ================================ */

$sql = "
    SELECT

        COUNT(*) AS total_complaints,

        SUM(
            CASE
                WHEN status = 'Pending'
                THEN 1
                ELSE 0
            END
        ) AS pending_complaints,

        SUM(
            CASE
                WHEN status = 'In Progress'
                THEN 1
                ELSE 0
            END
        ) AS progress_complaints,

        SUM(
            CASE
                WHEN status = 'Resolved'
                THEN 1
                ELSE 0
            END
        ) AS resolved_complaints

    FROM complaints

    WHERE UPPER(TRIM(department))
        = UPPER(TRIM(?))
";

$stmt =
    mysqli_prepare(
        $conn,
        $sql
    );

if (!$stmt)
{
    die(
        "Database Error: "
        . mysqli_error($conn)
    );
}

mysqli_stmt_bind_param(
    $stmt,
    "s",
    $department_code
);

mysqli_stmt_execute(
    $stmt
);

$result =
    mysqli_stmt_get_result(
        $stmt
    );

if ($result)
{
    $row =
        mysqli_fetch_assoc(
            $result
        );

    if ($row)
    {
        $total_complaints =
            (int)(
                $row['total_complaints']
                ?? 0
            );

        $pending_complaints =
            (int)(
                $row['pending_complaints']
                ?? 0
            );

        $progress_complaints =
            (int)(
                $row['progress_complaints']
                ?? 0
            );

        $resolved_complaints =
            (int)(
                $row['resolved_complaints']
                ?? 0
            );
    }
}

mysqli_stmt_close($stmt);


/* ================================
   NOTIFICATIONS
   ================================ */

$notification_sql = "
    SELECT COUNT(*) AS total
    FROM notifications
";

$notification_result =
    mysqli_query(
        $conn,
        $notification_sql
    );

if ($notification_result)
{
    $notification_row =
        mysqli_fetch_assoc(
            $notification_result
        );

    $total_notifications =
        (int)(
            $notification_row['total']
            ?? 0
        );
}


/* ================================
   SAFE OUTPUT
   ================================ */

$safe_department_name =
    htmlspecialchars(
        $department_name,
        ENT_QUOTES,
        'UTF-8'
    );

$safe_department_code =
    htmlspecialchars(
        $department_code,
        ENT_QUOTES,
        'UTF-8'
    );

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>
Department Dashboard - SSCMS
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

    background:#164a41;

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

.sidebar a:hover,
.sidebar a.active{

    background:#26796a;
}

.main{

    margin-left:250px;

    padding:30px;

    min-height:100vh;
}

.topbar{

    background:white;

    padding:20px;

    border-radius:10px;

    box-shadow:
        0 3px 10px rgba(0,0,0,.1);

    margin-bottom:30px;
}

.topbar h1{

    color:#164a41;
}

.welcome{

    background:
        linear-gradient(
            135deg,
            #164a41,
            #4caf50
        );

    color:white;

    padding:30px;

    border-radius:12px;

    margin-bottom:30px;
}

.welcome h2{

    margin-bottom:12px;
}

.welcome p{

    font-size:16px;

    line-height:1.6;
}

.welcome .department{

    font-weight:bold;
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

    background:white;

    padding:25px;

    border-radius:12px;

    box-shadow:
        0 3px 10px rgba(0,0,0,.1);

    text-align:center;

    border-top:5px solid #4caf50;

    text-decoration:none;
}

.card h2{

    color:#164a41;

    margin-bottom:15px;

    font-size:20px;
}

.card p{

    font-size:35px;

    font-weight:bold;

    color:#4caf50;
}

.card.pending{

    border-top-color:#f39c12;
}

.card.pending p{

    color:#f39c12;
}

.card.progress{

    border-top-color:#3498db;
}

.card.progress p{

    color:#3498db;
}

.card.resolved{

    border-top-color:#27ae60;
}

.card.resolved p{

    color:#27ae60;
}

.card.notifications{

    border-top-color:#9b59b6;
}

.card.notifications p{

    color:#9b59b6;
}

@media(max-width:768px){

    .sidebar{

        position:relative;

        width:100%;

        height:auto;
    }

    .main{

        margin-left:0;

        padding:20px;
    }

    .sidebar a{

        display:inline-block;

        margin:5px;
    }

    .cards{

        grid-template-columns:1fr;
    }

}

</style>

</head>

<body>

<div class="sidebar">

<h2>
🏢 DEPARTMENT
</h2>

<a
href="department_dashboard.php"
class="active"
>
🏠 Dashboard
</a>

<a href="department_complaints.php">
📝 Complaints
</a>

<a href="department_notifications.php">
🔔 Notifications
</a>

<a href="department_logout.php">
🚪 Logout
</a>

</div>


<div class="main">

<div class="topbar">

<h1>
Department Dashboard
</h1>

</div>


<div class="welcome">

<h2>

Welcome,
<?php echo $safe_department_code; ?>
👋

</h2>

<p>

Department:

<span class="department">

<?php
echo $safe_department_name;
?>

</span>

</p>

<br>

<p>
Manage and resolve student complaints.
</p>

</div>


<div class="cards">


<div class="card">

<h2>
📝 Total Complaints
</h2>

<p>
<?php echo $total_complaints; ?>
</p>

</div>


<div class="card pending">

<h2>
⏳ Pending
</h2>

<p>
<?php echo $pending_complaints; ?>
</p>

</div>


<div class="card progress">

<h2>
🔄 In Progress
</h2>

<p>
<?php echo $progress_complaints; ?>
</p>

</div>


<div class="card resolved">

<h2>
✅ Resolved
</h2>

<p>
<?php echo $resolved_complaints; ?>
</p>

</div>


<a
href="department_notifications.php"
class="card notifications"
>

<h2>
🔔 Notifications
</h2>

<p>
<?php echo $total_notifications; ?>
</p>

</a>


</div>

</div>

</body>

</html>
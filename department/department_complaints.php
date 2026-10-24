<?php

session_start();

include("../database/db.php");

if (!isset($_SESSION['department_id']))
{
    header("Location: department_login.php");
    exit();
}


/* ================================
   DEPARTMENT INFORMATION
   ================================ */

$department_id = $_SESSION['department_id'];


/* Get department information from database */

$department_sql = "
    SELECT department_name, name
    FROM departments
    WHERE id = ?
";

$department_stmt = mysqli_prepare(
    $conn,
    $department_sql
);

if (!$department_stmt)
{
    die(
        "Database Error: " .
        mysqli_error($conn)
    );
}

mysqli_stmt_bind_param(
    $department_stmt,
    "i",
    $department_id
);

mysqli_stmt_execute($department_stmt);

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
   department_name contains:

   CME
   ECE
   MECH
*/

$department_code =
    trim($department_row['department_name']);

$department_name =
    trim($department_row['department_name']);

mysqli_stmt_close(
    $department_stmt
);


/* ================================
   STATUS FILTER
   ================================ */

$status_filter =
    $_GET['status'] ?? '';


/* ================================
   GET COMPLAINTS
   ================================ */

if (
    $status_filter === 'Pending' ||
    $status_filter === 'In Progress' ||
    $status_filter === 'Resolved'
)
{
    $sql = "
        SELECT
            complaints.*,
            students.roll_no AS student_roll_no,
            students.name AS student_name

        FROM complaints

        LEFT JOIN students
        ON complaints.student_id = students.id

        WHERE
            UPPER(TRIM(complaints.department))
            =
            UPPER(TRIM(?))

        AND complaints.status = ?

        ORDER BY complaints.id DESC
    ";

    $stmt =
        mysqli_prepare(
            $conn,
            $sql
        );

    if (!$stmt)
    {
        die(
            "Database Error: " .
            mysqli_error($conn)
        );
    }

    mysqli_stmt_bind_param(
        $stmt,
        "ss",
        $department_code,
        $status_filter
    );
}
else
{
    $sql = "
        SELECT
            complaints.*,
            students.roll_no AS student_roll_no,
            students.name AS student_name

        FROM complaints

        LEFT JOIN students
        ON complaints.student_id = students.id

        WHERE
            UPPER(TRIM(complaints.department))
            =
            UPPER(TRIM(?))

        ORDER BY complaints.id DESC
    ";

    $stmt =
        mysqli_prepare(
            $conn,
            $sql
        );

    if (!$stmt)
    {
        die(
            "Database Error: " .
            mysqli_error($conn)
        );
    }

    mysqli_stmt_bind_param(
        $stmt,
        "s",
        $department_code
    );
}


mysqli_stmt_execute($stmt);

$result =
    mysqli_stmt_get_result($stmt);


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
Department Complaints - SSCMS
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

    margin-bottom:25px;

}

.topbar h1{

    color:#164a41;

}

.page-info{

    background:
        linear-gradient(
            135deg,
            #164a41,
            #4caf50
        );

    color:white;

    padding:25px;

    border-radius:12px;

    margin-bottom:25px;

}

.page-info h2{

    margin-bottom:10px;

}

.page-info p{

    line-height:1.6;

}

.filters{

    display:flex;

    flex-wrap:wrap;

    gap:10px;

    margin-bottom:25px;

}

.filter-btn{

    display:inline-block;

    padding:10px 18px;

    border-radius:6px;

    background:#164a41;

    color:white;

    text-decoration:none;

}

.filter-btn:hover{

    background:#26796a;

}

.filter-btn.pending{

    background:#f39c12;

}

.filter-btn.progress{

    background:#3498db;

}

.filter-btn.resolved{

    background:#27ae60;

}

.complaint-card{

    background:white;

    padding:25px;

    margin-bottom:20px;

    border-radius:12px;

    box-shadow:
        0 3px 10px rgba(0,0,0,.1);

}

.complaint-card h3{

    color:#164a41;

    margin-bottom:18px;

    font-size:21px;

}

.complaint-card p{

    margin-bottom:12px;

    color:#444;

    line-height:1.5;

}

.label{

    font-weight:bold;

    color:#164a41;

}

.current-status{

    display:inline-block;

    padding:7px 13px;

    border-radius:20px;

    font-weight:bold;

    font-size:13px;

    margin-top:5px;

}

.status-pending{

    background:#fff3cd;

    color:#856404;

}

.status-progress{

    background:#dbeafe;

    color:#1d4ed8;

}

.status-resolved{

    background:#d1fae5;

    color:#047857;

}

.status-form{

    display:flex;

    align-items:center;

    flex-wrap:wrap;

    gap:10px;

    margin-top:20px;

    padding-top:20px;

    border-top:1px solid #eee;

}

.status-select{

    padding:10px 14px;

    border:1px solid #ccc;

    border-radius:6px;

    background:white;

    font-size:14px;

}

.update-btn{

    padding:10px 20px;

    border:none;

    border-radius:6px;

    background:#164a41;

    color:white;

    font-size:14px;

    font-weight:bold;

    cursor:pointer;

}

.update-btn:hover{

    background:#26796a;

}

.no-complaints{

    background:white;

    padding:40px;

    text-align:center;

    border-radius:12px;

    box-shadow:
        0 3px 10px rgba(0,0,0,.1);

    color:#666;

}

.no-complaints h2{

    color:#164a41;

    margin-bottom:10px;

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

    .status-form{

        flex-direction:column;

        align-items:stretch;

    }

    .status-select,
    .update-btn{

        width:100%;

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
>
🏠 Dashboard
</a>

<a
href="department_complaints.php"
class="active"
>
📝 Complaints
</a>

<a
href="department_notifications.php"
>
🔔 Notifications
</a>

<a
href="department_logout.php"
>
🚪 Logout
</a>

</div>


<div class="main">


<div class="topbar">

<h1>
Student Complaints
</h1>

</div>


<div class="page-info">

<h2>

Department:
<?php

echo $safe_department_name;

?>

</h2>

<p>

Department Code:
<?php

echo $safe_department_code;

?>

</p>

</div>


<div class="filters">

<a
href="department_complaints.php"
class="filter-btn"
>
All Complaints
</a>

<a
href="department_complaints.php?status=Pending"
class="filter-btn pending"
>
Pending
</a>

<a
href="department_complaints.php?status=In%20Progress"
class="filter-btn progress"
>
In Progress
</a>

<a
href="department_complaints.php?status=Resolved"
class="filter-btn resolved"
>
Resolved
</a>

</div>


<?php

if (
    $result &&
    mysqli_num_rows($result) > 0
)
{

    while (
        $row =
        mysqli_fetch_assoc($result)
    )
    {

        $current_status =
            $row['status'] ?? 'Pending';


        if (
            $current_status === 'Pending'
        )
        {
            $status_class =
                'status-pending';
        }
        elseif (
            $current_status === 'In Progress'
        )
        {
            $status_class =
                'status-progress';
        }
        elseif (
            $current_status === 'Resolved'
        )
        {
            $status_class =
                'status-resolved';
        }
        else
        {
            $status_class = '';
        }

?>

<div class="complaint-card">


<h3>

<?php

echo htmlspecialchars(
    $row['title'] ?? 'No Title',
    ENT_QUOTES,
    'UTF-8'
);

?>

</h3>


<p>

<span class="label">
Student PIN:
</span>

<?php

echo htmlspecialchars(
    $row['student_roll_no'] ?? 'Unknown',
    ENT_QUOTES,
    'UTF-8'
);

?>

</p>


<p>

<span class="label">
Student Name:
</span>

<?php

echo htmlspecialchars(
    $row['student_name'] ?? 'Unknown',
    ENT_QUOTES,
    'UTF-8'
);

?>

</p>


<p>

<span class="label">
Description:
</span>

<?php

echo htmlspecialchars(
    $row['description'] ?? '',
    ENT_QUOTES,
    'UTF-8'
);

?>

</p>


<p>

<span class="label">
Department:
</span>

<?php

echo htmlspecialchars(
    $row['department'] ?? '',
    ENT_QUOTES,
    'UTF-8'
);

?>

</p>


<p>

<span class="label">
Current Status:
</span>

<br>

<span class="current-status
<?php

echo $status_class;

?>">

<?php

echo htmlspecialchars(
    $current_status,
    ENT_QUOTES,
    'UTF-8'
);

?>

</span>

</p>


<form
method="POST"
action="update_complaint_status.php"
class="status-form"
>

<input
type="hidden"
name="complaint_id"
value="<?php

echo htmlspecialchars(
    $row['id'] ?? '',
    ENT_QUOTES,
    'UTF-8'
);

?>"
>


<select
name="status"
class="status-select"
>

<option
value="Pending"

<?php

if (
    $current_status === 'Pending'
)
{
    echo 'selected';
}

?>
>
Pending
</option>


<option
value="In Progress"

<?php

if (
    $current_status === 'In Progress'
)
{
    echo 'selected';
}

?>
>
In Progress
</option>


<option
value="Resolved"

<?php

if (
    $current_status === 'Resolved'
)
{
    echo 'selected';
}

?>
>
Resolved
</option>

</select>


<button
type="submit"
class="update-btn"
>
Update
</button>

</form>


</div>

<?php

    }

}
else
{

?>

<div class="no-complaints">

<h2>
No Complaints Found
</h2>

<p>
There are no complaints for your department.
</p>

</div>

<?php

}

?>

</div>

</body>

</html>

<?php

mysqli_stmt_close($stmt);

?>
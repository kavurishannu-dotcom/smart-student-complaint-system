<?php

session_start();

include("../database/db.php");


if (!isset($_SESSION['department_id'])) {

    header("Location: department_login.php");
    exit();

}


/* Get department from database */

$department_id = $_SESSION['department_id'];


$sql = "
    SELECT department_name
    FROM departments
    WHERE id = ?
";


$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $department_id
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$department_row = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);


$department_code = trim($department_row['department_name'] ?? '');


/* Get notifications */

$notification_sql = "
    SELECT id, message, created_at
    FROM notifications
    WHERE UPPER(TRIM(department)) = UPPER(TRIM(?))
    ORDER BY id DESC
";


$notification_stmt = mysqli_prepare(
    $conn,
    $notification_sql
);


mysqli_stmt_bind_param(
    $notification_stmt,
    "s",
    $department_code
);


mysqli_stmt_execute($notification_stmt);


$notification_result =
    mysqli_stmt_get_result($notification_stmt);

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Department Notifications - SSCMS</title>


<style>

* {

    margin: 0;

    padding: 0;

    box-sizing: border-box;

    font-family: Arial;

}


body {

    background: #f2f6fc;

}


.sidebar {

    position: fixed;

    left: 0;

    top: 0;

    width: 250px;

    height: 100vh;

    background: #164a41;

    color: white;

    padding: 25px 15px;

}


.sidebar h2 {

    text-align: center;

    margin-bottom: 35px;

}


.sidebar a {

    display: block;

    padding: 15px;

    margin: 10px 0;

    color: white;

    text-decoration: none;

    border-radius: 8px;

}


.sidebar a:hover {

    background: #26796a;

}


.main {

    margin-left: 250px;

    padding: 30px;

}


.topbar {

    background: white;

    padding: 20px;

    border-radius: 10px;

    margin-bottom: 25px;

    box-shadow: 0 3px 10px rgba(0,0,0,.1);

}


.topbar h1 {

    color: #164a41;

}


.notification {

    background: white;

    padding: 20px;

    margin-bottom: 15px;

    border-left: 6px solid #4caf50;

    border-radius: 10px;

    box-shadow: 0 3px 10px rgba(0,0,0,.1);

}


.notification h3 {

    color: #164a41;

    margin-bottom: 10px;

}


.notification p {

    color: #555;

    margin-bottom: 8px;

}


.date {

    color: #888;

    font-size: 14px;

}


.empty {

    background: white;

    padding: 30px;

    text-align: center;

    border-radius: 10px;

}


@media(max-width:700px) {

    .sidebar {

        position: relative;

        width: 100%;

        height: auto;

    }


    .main {

        margin-left: 0;

    }

}

</style>

</head>


<body>


<div class="sidebar">

    <h2>🏢 DEPARTMENT</h2>


    <a href="department_dashboard.php">
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
            🔔 Notifications
        </h1>

        <p>
            Department:
            <?php echo htmlspecialchars($department_code); ?>
        </p>

    </div>



    <?php

    if (mysqli_num_rows($notification_result) > 0) {

        while ($row = mysqli_fetch_assoc($notification_result)) {

    ?>


        <div class="notification">

            <h3>
                🔔 Notification from Admin
            </h3>


            <p>

                <?php

                echo htmlspecialchars($row['message']);

                ?>

            </p>


            <p class="date">

                <?php

                echo htmlspecialchars($row['created_at']);

                ?>

            </p>

        </div>


    <?php

        }

    } else {

    ?>


        <div class="empty">

            <h2>
                🔕 No Notifications
            </h2>

            <p>
                No notifications available for this department.
            </p>

        </div>


    <?php

    }

    ?>


</div>


</body>

</html>

<?php

mysqli_stmt_close($notification_stmt);

?>
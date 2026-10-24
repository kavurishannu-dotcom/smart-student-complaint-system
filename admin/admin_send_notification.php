<?php

session_start();

include("../database/db.php");


// Check admin login
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}


// Get departments
$department_sql = "
    SELECT department_name
    FROM departments
    ORDER BY department_name
";

$department_result = mysqli_query($conn, $department_sql);


$message = "";
$error = "";


// Send notification
if (isset($_POST['send_notification'])) {

    $department = trim($_POST['department']);
    $notification = trim($_POST['message']);

    if ($department == "" || $notification == "") {

        $error = "Please select department and enter message.";

    } else {

        $sql = "
            INSERT INTO notifications
            (message, department, student_id)
            VALUES (?, ?, NULL)
        ";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param(
            $stmt,
            "ss",
            $notification,
            $department
        );

        if (mysqli_stmt_execute($stmt)) {

            $message = "Notification sent successfully to " . $department . " department.";

        } else {

            $error = "Failed to send notification.";

        }

        mysqli_stmt_close($stmt);
    }
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Send Notification - SSCMS</title>


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


/* Sidebar */

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


/* Main */

.main {

    margin-left: 250px;

    padding: 30px;
}


/* Top */

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


/* Form */

.form-box {

    background: white;

    padding: 30px;

    max-width: 700px;

    border-radius: 12px;

    box-shadow: 0 3px 10px rgba(0,0,0,.1);
}


.form-box label {

    display: block;

    margin-bottom: 8px;

    font-weight: bold;

    color: #333;
}


.form-box select,
.form-box textarea {

    width: 100%;

    padding: 12px;

    margin-bottom: 20px;

    border: 1px solid #ccc;

    border-radius: 7px;

    font-size: 15px;
}


.form-box textarea {

    height: 150px;

    resize: vertical;
}


.send-btn {

    background: #164a41;

    color: white;

    border: none;

    padding: 13px 25px;

    border-radius: 7px;

    cursor: pointer;

    font-size: 16px;
}


.send-btn:hover {

    background: #26796a;
}


.success {

    background: #d4edda;

    color: #155724;

    padding: 12px;

    margin-bottom: 20px;

    border-radius: 7px;
}


.error {

    background: #f8d7da;

    color: #721c24;

    padding: 12px;

    margin-bottom: 20px;

    border-radius: 7px;
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


<!-- Sidebar -->

<div class="sidebar">

    <h2>🛡️ ADMIN</h2>

    <a href="admin_dashboard.php">
        🏠 Dashboard
    </a>

    <a href="admin_send_notification.php">
        🔔 Send Notification
    </a>

    <a href="admin_logout.php">
        🚪 Logout
    </a>

</div>



<!-- Main -->

<div class="main">


    <div class="topbar">

        <h1>
            🔔 Send Notification
        </h1>

        <p>
            Send a notification to a department
        </p>

    </div>



    <div class="form-box">


        <?php if ($message != "") { ?>

            <div class="success">
                <?php echo htmlspecialchars($message); ?>
            </div>

        <?php } ?>


        <?php if ($error != "") { ?>

            <div class="error">
                <?php echo htmlspecialchars($error); ?>
            </div>

        <?php } ?>



        <form method="POST">


            <label>
                Select Department
            </label>


            <select name="department" required>

                <option value="">
                    -- Select Department --
                </option>


                <?php

                if ($department_result) {

                    while ($department = mysqli_fetch_assoc($department_result)) {

                ?>

                    <option value="<?php echo htmlspecialchars($department['department_name']); ?>">

                        <?php echo htmlspecialchars($department['department_name']); ?>

                    </option>

                <?php

                    }

                }

                ?>

            </select>



            <label>
                Notification Message
            </label>


            <textarea
                name="message"
                placeholder="Enter notification message..."
                required
            ></textarea>



            <button
                type="submit"
                name="send_notification"
                class="send-btn"
            >

                📤 Send Notification

            </button>


        </form>


    </div>


</div>


</body>

</html>
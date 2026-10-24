```php
<?php

session_start();

include("../database/db.php");

/* =========================================
   CHECK DEPARTMENT LOGIN
   ========================================= */

if (!isset($_SESSION['department_id'])) {

    header("Location: department_login.php");
    exit();

}


/* =========================================
   CHECK REQUEST
   ========================================= */

if (!isset($_POST['complaint_id']) ||
    !isset($_POST['status'])) {

    die("Invalid request.");

}


/* =========================================
   GET DATA
   ========================================= */

$complaint_id = (int) $_POST['complaint_id'];

$status = trim($_POST['status']);


/* =========================================
   ALLOWED STATUS
   ========================================= */

$allowed_statuses = [
    "Pending",
    "In Progress",
    "Resolved"
];

if (!in_array($status, $allowed_statuses, true)) {

    die("Invalid complaint status.");

}


/* =========================================
   UPDATE STATUS
   ========================================= */

$sql = "
    UPDATE complaints
    SET status = ?
    WHERE id = ?
";


$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {

    die(
        "Database Error: " .
        mysqli_error($conn)
    );

}


/* =========================================
   BIND VALUES
   ========================================= */

mysqli_stmt_bind_param(
    $stmt,
    "si",
    $status,
    $complaint_id
);


/* =========================================
   EXECUTE
   ========================================= */

if (!mysqli_stmt_execute($stmt)) {

    die(
        "Update Error: " .
        mysqli_stmt_error($stmt)
    );

}


/* =========================================
   CLOSE
   ========================================= */

mysqli_stmt_close($stmt);


/* =========================================
   BACK TO COMPLAINTS
   ========================================= */

header(
    "Location: department_complaints.php"
);

exit();

?>
```

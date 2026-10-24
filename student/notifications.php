<?php

session_start();

include("../database/db.php");

if(!isset($_SESSION['student_id']))
{
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

$sql = "SELECT * FROM notifications
        WHERE student_id='$student_id'
        ORDER BY id DESC";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>

<head>

<title>Notifications - SSCMS</title>

<style>

body{
    font-family:Arial, sans-serif;
    background:#f2f6fc;
    padding:30px;
}

.container{
    max-width:800px;
    margin:auto;
}

h1{
    color:#003366;
}

.notification{

    background:white;
    padding:20px;
    margin:15px 0;
    border-radius:10px;
    box-shadow:0 3px 10px rgba(0,0,0,.1);

}

.date{

    color:#777;
    font-size:13px;
    margin-top:10px;

}

.back{

    display:inline-block;
    padding:12px 20px;
    background:#003366;
    color:white;
    text-decoration:none;
    border-radius:6px;

}

.back:hover{

    background:#0055aa;

}

</style>

</head>


<body>


<div class="container">


<h1>🔔 My Notifications</h1>


<?php

if(mysqli_num_rows($result) > 0)

{

    while($notification = mysqli_fetch_assoc($result))

    {

?>


<div class="notification">


<p>

🔔

<?php

echo $notification['message'];

?>

</p>


<div class="date">

<?php

echo $notification['created_at'];

?>

</div>


</div>


<?php

    }

}

else

{

    echo "<p>No notifications available.</p>";

}

?>


<br>


<a href="dashboard.php" class="back">

🏠 Back to Dashboard

</a>


</div>


</body>

</html>
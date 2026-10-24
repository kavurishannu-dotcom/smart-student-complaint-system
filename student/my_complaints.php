<?php

session_start();

include("../database/db.php");

if(!isset($_SESSION['student_id']))
{
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

$sql = "SELECT * FROM complaints
        WHERE student_id='$student_id'
        ORDER BY id DESC";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>My Complaints - SSCMS</title>

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

.container{
    width:95%;
    max-width:1100px;
    margin:40px auto;
}

h1{
    color:#003366;
    margin-bottom:25px;
}

.complaint{
    background:white;
    padding:25px;
    margin-bottom:20px;
    border-radius:12px;
    box-shadow:0 3px 10px rgba(0,0,0,.1);
}

.complaint h2{
    color:#003366;
    margin-bottom:12px;
}

.complaint p{
    margin:8px 0;
    color:#444;
}

.status{
    display:inline-block;
    padding:8px 15px;
    border-radius:20px;
    background:#fff3cd;
    color:#856404;
    font-weight:bold;
}

.back{
    display:inline-block;
    margin-bottom:25px;
    padding:12px 20px;
    background:#003366;
    color:white;
    text-decoration:none;
    border-radius:6px;
}

.no-complaints{
    background:white;
    padding:30px;
    text-align:center;
    border-radius:12px;
    color:#666;
}

</style>

</head>

<body>

<div class="container">

<a href="dashboard.php" class="back">
🏠 Back to Dashboard
</a>

<h1>📋 My Complaints</h1>


<?php

if(mysqli_num_rows($result) > 0)

{

    while($row = mysqli_fetch_assoc($result))

    {

?>


<div class="complaint">


<h2>
<?php echo $row['title']; ?>
</h2>


<p>

<strong>Description:</strong>

<br>

<?php echo $row['description']; ?>

</p>


<p>

<strong>Status:</strong>

<span class="status">

<?php echo $row['status']; ?>

</span>

</p>


</div>


<?php

    }

}

else

{

?>


<div class="no-complaints">

<h2>No Complaints Found</h2>

<p>You have not submitted any complaints yet.</p>

</div>


<?php

}

?>


</div>

</body>

</html>
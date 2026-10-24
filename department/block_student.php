<?php

session_start();

include("../database/db.php");


if(!isset($_SESSION['department_id']))
{
    header("Location: department_login.php");
    exit();
}



if(isset($_GET['id']))
{

    $student_id=$_GET['id'];


    $sql="
    UPDATE students
    SET status='blocked'
    WHERE id='$student_id'
    ";


    if(mysqli_query($conn,$sql))
    {

        echo "
        <script>

        alert('Student blocked successfully');

        window.location='department_complaints.php';

        </script>
        ";

    }
    else
    {

        echo mysqli_error($conn);

    }

}

?>
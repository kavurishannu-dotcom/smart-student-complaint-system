<?php

$conn = mysqli_connect(
    "localhost:3307",
    "root",
    "",
    "complaint_system"
);

if(!$conn)
{
    die("Database Connection Failed: " . mysqli_connect_error());
}

?>
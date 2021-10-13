<?php

include "config.php";

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($conn === false){
    die("ERROR." 
        . mysqli_connect_error());
}

$id = $_GET['id'];
$del = mysqli_query($conn,"delete from elbiofernandez where id = '$id'"); // delete query

if($del)
{
    mysqli_close($conn); // Close connection
    header("location:elef-sm.php"); // redirects to all records page
    exit;	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
mysqli_close($conn); // Close connection
?>
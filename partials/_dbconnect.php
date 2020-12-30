<?php

// Connecting to Database
$servername = "localhost";
$username = "root";
$password= "";
$database = "summaries";

// Create a Connection
$conn = mysqli_connect($servername,$username,$password,$database);
// Die if connection not successful
if(!$conn)
{
    echo "Sorry";
}

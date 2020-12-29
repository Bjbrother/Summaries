<?php

// Connecting to Database
$servername = "sql202.epizy.com";
$username = "epiz_27573365";
$password= "6Ezdre364GkE66";
$database = "epiz_27573365_summaries";

// Create a Connection
$conn = mysqli_connect($servername,$username,$password,$database);
// Die if connection not successful
if(!$conn)
{
    echo "Sorry";
}
?>
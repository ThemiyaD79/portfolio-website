<?php
// Connects to database 'rasmika'
$conn = mysqli_connect("localhost", "root", "", "rasmika");

if(!$conn){
    die("Connection Failed: " . mysqli_connect_error());
}
?>
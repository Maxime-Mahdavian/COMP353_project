<?php
include('config.php');
session_start();

$user_check = $_SESSION['username'];

$ses_sql = mysqli_query($db,"select name from Users where name = '$user_check' ");

$row = mysqli_fetch_array($ses_sql);

$login_session = $row['username'];

if(!isset($_SESSION['username'])){
    header("location:login.php");
    die();
}
?>
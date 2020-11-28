<?php
//INIT
session_start();

//Just destroy the session to logout
if(session_destroy()) {
    header("Location: login.php");
}
?>
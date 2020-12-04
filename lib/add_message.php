<?php

//This file adds a message to the messsage table in the database


//We need to include config.php for the database connection
//session_start to pull session variables
//We need to make sure we have a logged in user to display this page
include ("config.php");
session_start();
if(!isset($_SESSION['username'])){
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Message</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
</head>
<body style="background-color: #d5e2ff;">
<div style = "background-color:#aca3ec; height:100px; color:#4D39D6; padding:3px;"><b><br><i class="huge chess rook icon"></i></b><b align="middle" style="margin-bottom:10px; color:white; font-size:40px;">CON</b></div>
<br><br>
<a style="margin:30px; font-size: 40px; color:black;" class="item">
    Message <i class="envelope icon"></i>
    <button style="margin-left:1325px" class="ui blue left labeled icon button" type="submit" name="back" onclick="window.location.href='welcome.php';">
        <i class="left arrow icon"></i>
        Back to Main Page
    </button>
</a>
<br>
<?php

//Need to find the userID of the receiver, since the user only inputs the name of the user
$sql = "SELECT userID from Users WHERE name='" . $_POST['receiver'] . "'";
$receiver = mysqli_query($db, $sql) or die("Could not find the receiver");

$temp = mysqli_fetch_array($receiver);
$sql2 = "INSERT INTO message (senderID,receiverID,message) VALUES (" . $_SESSION['ID'] . "," . $temp['userID'] . ",\"" . $_POST['body'] . "\")";

$result = mysqli_query($db, $sql2) or die(mysqli_error($db));

echo "<h1>Your message has been sent</h1>";

?>

</body>
</html>

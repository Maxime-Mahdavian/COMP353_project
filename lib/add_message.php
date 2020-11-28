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


</head>
<body>
<?php

//Need to find the userID of the receiver, since the user only inputs the name of the user
$sql = "SELECT userID from Users WHERE name='" . $_POST['receiver'] . "'";
$receiver = mysqli_query($db, $sql) or die("Could not find the receiver");

$temp = mysqli_fetch_array($receiver);
$sql2 = "INSERT INTO message (senderID,receiverID,message) VALUES (" . $_SESSION['ID'] . "," . $temp['userID'] . ",\"" . $_POST['body'] . "\")";

$result = mysqli_query($db, $sql2) or die(mysqli_error($db));

echo "<h1>Your message has been sent</h1>";
echo "<a href='message.php'>Go back</a>";

?>

</body>
</html>

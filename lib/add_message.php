<?php
include ("config.php");
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Message</title>


</head>
<body>
<?php


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

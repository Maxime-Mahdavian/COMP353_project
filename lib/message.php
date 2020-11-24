<?php
include('config.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Message Page</title>

</head>
<body>
<h1>Message</h1>
<form action="create_message.php" method="post">
    <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
    <input type="hidden" name="sender_ID" value="<?php echo $_SESSION['ID'];?>">
    <input type="submit" name="create_message" value="Create Message">
</form>

<h1>Messages</h1>
<table border="1">
    <tr>
        <th>From</th>
        <th>Message</th>
        <th>Reply</th>
    </tr>
    <?php


    $sql = "SELECT * FROM message WHERE receiverID=" . $_SESSION['ID'];
    $row = mysqli_query($db, $sql);

    while($result = mysqli_fetch_array($row)){
        $sql = "SELECT name FROM Users WHERE userID=" . $result['senderID'];
        $x = mysqli_query($db,$sql);
        $temp = mysqli_fetch_array($x);
        echo "<td>" . $temp['name'] . "</td>";
        echo "<td>" . $result['message'] . "</td>";
        echo '<form action="create_message.php" method="post">';
        echo "<td><input type='submit' value='Reply' name='replayButton'></td>";
        echo "<input type='hidden' name='messageID' value='" . $result['messageID'] . "'>";
        echo "</form>";

        echo "</tr>";

    }
    $receiver = "2";
    $sql = "INSERT INTO message(senderID,receiverID,message) VALUES (". $_SESSION['ID']. "," . $receiver. "," .$_POST['body']. ")";
    echo $sql;
    ?>
</table>
<a href="welcome.php">Back</a>
</body>
</html>
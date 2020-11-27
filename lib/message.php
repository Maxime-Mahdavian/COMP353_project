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
        <th>Time</th>
        <th>Reply</th>
    </tr>
    <?php


    $sql = "SELECT * FROM message WHERE receiverID=" . $_SESSION['ID'] . " ORDER BY timestamp DESC";
    $row = mysqli_query($db, $sql);

    while($result = mysqli_fetch_array($row)){
        $sql = "SELECT name FROM Users, message WHERE userID=" . $result['senderID'];
        $x = mysqli_query($db,$sql);
        $temp = mysqli_fetch_array($x);
        echo "<td>" . $temp['name'] . "</td>";
        echo "<td style='width: 400px; height: 200px;'><textarea class='bodyclass' readonly>" . $result['message'] . "</textarea></td>";
        echo "<td>" . $result['timestamp'] . "</td>";
        echo '<form action="create_message.php" method="post">';
        echo "<td><input type='submit' value='Reply' name='replyButton'></td>";
        echo "<input type='hidden' name='receiver' value='" . $temp['name'] . "'>";
        echo "<input type='hidden' name='body' value='" . $result['message'] . "'>";
        echo "</form>";

        echo "</tr>";

    }
    ?>
</table>
<a href="welcome.php">Back</a>
</body>
</html>
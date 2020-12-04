<?php
include('config.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Message Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
</head>
<body style="background-color: #d5e2ff;">
<div style = "background-color:#aca3ec; height:100px; color:#4D39D6; padding:3px;"><b><br><i class="huge chess rook icon"></i></b><b align="middle" style="margin-bottom:10px; color:white; font-size:40px;">CON</b></div>
    <br><br>
<button style="margin-left:1320px" class="ui blue left labeled icon button" type="submit" name="back" onclick="window.location.href='welcome.php';">
    <i class="left arrow icon"></i>
    Back to Main Page
</button>
<a style="margin-left:30px; font-size: 40px; color:black;" class="item">
    New Message <i class="paper plane icon"></i>
</a>
    <form action="create_message.php" method="post">
        <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
        <input type="hidden" name="sender_ID" value="<?php echo $_SESSION['ID'];?>">
        <input style="margin:40px;" class="ui blue button" type="submit" name="create_message" value="Create New Message">
    </form>

    <a style="margin:30px; font-size: 40px; color:black;" class="item">
        Past Messages <i class="envelope outline icon"></i>
    </a>
    <table class="ui grey inverted table" style="width:100%">
        <col style="width:20%">
        <col style="width:55%">
        <col style="width:15%">
        <col style="width:10%">
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
            echo "<td style='width: 800px; height: 200px;'><textarea style='width: 800px ; height:150px; border: solid; border-radius: 5px' class='bodyclass' readonly>" . $result['message'] . "</textarea></td>";
            echo "<td>" . $result['timestamp'] . "</td>";
            echo '<form action="create_message.php" method="post">';
            echo "<td><input class='ui black button' type='submit' value='Reply' name='replyButton'></td>";
            echo "<input type='hidden' name='receiver' value='" . $temp['name'] . "'>";
            echo "<input type='hidden' name='body' value='" . $result['message'] . "'>";
            echo "</form>";

            echo "</tr>";

        }
        ?>
    </table>
</body>
</html>
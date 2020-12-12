<?php
require __DIR__  . DIRECTORY_SEPARATOR . "config.php";
require PATH_LIB . "Poll.php";
session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Poll List</title>
    <meta http-equiv="refresh" content="<?php echo 60?>;URL='<?php echo "poll_list.php"?>'">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
</head>
<body style="background-color: #d5e2ff;">
<div style = "background-color:#aca3ec; height:100px; color:#4D39D6; padding:3px;"><b><br><i class="huge chess rook icon"></i></b><b align="middle" style="margin-bottom:10px; color:white; font-size:40px;">CON</b></div>
<br><br>
<div align="right">
    <button style="margin-left:1320px" class="ui blue left labeled icon button" type="submit" name="back" onclick="window.location.href='welcome.php';">
        <i class="left arrow icon"></i>
        Back to Main Page
    </button>
</div>
<div >
    <a style="margin:30px; font-size: 40px; color:black;" class="item">
        Polls<i class="archive icon"></i>
    </a>
</div>
<br>

<?php

    $polldb = new Poll();

    $sql = "SELECT * FROM poll_main";
    $result = mysqli_query($db, $sql);
    ?>
    <table style='margin-left:45px; width:70%;' border='1' class="ui inverted table">
        <col style="width:80%">
        <col style="width:10%">
        <col style="width:10%">
        <tr>
            <th>Poll</th>
            <th>Status</th>
            <th>Option</th>

        </tr>
    <?php
    while($row = mysqli_fetch_array($result)){

        echo "<tr>";
        echo "<td>" . $row['poll_question'] . "</td>";

        if(!$polldb->hasEnded($row['poll_id']) == 1){
            echo "<td>Open</td>";
            /*echo "<tr>";
            echo "<td>" . $row['poll_question'] . "</td>";
            echo "<form method='post' action='../poll.php'>";
            echo "<input type='hidden' name='poll_id' value='" . $row['poll_id'] . "'>";
            echo "<td><input type='submit' value='Vote' name='voteButton'></td>";
            echo "</form>";
            echo "</tr>";*/

        }
        else{
            echo "<td>Closed</td>";
            //echo $polldb->hasEnded($row['poll_id']);
            /*echo "<tr>";
            echo "<td>Poll closed</td>";
            echo "<form method='post' action='../poll.php'>";
            echo "<input type='hidden' name='poll_id' value='" . $row['poll_id'] . "'>";
            echo "<td><input type='submit' value='Vote' name='voteButton'></td>";
            echo "</form>";
            echo "</tr>";*/
        }

        echo "<form method='post' action='../poll.php'>";
        echo "<input type='hidden' name='poll_id' value='" . $row['poll_id'] . "'>";
        echo "<td><input style='align:center;' class='ui button' type='submit' value='Vote' name='voteButton'></td>";
        echo "</form>";
        echo "</tr>";
    }



?>
    </table>
</body>
</html>


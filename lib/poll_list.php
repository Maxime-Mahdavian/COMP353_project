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

</head>
<body>

<?php


    echo "<h1>List of Poll</h1>";
    $polldb = new Poll();

    $sql = "SELECT * FROM poll_main";
    $result = mysqli_query($db, $sql);
    ?>
    <table border='1'>
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
        echo "<td><input type='submit' value='Vote' name='voteButton'></td>";
        echo "</form>";
        echo "</tr>";
    }



?>
    </table>
</body>
</html>


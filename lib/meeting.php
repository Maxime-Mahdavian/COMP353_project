<?php
include('config.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Meeting page</title>

</head>
<body>
<h1>Create meeting</h1>
<form action="meeting_function.php" method="post">
    <input type="submit" value="Create" name="meetingButton">
</form>

<h1>Meeting List</h1>
<table border="1">
    <tr>
        <th>Agenda</th>
        <th>Time</th>
        <th>Duration</th>
        <th>Resolution</th>
        <th>Administator Meeting</th>
        <th>Edit</th>
    </tr>
    <?php


    $sql = "SELECT * FROM meeting";
    $row = mysqli_query($db, $sql);

    while($result = mysqli_fetch_array($row)){
        echo "<td>" . $result['agenda'] . "</td>";
        echo "<td>" . $result['time'] . "</td>";
        echo "<td>" . $result['minutes'] . "</td>";
        echo "<td>" . $result['resolution'] . "</td>";
        $admin = $result['administratorMeeting'] ? "yes" : "no";
        echo "<td>" . $admin . "</td>";

        $sql = "SELECT name FROM Users, meeting WHERE (meetingID=". $result['meetingID'] ." AND userID=". $_SESSION['ID'] ." AND creator=userID)";
        $x = mysqli_query($db,$sql);
        $temp = mysqli_num_rows($x);
        //If temp is 1, then the user is also the creator, then we need to display the edit functionality for the meeting
        //Also happens if user is an admin, then he can edit any meeting
        if($temp == 1 or $_SESSION['admin']){
            echo '<form action="meeting_function.php" method="post">';
            echo "<td><input type='submit' value='Edit' name='meetingButton'></td>";
            echo "<input type='hidden' name='meetingID' value='" . $result['meetingID'] . "'>";
            echo "</form>";
        }
        else{
            echo "<td>Not the creator</td>";
        }


        echo "</tr>";

    }
    ?>
</table>
<a href="welcome.php">Back</a>
</body>
</html>
<?php
//INIT
include('config.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Meeting page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
</head>
<body style="background-color: #d5e2ff;">
<div style = "background-color:#aca3ec; height:100px; color:#4D39D6; padding:3px;"><b><br><i class="huge chess rook icon"></i></b><b align="middle" style="margin-bottom:10px; color:white; font-size:40px;">CON</b></div>
    <br><br>
<div align="right">
    <button style="margin-left:1310px" class="ui blue left labeled icon button" type="submit" name="back" onclick="window.location.href='welcome.php';">
        <i class="left arrow icon"></i>
        Back to Main Page
    </button>
</div>
<div>
    <a style="margin:30px; font-size: 40px; color:black;" class="item">
        Meetings<i class="calendar alternate icon"></i>
    </a>
</div>

    <h1 style="margin-left:35px;" >Create meeting</h1>
    <form action="meeting_function.php" method="post">
        <input style="margin-left:45px;" class="ui blue button" type="submit" value="Create" name="meetingButton" >
    </form>

    <h1 style="margin-left:35px;">Meeting List</h1>
    <table class="ui inverted table" style="width:100%">
        <col style="width:25%">
        <col style="width:15%">
        <col style="width:5%">
        <col style="width:30%">
        <col style="width:15%">
        <col style="width:10%">
        <tr>
            <th>Agenda</th>
            <th>Time</th>
            <th>Duration</th>
            <th>Resolution</th>
            <th>Administrator Meeting</th>
            <th>Edit</th>
        </tr>
        <?php

        //Find all meetings then display them
        $sql = "SELECT * FROM meeting ORDER BY time DESC";
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
                echo "<td><input class='ui button' type='submit' value='Edit' name='meetingButton'></td>";
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
</body>
</html>
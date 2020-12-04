<?php
//INIT
include("config.php");
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Meeting functions</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
</head>
<body style="background-color: #d5e2ff;">
<div style = "background-color:#aca3ec; height:100px; color:#4D39D6; padding:3px;"><b><br><i class="huge chess rook icon"></i></b><b align="middle" style="margin-bottom:10px; color:white; font-size:40px;">CON</b></div>
<br><br>
<button style="margin-left:1325px" class="ui blue left labeled icon button" type="submit" name="back" onclick="window.location.href='meeting.php';">
    <i class="left arrow icon"></i>
    Back to Meetings
</button>
<a style="margin-left:30px; font-size: 40px; color:black;" class="item">
    Edit Meeting<i class="calendar icon"></i>
</a>
<?php
//Create a meeting
if(isset($_POST['create_meeting'])){
    $admin = ($_POST['admin'] == "on") ? 1 : 0;
    $sql = "INSERT INTO meeting (condoAssociationID, administratorMeeting, agenda, time, minutes, resolution, creator) VALUES" .
        "(".$_SESSION['condoAssociationID'].",".$admin .",'". $_POST['agenda']."','".
        $_POST['datetime']."',".$_POST['duration'].",\"".$_POST['resolution']."\",".$_SESSION['ID'].")";

    $result = mysqli_query($db, $sql) or die(mysqli_error($db));
    if($result){
        echo "<h1 style='margin-left:40px;'>Meeting created</h1>";
    }
    else{
        echo "<h1 style='margin-left:40px; color:red;'>Error creating the meeting</h1>";
    }
}
//Update a meeting with the new info
elseif(isset($_POST['edit_meeting'])){
    $admin = ($_POST['admin'] == "on") ? 1 : 0;
    $sql = "UPDATE meeting SET administratorMeeting=". $admin . ", agenda='" . $_POST['agenda'] . "', time='". $_POST['datetime'] .
    "', minutes=" . $_POST['duration'] . ", resolution=\"" . $_POST['resolution'] . "\" WHERE meetingID=" . $_POST['meetingID'];


    $result = mysqli_query($db, $sql);
    if($result){
        echo "<h1 style='margin-left:40px;'>Meeting information changed</h1>";
    }
    else{
        echo "<h1 style='margin-left:40px; color:red;'>Error changing meeting information</h1>";
    }
}
//Delete a meeting
elseif(isset($_POST['delete_meeting'])){
    $sql = "DELETE FROM meeting WHERE meetingID=". $_POST['meetingID'];
    $result = mysqli_query($db, $sql);

    if($result){
        echo "<h1 style='margin-left:40px;'>Meeting deleted</h1>";
    }
    else{
        echo "<h1 style='margin-left:40px; color:red;'>Error deleting meeting</h1>";
    }

}
?>

</body>
</html>

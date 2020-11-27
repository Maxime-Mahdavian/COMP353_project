<?php
include("config.php");
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Meeting functions</title>

</head>
<body>
<?php
if(isset($_POST['create_meeting'])){
    $admin = ($_POST['admin'] == "yes") ? 1 : 0;
    $sql = "INSERT INTO meeting (condoAssociationID, administratorMeeting, agenda, time, minutes, resolution, creator) VALUES" .
        "(".$_SESSION['condoAssociationID'].",".$admin .",'". $_POST['agenda']."','".
        $_POST['datetime']."',".$_POST['duration'].",'".$_POST['resolution']."',".$_SESSION['ID'].")";

    $result = mysqli_query($db, $sql);
    if($result){
        echo "<h1>Meeting created</h1>";
        echo "<button><a href='meeting.php'>Back</a></button>";
    }
    else{
        echo "<h1>Error creating the meeting</h1>";
        echo "<button><a href='meeting.php'>Back</a></button>";
    }
}
elseif(isset($_POST['edit_meeting'])){
    $admin = ($_POST['admin'] == "on") ? 1 : 0;
    $sql = "UPDATE meeting SET administratorMeeting=". $admin . ", agenda='" . $_POST['agenda'] . "', time='". $_POST['datetime'] .
    "', minutes=" . $_POST['duration'] . ", resolution='" . $_POST['resolution'] . "' WHERE meetingID=" . $_POST['meetingID'];

    $result = mysqli_query($db, $sql);
    if($result){
        echo "<h1>Meeting information changed</h1>";
        echo "<button><a href='meeting.php'>Back</a></button>";
    }
    else{
        echo "<h1>Error changing meeting information</h1>";
        echo "<button><a href='meeting.php'></a></button>";
    }
}
elseif(isset($_POST['delete_meeting'])){
    $sql = "DELETE FROM meeting WHERE meetingID=". $_POST['meetingID'];
    $result = mysqli_query($db, $sql);

    if($result){
        echo "<h1>Meeting deleted</h1>";
        echo "<button><a href='meeting.php'>Back</a></button>";
    }
    else{
        echo "<h1>Error deleting meeting</h1>";
        echo "<button><a href='meeting.php'></a></button>";
    }

}
?>

</body>
</html>

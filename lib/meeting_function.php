<?php
include ('config.php');
session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Meeting functions</title>

</head>
<body style="background-color: #d5e2ff;">

<?php
//This is the form displayed if the user wants to create a meeting
if($_POST['meetingButton'] == 'Create'){
    ?>
    <form action="edit_meeting.php" method="post">
        <label for="agenda">Agenda:</label>
        <br>
        <input type="text" name="agenda">
        <br>
        <label for="time:">Time:</label>
        <br>
        <input type="text" id="datetime24" data-format="YYY-MM-DD HH:mm:ss" data-template="YYYY / MM / DD     HH : mm" name="datetime" value="dd-mm-yyy HH:mm:ss">
        <br>
        <label for="duration">Duration:</label>
        <br>
        <input type="text" id="duration" name="duration">
        <br>
        <label for="resolution">Resolution:</label>
        <br>
        <input type="text" id="resolution" name="resolution">
        <br>
        <label for="admin">Administrator Meeting</label>
        <input type="checkbox" id="admin" name="admin">
        <br>
        <br>
        <input type="submit" name="create_meeting" value="submit">
    </form>
    <?php

}
//This is the form if a user wants to edit a meeting, it is the same form just with the current values as
//text in the fields
elseif($_POST['meetingButton'] == 'Edit'){
    $sql = "SELECT * FROM meeting WHERE meetingID=". $_POST['meetingID'];
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result);
    ?>
    <form action="edit_meeting.php" method="post">
        <label for="agenda">Agenda:</label>
        <br>
        <input type="text" name="agenda" value="<?php echo $row['agenda'];?>">
        <br>
        <label for="time:">Time:</label>
        <br>
        <input type="text" id="datetime24" data-format="YYYY-MM-DD HH:mm:ss" data-template="YYYY / MM / DD     HH : mm" name="datetime" value="<?php echo $row['time'];?>">
        <br>
        <label for="duration">Duration:</label>
        <br>
        <input type="text" id="duration" name="duration" value="<?php echo $row['minutes'];?>">
        <br>
        <label for="resolution">Resolution:</label>
        <br>
        <input type="text" id="resolution" name="resolution" value="<?php echo $row['resolution'];?>">
        <br>
        <label for="admin">Administrator Meeting</label>
        <input type="checkbox" id="admin" name="admin" <?php if($row['administratorMeeting'] == 1)echo "checked"; else echo "";?>>
        <br>
        <br>
        <input type="hidden" name="meetingID" value="<?php echo $_POST['meetingID'];?>">
        <input type="submit" name="edit_meeting" value="submit">
    </form>

    <form action="edit_meeting.php" method="post" onsubmit="return confirm('Are you sure you want to delete?');">
        <input type="hidden" name="meetingID" value="<?php echo $_POST['meetingID'];?>">
        <input type="submit" name="delete_meeting" value="Delete">
    </form>
    <?php
}
?>

<a href="meeting.php">Back</a>
</body>
</html>

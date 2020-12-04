<?php
include ('config.php');
session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Meeting functions</title>
    <script src="../checkInput.js"></script>
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
//This is the form displayed if the user wants to create a meeting
if($_POST['meetingButton'] == 'Create'){
    ?>
    <form action="edit_meeting.php" method="post">
        <div class="ui two column middle aligned relaxed grid basic segment">
            <div class="column">
                <div style=" background-color: #c9d3d8;" class="ui form segment AVAST_PAM_loginform">
                    <div class="field">
                        <label>Agenda</label>
                        <div class="ui left labeled icon input">
                            <input style=" border: solid;" type="text" placeholder="Agenda" name = "agenda">
                            <i class="clipboard icon"></i>
                        </div>
                    </div>
                    <div class="field">
                        <label>Time</label>
                        <div class="ui left labeled icon input">
                            <input style=" border: solid;" type="text" id="datetime24" data-format="YYY-MM-DD HH:mm:ss" data-template="YYYY / MM / DD     HH : mm" name="datetime" placeholder="dd-mm-yyy HH:mm:ss">
                            <i class="clock outline icon"></i>
                        </div>
                    </div>
                    <div class="field">
                        <label>Duration</label>
                        <div class="ui left labeled icon input">
                            <input style=" border: solid;" type="text" id="duration" name="duration" onblur="checkInput(this.value)" placeholder="XX minutes">
                            <i class="hourglass half icon"></i>
                        </div>
                    </div>
                    <div class="field">
                        <label>Resolution</label>
                        <div class="ui left labeled icon input">
                            <input style=" border: solid;" type="text" placeholder="Resolution" id="resolution" name="resolution">
                        </div>
                    </div>
                    <div class="ui checkbox">
                        <input style=" border: solid;" type="checkbox" id="admin" name="admin" <?php if($_SESSION['admin'] == 1) echo ""; else echo "disabled"; ?>">
                        <label for="admin">Administrator </label>
                    </div>
                    <br>
                    <br>

                    <input class="ui positive button" type="submit" name="create_meeting" value="submit">
                </div>
            </div>
        </div>
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
        <div style="margin-left:40px;" class="ui two column middle aligned relaxed grid basic segment">
            <div class="column">
                <div style=" background-color: #c9d3d8;" class="ui form segment AVAST_PAM_loginform">
                    <div class="field">
                        <label>Agenda</label>
                        <div class="ui left labeled icon input">
                            <input style=" border: solid;" type="text" placeholder="Agenda" name = "agenda" value="<?php echo $row['agenda'];?>">
                            <i class="clipboard icon"></i>
                        </div>
                    </div>
                    <div class="field">
                        <label>Time</label>
                        <div class="ui left labeled icon input">
                            <input style=" border: solid;" type="text" id="datetime24" data-format="YYY-MM-DD HH:mm:ss" data-template="YYYY / MM / DD     HH : mm" name="datetime" value="<?php echo $row['time'];?>">
                            <i class="clock outline icon"></i>
                        </div>
                    </div>
                    <div class="field">
                        <label>Duration</label>
                        <div class="ui left labeled icon input">
                            <input style=" border: solid;" type="text" id="duration" name="duration" value="<?php echo $row['minutes'];?>" onblur="checkInput(this.value)">
                            <i class="hourglass half icon"></i>
                        </div>
                    </div>
                    <div class="field">
                        <label>Resolution</label>
                        <div class="ui left labeled icon input">
                            <input style=" border: solid;" type="text" placeholder="Resolution" id="resolution" name="resolution" value="<?php echo $row['resolution'];?>">
                        </div>
                    </div>
                    <div class="ui checkbox">
                        <input style=" border: solid;" type="checkbox" id="admin" name="admin" <?php
                        if($row['administratorMeeting'] == 1)
                            echo "checked";
                        else
                            echo "";

                        if($_SESSION['admin'] == 0)
                            echo " disabled";
                        ?>>
                        <label for="admin">Administrator </label>
                    </div>
                    <br>
                    <br>
                    <input type="hidden" name="meetingID" value="<?php echo $_POST['meetingID'];?>">
                    <input class="ui positive button" type="submit" name="edit_meeting" value="submit">
                </div>
            </div>
        </div>
    </form>
    <br>
    <form style="margin-left:30px;" action="edit_meeting.php" method="post" onsubmit="return confirm('Are you sure you want to delete?');">
        <input type="hidden" name="meetingID" value="<?php echo $_POST['meetingID'];?>">
        <input class="ui red button" type="submit" name="delete_meeting" value="Delete Meeting">
    </form>
    <?php
}
?>
</body>
</html>

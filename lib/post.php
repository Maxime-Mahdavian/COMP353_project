<?php
require("config.php");
session_start() or die("Something went wrong");
if(!isset($_SESSION['username']))
    header("location: login.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Post</title>
    <link href="../theme.css" rel="stylesheet">
</head>
<body>
<form enctype="multipart/form-data" action="add.php" method="post" id="form">
    Title: <input type="text" name="title"><br>
    Body: <textarea form="form" type="text" name="body" class="bodyclass"></textarea><br>
    Image: <input type="file" name="img"><br>
    <!--Permission: <label><input type="checkbox" name="perm" value="public">Public</label>
    <label><input type="checkbox" name="perm" value="group">Group</label>
    <label><input type="checkbox" name="perm" value="private">Private</label><br>-->
    <label for="perm">Permission</label>
    <select name="perm" id="perm">
        <option value="public">Public</option>
        <option value="private">Private</option>
        <!--<option value="group">Group</option>-->
        <?php

            //For each groupID in $_SESSION, we need to find the name of the group to display
            foreach($_SESSION['groupID'] as $group){
                $sql = "SELECT name FROM groups WHERE groupID=" . $group;
                $row = mysqli_query($db, $sql);
                $result = mysqli_fetch_array($row);
                if(isset($_POST['post_group']) and $_POST['post_group'] == $result['name'])
                    echo "<option selected value='" . $group ."'>". $result['name']  . "</option>";
                else
                    echo "<option value='" . $group ."'>". $result['name'] . "</option>";
            }
        ?>
    </select><br>
    <input type="submit" value="Submit">
</form>
</body>
</html>
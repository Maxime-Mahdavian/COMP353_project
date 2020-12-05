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
    <title>New Post</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
</head>
<body style="background-color: #d5e2ff;">
<div style = "background-color:#aca3ec; height:100px; color:#4D39D6; padding:3px;"><b><br><i class="huge chess rook icon"></i></b><b align="middle" style="margin-bottom:10px; color:white; font-size:40px;">CON</b></div>
    <br>
    <br>
<button style="margin-left:1320px" class="ui blue left labeled icon button" type="submit" name="back" onclick="window.location.href='welcome.php';">
    <i class="left arrow icon"></i>
    Back to Main Page
</button>
    <a style="margin-left:30px; font-size: 40px; color:black;" class="item">
        New Post <i class="bullhorn icon"></i>
    </a>

    <form enctype="multipart/form-data" action="add.php" method="post" id="form">
        <div style="margin:30px;" class="ui two column middle aligned relaxed grid basic segment">
            <div class="column">
                <div style=" background-color: #c9d3d8;" class="ui form segment AVAST_PAM_loginform">
                    <div class="field">
                        <label>Title:</label>
                        <div style=" border: solid; border-radius: 5px;" class="ui input">
                            <input  type="text" placeholder="Title" name="title"><br>
                        </div>
                    </div>
                    <div class="field">
                        <label>Body:</label>
                        <div style=" border: solid; border-radius: 5px;" class="ui input">
                            <textarea form="form" type="text" name="body" class="bodyclass"></textarea><br>
                        </div>
                    </div>
                    <div class="field">
                        <label>Image:</label>
                        <div style=" border: solid; border-radius: 5px;" class="ui input">
                            <input class="ui button;" type="file" name="img"><br>
                        </div>
                    </div>
                    <div class="field">
                        <label for="perm">Permission:</label>
                        <select style=" border: solid; border-radius: 5px;" class="ui fluid dropdown" name="perm" id="perm">
                            <option value="public">Public</option>
                            <option value="private">Private</option>
                            <option value="Ad">Ad</option>
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
                                ?>\
                        </select>
                    </div>
                    <!--Permission: <label><input type="checkbox" name="perm" value="public">Public</label>
                    <label><input type="checkbox" name="perm" value="group">Group</label>
                    <label><input type="checkbox" name="perm" value="private">Private</label><br>-->

                    <input style="margin-left:570px;" class="ui green button" type="submit" value="Submit">
                </div>
            </div>
        </div>
    </form>
</body>
</html>
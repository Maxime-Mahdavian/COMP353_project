<?php
//INIT
include('config.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Group page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
</head>

<body style="background-color: #d5e2ff;">
<div style = "background-color:#aca3ec; height:100px; color:#4D39D6; padding:3px;"><b><br><i class="huge chess rook icon"></i></b><b align="middle" style="margin-bottom:10px; color:white; font-size:40px;">CON</b></div>
<br><br>
<button style="margin-left:1320px" class="ui blue left labeled icon button" type="submit" name="back" onclick="window.location.href='welcome.php';">
    <i class="left arrow icon"></i>
    Back to Main Page
</button>
<a style="margin:30px; font-size: 40px; color:black;" class="item">
    Groups<i class="users icon"></i>
</a>
<br>

<table class="ui inverted table">
    <thead>
        <th>Name</th>
        <th>Description</th>
        <th>Join/Withdraw</th>
        <th>Owner</th>
        <th>Post to group</th>
        <th>View Group post</th>
    </thead>
<?php

    //Display all the info about every group
    $sql = "SELECT * FROM groups";
    $row = mysqli_query($db, $sql) or die(mysqli_error($db));

    while($result = mysqli_fetch_array($row)){
        echo "<td>" . $result['name'] . "</td>";
        echo "<td>" . $result['description'] . "</td>";
        $sql = "SELECT * FROM group_membership WHERE gID=". $result['groupID'] ." AND uID=" . $_SESSION['ID'];
        $temp = mysqli_query($db,$sql);
        //$membership = mysqli_fetch_array($temp);
        $count = mysqli_num_rows($temp);
        $groupID = $result['groupID'];
        //If count is 1, then the user is part of the group, so give them the optin to withdraw
        if($count == 1) {
            echo '<form action="group_functions.php" method="post">';
            echo "<td><input class='ui button' type='submit' value='Withdraw' name='submitButton'></td>";
            echo "<input type='hidden' name='withdraw_group' value='" . $groupID . "'>";
            echo "</form>";
        }
        //If not, then give them the option to join
        else {
            echo '<form action="group_functions.php" method="post">';
            echo "<td><input class='ui button' type='submit' value='Join' name='submitButton'></td>";
            echo "<input type='hidden' name='join_group' value='" . $groupID . "'>";
            echo "</form>";
        }

        //If the owner matches the ID of the session, then the user is the owner of that group
        if($result['owner'] == $_SESSION['ID']){
            echo '<form action="group_functions.php" method="post">';
            echo "<input type='hidden' name='owner_group' value='" . $groupID . "'>";
            echo "<td><input class='ui button' type='submit' value='Owner' name='submitButton'></td>";
            echo "</form>";
        }

        else
            echo "<td>Not Owner</td>";

        //Once again, if the count is one, then the user is part of the group, he they have the option to view/post to the group
        if($count == 1){
            echo '<form action="post.php" method="post">';
            echo "<input type='hidden' name='post_group' value='" . $result['name'] . "'>";
            echo "<td><input class='ui button' type='submit' value='Post to group' name='Group_post'></td>";
            echo "</form>";

            echo '<form action="view_post.php" method="post">';
            echo "<input type='hidden' name='post_group' value='" . $groupID . "'>";
            echo "<td><input class='ui button' type='submit' value='View group post' name='Group_post'></td>";
            echo "</tr>";
            echo "</form>";
        }
        else{
            echo "<td>Cannot post to group</td>";
            echo "<td>Cannot view group post</td>";
        }


        echo "</tr>";

    }
?>
</table>


<!--<a href="welcome.php">Back</a>-->
</body>
</html>
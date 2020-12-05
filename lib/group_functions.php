<?php
//INIT
include ('config.php');
session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Group functions</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <!--<script src="owner.js"></script>-->
</head>
<body style="background-color: #d5e2ff;">
<div style = "background-color:#aca3ec; height:100px; color:#4D39D6; padding:3px;"><b><br><i class="huge chess rook icon"></i></b><b align="middle" style="margin-bottom:10px; color:white; font-size:40px;">CON</b></div>
<br><br>
<button style="margin-left:1380px" class="ui blue left labeled icon button" type="submit" name="back" onclick="window.location.href='group.php';">
    <i class="left arrow icon"></i>
    Back
</button>
<a style="margin:30px; font-size: 40px; color:black;" class="item">
    Group Functions  <i class="users icon"></i>
</a>
<br>

<?php

//Send the join request into the group_request table
if($_POST['submitButton'] == 'Join'){
    $sql = "INSERT  INTO group_request VALUES(". $_POST['join_group'] . "," . $_SESSION['ID'] . ")";
    $result = mysqli_query($db,$sql);
    echo "<h1 style='margin:50px'>Your request has been submitted, please wait for the owner of the group to accept your submission</h1>";
}
//Withdraw from the group
elseif ($_POST['submitButton'] == 'Withdraw'){

    $sql = "SELECT owner FROM `groups` WHERE groupID=". $_POST['withdraw_group'] . " AND owner=". $_SESSION['ID'];
    $result = mysqli_query($db, $sql);
    $count = mysqli_num_rows($result);

    //If count is 1, then the user is the owner of that group, and therefore cannot withdraw
    if($count==1){
        echo "<h1 style='margin:50px' ><i class='red exclamation triangle icon'></i>You cannot withdraw from the group, you are the owner</h1>";
        echo "<h1 style='margin:50px'><i class='red exclamation triangle icon'></i>Please change owner before withdrawing from the group</h1>";
    }
    //If it is not the owner, then we can move on and remove them from the table
    else{
        $sql = "DELETE FROM group_membership WHERE gID=".$_POST['withdraw_group']. " AND uID=" . $_SESSION['ID'];
        $result = mysqli_query($db,$sql);
        echo "<h1 style='margin:50px';>You have withdrawn from the group</h1>";
    }
}
//Various owner function, the back option is important since owners can move from page to page, and we need to make
//sure they can see this when they come back
elseif ($_POST['submitButton'] == 'Owner' or $_POST['backButton'] == 'Back') {

    //Display every group requests, with option to accept or refuse
$sql = "SELECT * FROM Users u, group_request g WHERE g.requested_userID=u.userID AND g.requested_groupID=" . $_POST['owner_group'];
$result = mysqli_query($db, $sql);
echo "<h1>Request list</h1>";
if(mysqli_num_rows($result) == 0)
    echo "<h2>NO REQUESTS</h2>";
else{
    echo "<table class='ui inverted blue table''>";
    /*echo "<tr>";
    echo "<th>Name</th>";
    echo "<th>Accept</th>";
    echo "<th>Refuse</th>";
    echo "</tr>";*/
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo '<form action="owner_functions.php" method="post">';
        echo "<input type='hidden' name='Rgroup' value='" . $_POST['owner_group'] . "'>";
        echo "<input type='hidden' name='Ruser' value='" . $row['userID'] . "'>";
        echo "<td><input class='ui green button' type='submit' value='Accept' name='ownerButton'></td>";
        //echo "</form>";
        echo '<form action="owner_functions.php" method="post">';
        echo "<input type='hidden' name='Rgroup' value='" . $_POST['owner_group'] . "'>";
        echo "<input type='hidden' name='Ruser' value='" . $row['userID'] . "'>";
        echo "<td><input class='ui red button' type='submit' value='Refuse' name='ownerButton'></td>";


        echo "</tr>";
        echo "</form>";
    }
    echo "</table>";
}

echo "<hr>";

//Display every member in the group, with options to make them owners, or kick them
$sql = "SELECT * FROM Users u, group_membership g WHERE g.gID=". $_POST['owner_group'] . " AND g.uID=u.userID";
$result = mysqli_query($db, $sql);



?>
<table class="ui inverted table">
    <tr>
        <th>Member</th>
        <th>Kick</th>
        <th>Changer ownership</th>
    </tr>

    <?php
    while($row = mysqli_fetch_array($result)){
        echo "<tr>";
        $sql = "SELECT owner FROM groups g where groupID=". $_POST['owner_group']." and owner=". $row['userID'];
        if(mysqli_num_rows(mysqli_query($db,$sql)) == 1){
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>Owner</td>";
            echo "<td>Owner</td>";
            echo "</tr>";
        }
        else {
            echo "<td>" . $row['name'] . "</td>";
            echo '<td><form action="owner_functions.php" method="post">';
            echo '<input type="hidden" id="user" name="kick_user" value="' . $row['userID'] . '">';
            echo "<input type='hidden' name='kick_group' value='" . $_POST['owner_group'] . "'>";
            echo '<input class="ui button" type="submit" name="Kick" value="Kick">';
            echo "</form></td>";
            echo '<td><form onsubmit="return confirm(\'Do you really want to change owner\');" action="owner_functions.php" method="post">';
            echo '<input type="hidden" id="user" name="owner_user" value="' . $row['userID'] . '">';
            echo "<input type='hidden' name='owner_group' value='" . $_POST['owner_group'] . "'>";
            echo '<input class="ui button" type="submit" name="Make_Owner" value="Make Owner">';
            echo "</form></td>";
            echo "</tr>";
        }
    }

    }
    /*elseif($_POST['backButton'] == 'Back'){
        echo "<h1>I hope this works</h1>";
    }*/


    ?>
</table>
</body>
</html>

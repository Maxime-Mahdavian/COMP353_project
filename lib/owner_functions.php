<?php
//INIT
include("config.php");
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Group Functions</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">

</head>
<body style="background-color: #d5e2ff;">
<div style = "background-color:#aca3ec; height:100px; color:#4D39D6; padding:3px;"><b><br><i class="huge chess rook icon"></i></b><b align="middle" style="margin-bottom:10px; color:white; font-size:40px;">CON</b></div>
<br>
<br>
<!--<form action="group_functions.php" method="post">
<input style="margin-left:1325px" class="ui blue left labeled icon button" type="submit" name="backButton" value="Back">
<input type='hidden' name='owner_group' value='<?php /*echo $_POST['Rgroup']*/?>'>
</form>-->
<a style="margin-left:30px; font-size: 40px;" class="item">
    Owner Functions<i class="wrench icon"></i>
</a>

<br>
<?php

//If the owner comes back when they decline deleting a user
$ownerCameBack = true;

//This is the block to handle requests to join group
//If accept request, then we want to add the right rwo to group membership, and delete the row from group request
//If refuse, then we just want to delete from group request
if(isset($_POST['ownerButton'])){
    if($_POST['ownerButton'] == 'Accept'){
        $sql = "INSERT INTO group_membership VALUES(" . $_POST['Rgroup'] . "," . $_POST['Ruser'] . ")";
        $firstQuery = mysqli_query($db,$sql);
        $sql = "DELETE FROM group_request WHERE requested_groupID=". $_POST['Rgroup'] . " AND requested_userID=". $_POST['Ruser'];
        $secondQuery = mysqli_query($db,$sql);

        if ($firstQuery and $secondQuery){
            echo "<h1 style='margin:50px;'>The request has been accepted</h1>";
            echo "<form method='post' action='group_functions.php'>";
            echo "<input type='hidden' name='owner_group' value='" . $_POST['Rgroup'] . "'>";
            echo "<input style='position: fixed; left: 1380px; top: 140px' type='submit' value='Back' name='backButton' class='ui blue left labeled icon button'>";
            echo "</form>";
        }
        else{
            echo "<h1 style='margin:50px;' ><i class='red exclamation triangle icon'></i>There was an error</h1>";
            echo "<form method='post' action='group_functions.php'>";
            echo "<input type='hidden' name='owner_group' value='" . $_POST['Rgroup'] . "'>";
            echo "<input style='position: fixed; left: 1380px; top: 140px' type='submit' value='Back' name='backButton' class='ui blue left labeled icon button'>";
            echo "</form>";
        }
    }
    elseif ($_POST['ownerButton'] == "Refuse"){
        $sql = "DELETE FROM group_request WHERE requested_groupID=" . $_POST['Rgroup'] . " AND requested_userID=" . $_POST['Ruser'];
        mysqli_query($db, $sql);
        echo "<h1 style='margin:50px;'>The request has been accepted</h1>";
        echo "<form method='post' action='group_functions.php'>";
        echo "<input type='hidden' name='owner_group' value='" . $_POST['Rgroup'] . "'>";
        echo "<input style='position: fixed; left: 1380px; top: 140px' type='submit' value='Back' name='backButton' class='ui blue left labeled icon button'>";
        echo "</form>";
    }
}
elseif (isset($_POST['Kick'])){
    $sql = "DELETE FROM group_membership WHERE gID=" . $_POST['kick_group'] . " AND uID=". $_POST['kick_user'];
    $result = mysqli_query($db,$sql);

    if($result){
        echo "<h1 style='margin:50px;'>This user has been kicked</h1>";
        echo "<form method='post' action='group_functions.php'>";
        echo "<input type='hidden' name='owner_group' value='" . $_POST['kick_group'] . "'>";
        echo "<input style='position: fixed; left: 1380px; top: 140px' type='submit' value='Back' name='backButton' class='ui blue left labeled icon button'>";

        echo "</form>";
    }
    else{
        echo "<h1 style='margin:50px;' ><i class='red exclamation triangle icon'></i>Error</h1>";
        echo "<form method='post' action='group_functions.php'>";
        echo "<input type='hidden' name='owner_group' value='" . $_POST['kick_group'] . "'>";
        echo "<input style='position: fixed; left: 1380px; top: 140px' type='submit' value='Back' name='backButton' class='ui blue left labeled icon button'>";
        echo "</form>";
    }
}

//Block to change ownership
//Simple sql query to change update the row
elseif(isset($_POST['Make_Owner']) or $ownerCameBack){



    $sql = "UPDATE groups SET owner=" . $_POST['owner_user'] . " WHERE groupID=" . $_POST['owner_group'];
    $result = mysqli_query($db, $sql);

    if ($result) {
        echo "<h1 style='margin:50px;'>The owner has been changed</h1>";

    } else {
        echo "<h1 style='margin:50px;' ><i class='red exclamation triangle icon'></i>Error</h1>";

    }
    echo "<form method='post' action='group.php'>";
    echo "<input type='hidden' name='owner_group' value='" . $_POST['owner_group'] . "'>";
    echo "<input style='position: fixed; left: 1380px; top: 140px' type='submit' value='Back' name='backButton' class='ui blue left labeled icon button'>";
    echo "</form>";

}
?>


</body>
</html>

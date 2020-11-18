<!DOCTYPE html>
<html>
<head>
    <title>Test</title>


</head>
<body>
<?php
include("config.php");
session_start();
$ownerCameBack = true;
if(isset($_POST['ownerButton'])){
    if($_POST['ownerButton'] == 'Accept'){
        $sql = "INSERT INTO group_membership VALUES(" . $_POST['Rgroup'] . "," . $_POST['Ruser'] . ")";
        $firstQuery = mysqli_query($db,$sql);
        $sql = "DELETE FROM group_request WHERE requested_groupID=". $_POST['Rgroup'] . " AND requested_userID=". $_POST['Ruser'];
        $secondQuery = mysqli_query($db,$sql);

        if ($firstQuery and $secondQuery){
            echo "<h1>The request has been accepted</h1>";
            echo "<form method='post' action='group_functions.php'>";
            echo "<input type='hidden' name='owner_group' value='" . $_POST['Rgroup'] . "'>";
            echo "<input type='submit' value='Back' name='backButton'>";
            echo "</form>";
        }
        else{
            echo "<h1>There was an error</h1>";
            echo "<form method='post' action='group_functions.php'>";
            echo "<input type='hidden' name='owner_group' value='" . $_POST['Rgroup'] . "'>";
            echo "<input type='submit' value='Back' name='backButton'>";
            echo "</form>";
        }
    }
    elseif ($_POST['ownerButton'] == "Refuse"){
        $sql = "DELETE FROM group_request WHERE requested_groupID=" . $_POST['Rgroup'] . " AND requested_userID=" . $_POST['Ruser'];
        mysqli_query($db, $sql);
        echo "<h1>The request has been accepted</h1>";
        echo "<form method='post' action='group_functions.php'>";
        echo "<input type='hidden' name='owner_group' value='" . $_POST['Rgroup'] . "'>";
        echo "<input type='submit' value='Back' name='backButton'>";
        echo "</form>";
    }
}
elseif (isset($_POST['Kick'])){
    $sql = "DELETE FROM group_membership WHERE gID=" . $_POST['kick_group'] . " AND uID=". $_POST['kick_user'];
    $result = mysqli_query($db,$sql);

    if($result){
        echo "<h1>This user has been kicked</h1>";
        echo "<form method='post' action='group_functions.php'>";
        echo "<input type='hidden' name='owner_group' value='" . $_POST['kick_group'] . "'>";
        echo "<input type='submit' value='Back' name='backButton'>";
        echo "</form>";
    }
    else{
        echo "<h1>Error</h1>";
        echo "<form method='post' action='group_functions.php'>";
        echo "<input type='hidden' name='owner_group' value='" . $_POST['kick_group'] . "'>";
        echo "<input type='submit' value='Back' name='backButton'>";
        echo "</form>";
    }
}
elseif(isset($_POST['Make_Owner']) or $ownerCameBack){



    $sql = "UPDATE groups SET owner=" . $_POST['owner_user'] . " WHERE groupID=" . $_POST['owner_group'];
    $result = mysqli_query($db, $sql);

    if ($result) {
        echo "<h1>The owner has been changed</h1>";
        echo "<button><a href='group.php'>Back</a></button>";
    } else {
        echo "<h1>Error</h1>";
        echo "<button><a href='group.php'>Back</a></button>";

    }

}
?>


</body>
</html>
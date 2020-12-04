<?php
//INIT
include("config.php");
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contract functions</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
</head>
<body style="background-color: #d5e2ff;">
<div style = "background-color:#aca3ec; height:100px; color:#4D39D6; padding:3px;"><b><br><i class="huge chess rook icon"></i></b><b align="middle" style="margin-bottom:10px; color:white; font-size:40px;">CON</b></div>
<br><br>
<button style="margin-left:1370px" class="ui blue left labeled icon button" type="submit" name="back" onclick="window.location.href='manage_contract.php';">
    <i class="left arrow icon"></i>
    Back
</button>
<a style="margin-left:30px; font-size: 40px; color:black;" class="item">
    Edit Contract <i class="file alternate icon"></i>
</a>
<?php
//We need to add the contribution in the db
if(isset($_POST['create_contribution'])){

    $sql = "INSERT INTO contribution (contractID,condoAssociationID,userID,price,reason) VALUES " .
        "(".$_POST['contractID'].",".$_SESSION['condoAssociationID'] .",". $_SESSION['ID'].",".
        $_POST['price'].",\"".$_POST['reason']."\")";


    $result = mysqli_query($db, $sql) or die(mysqli_error($db));
    if($result){
        echo "<h1 style='margin-left:50px; color: green;'>Contribution created</h1>";
    }
    else{
        echo "<h1 style='margin-left:50px; color: red;'>Error creating the contribution</h1>";
    }
}
//Deactivate a contract
elseif(isset($_POST['DeactivateButton'])) {

    $sql = "UPDATE contracts SET status= 'Inactive' WHERE contractID= " . $_POST['contractID'];
    $result = mysqli_query($db,$sql) or die (mysqli_error());

    if($result){
        echo "<h1 style='margin-left:50px; color: green;'>Contract updated</h1>";
    }
}
//Activate a contract, in real life, this would not be super realistic, since terms for contracts would probably change
//but in this case it is reasonable to assume that they would be the same
elseif(isset($_POST['ActivateButton'])) {

    $sql = "UPDATE contracts SET status= 'Active' WHERE contractID= " . $_POST['contractID'];
    $result = mysqli_query($db,$sql) or die (mysqli_error($db));

    if($result){
        echo "<h1 style='margin-left:50px; color: green;'>Contract updated</h1>";
    }
}
//Delete a contribution
elseif(isset($_POST['DelContributionButton'])){

    $sql = "DELETE FROM contribution WHERE contributionID=" . $_POST['contributionID'];
    $result = mysqli_query($db,$sql) or die(mysqli_error($db));

    if($result){
        echo "<h1 style='margin-left:50px; color: green;'>Contribution Deleted</h1>";
    }
}

//Delete a maintenance
elseif(isset($_POST['DelMaintenanceButton'])){

    $sql = "DELETE FROM maintenance WHERE maintenanceID=" . $_POST['maintenanceID'];
    $result = mysqli_query($db,$sql) or die(mysqli_error($db));

    if($result){
        echo "<h1 style='margin-left:50px; color: green;'>Maintenance Deleted</h1>";
    }
}
//Create a contract
elseif (isset($_POST['create_contract'])){

    $sql = "INSERT INTO contracts (condoAssociationID,description,awarded,price, status) VALUES " .
        "(".$_SESSION['condoAssociationID'] .",'". $_POST['description']."','".
        $_POST['awarded']."',".$_POST['price']. ", 'Active')";


    $result = mysqli_query($db, $sql);
    if($result){
        echo "<h1 style='margin-left:50px; color: green;'>Contract created</h1>";
    }
    else{
        echo "<h1 style='margin-left:50px; color: red;'>Error creating the contract</h1>";
    }
}
//Create a maintenance
elseif (isset($_POST['create_maintenance'])){

    $sql = "SELECT awarded FROM contracts WHERE contractID=". $_POST['contractID'];
    $temp = mysqli_query($db,$sql);

    $contractor = mysqli_fetch_array($temp);

    $sql = "INSERT INTO maintenance (contractID,condoAssociationID,contractor,cost,rationale) VALUES " .
        "(" . $_POST['contractID'] . "," .$_SESSION['condoAssociationID'] .",'". $contractor['awarded']."','".
        $_POST['cost']."','".$_POST['rationale']. "')";


    $result = mysqli_query($db, $sql);
    if($result){
        echo "<h1 style='margin-left:50px; color: green;'>Maintenance created</h1>";
    }
    else{
        echo "<h1 style='margin-left:50px; color: red;'>Error creating the maintenance</h1>";
    }
}

?>

</body>
</html>

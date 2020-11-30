<?php
include("config.php");
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contract functions</title>

</head>
<body>
<?php
if(isset($_POST['create_contribution'])){

    $sql = "INSERT INTO contribution (contractID,condoAssociationID,userID,price,reason) VALUES " .
        "(".$_POST['contractID'].",".$_SESSION['condoAssociationID'] .",". $_SESSION['ID'].",".
        $_POST['price'].",'".$_POST['reason']."')";


    $result = mysqli_query($db, $sql);
    if($result){
        echo "<h1>Contribution created</h1>";
        echo "<button><a href='contracts.php'>Back</a></button>";
    }
    else{
        echo "<h1>Error creating the contribution</h1>";
        echo "<button><a href='contracts.php'>Back</a></button>";
    }
}
elseif(isset($_POST['DeactivateButton'])) {

    $sql = "UPDATE contracts SET status= 'Inactive' WHERE contractID= " . $_POST['contractID'];
    $result = mysqli_query($db,$sql) or die (mysqli_error());

    if($result){
        echo "<h1>Contract updated</h1>";
        echo "<button><a href='manage_contract.php'>Back</a></button>";
    }
}
elseif(isset($_POST['ActivateButton'])) {

    $sql = "UPDATE contracts SET status= 'Active' WHERE contractID= " . $_POST['contractID'];
    $result = mysqli_query($db,$sql) or die (mysqli_error($db));

    if($result){
        echo "<h1>Contract updated</h1>";
        echo "<button><a href='manage_contract.php'>Back</a></button>";
    }
}
elseif(isset($_POST['DelContributionButton'])){

    $sql = "DELETE FROM contribution WHERE contributionID=" . $_POST['contributionID'];
    $result = mysqli_query($db,$sql) or die(mysqli_error($db));

    if($result){
        echo "<h1>Contribution Deleted</h1>";
        echo "<button><a href='manage_contract.php'>Back</a></button>";
    }
}

elseif(isset($_POST['DelMaintenanceButton'])){

    $sql = "DELETE FROM maintenance WHERE maintenanceID=" . $_POST['maintenanceID'];
    $result = mysqli_query($db,$sql) or die(mysqli_error($db));

    if($result){
        echo "<h1>Maintenance Deleted</h1>";
        echo "<button><a href='manage_contract.php'>Back</a></button>";
    }
}

elseif (isset($_POST['create_contract'])){

    $sql = "INSERT INTO contracts (condoAssociationID,description,awarded,price, status) VALUES " .
        "(".$_SESSION['condoAssociationID'] .",'". $_POST['description']."','".
        $_POST['awarded']."',".$_POST['price']. ", 'Active')";


    $result = mysqli_query($db, $sql);
    if($result){
        echo "<h1>Contract created</h1>";
        echo "<button><a href='manage_contract.php'>Back</a></button>";
    }
    else{
        echo "<h1>Error creating the contract</h1>";
        echo "<button><a href='manage_contract.php'>Back</a></button>";
    }
}

elseif (isset($_POST['create_maintenance'])){

    $sql = "SELECT awarded FROM contracts WHERE contractID=". $_POST['contractID'];
    $temp = mysqli_query($db,$sql);

    $contractor = mysqli_fetch_array($temp);

    $sql = "INSERT INTO maintenance (contractID,condoAssociationID,contractor,cost,rationale) VALUES " .
        "(" . $_POST['contractID'] . "," .$_SESSION['condoAssociationID'] .",'". $contractor['awarded']."','".
        $_POST['cost']."','".$_POST['rationale']. "')";


    $result = mysqli_query($db, $sql);
    if($result){
        echo "<h1>Maintenance created</h1>";
        echo "<button><a href='manage_contract.php'>Back</a></button>";
    }
    else{
        echo "<h1>Error creating the maintenance</h1>";
        echo "<button><a href='manage_contract.php'>Back</a></button>";
    }
}

?>

</body>
</html>

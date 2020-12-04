<?php
//INIT
include('config.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contracts page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
</head>
<body style="background-color: #d5e2ff;">
<div style = "background-color:#aca3ec; height:100px; color:#4D39D6; padding:3px;"><b><br><i class="huge chess rook icon"></i></b><b align="middle" style="margin-bottom:10px; color:white; font-size:40px;">CON</b></div>
<br><br>
<form action="../admin_page.html" method="post">
    <button style="margin-left:1275px" class="ui blue left labeled icon button" type="submit" name="back" >
        <i class="left arrow icon"></i>
        Back to Administrator Options
    </button>
</form>
<a style="margin:30px; font-size: 40px; color:black;" class="item">
    Manage Contracts <i class="wrench icon"></i>
</a>
<br>

<h1 style="margin-left:35px;" >Create Contract</h1>
<form action="contract_functions.php" method="post">
    <input style="margin-left:45px;" class="ui blue button" type="submit" value="Create" name="ContractButton" >
</form>

<h1 style="margin-left:35px;">Create Maintenance</h1>
<form action="contract_functions.php" method="post">
    <input style="margin-left:45px;" class="ui blue button" type="submit" value="Create" name="MaintenanceButton" >
</form>

<h1 style="margin-left:35px;">Contract List</h1>
<table border="1" class="ui inverted table" style="width:100%;">
    <col style="width:20%">
    <col style="width:50%">
    <col style="width:15%">
    <col style="width:10%">
    <col style="width:5%">
    <tr>
        <th>Contractor</th>
        <th>Description</th>
        <th>Price</th>
        <th>Status</th>
        <th>Deactivate</th>
    </tr>
    <?php

    //Find all meetings then display them
    $sql = "SELECT * FROM contracts WHERE condoAssociationID=" . $_SESSION['condoAssociationID'];
    $row = mysqli_query($db, $sql);

    while($result = mysqli_fetch_array($row)){
        echo "<td>" . $result['awarded'] . "</td>";
        echo "<td>" . $result['description'] . "</td>";
        echo "<td>$" . $result['price'] . "</td>";
        echo "<td>" . $result['status'] . "</td>";

        if($result['status'] == "Active"){
            echo '<form action="edit_contract.php" method="post">';
            echo "<td><input class='ui button' type='submit' value='Deactivate' name='DeactivateButton'></td>";
            echo "<input type='hidden' name='contractID' value='" . $result['contractID'] . "'>";
            echo "</form>";
        }
        else{
            echo '<form action="edit_contract.php" method="post">';
            echo "<td><input class='ui button' type='submit' value='Activate' name='ActivateButton'></td>";
            echo "<input type='hidden' name='contractID' value='" . $result['contractID'] . "'>";
            echo "</form>";
        }


        echo "</tr>";

    }
    ?>
</table>

<h1 style="margin-left:35px;">Contribution List</h1>
<table border="1" class="ui inverted table" style="width:100%;">
    <col style="width:30%">
    <col style="width:20%">
    <col style="width:15%">
    <col style="width:20%">
    <col style="width:5%">
    <tr>
        <th>Reason</th>
        <th>Donator</th>
        <th>Contract</th>
        <th>Date</th>
        <th>Delete</th>
    </tr>
    <?php


    $sql = "SELECT * FROM contribution WHERE condoAssociationID=". $_SESSION['condoAssociationID'] ." ORDER BY date_payed DESC";
    $row = mysqli_query($db, $sql);

    while($result = mysqli_fetch_array($row)){
        echo "<td>" . $result['reason'] . "</td>";

        $sql = "SELECT name from Users u, contribution c WHERE c.userID=" . $result['userID'] . " AND c.userID=u.userID";
        $temp = mysqli_query($db, $sql);
        $x = mysqli_fetch_array($temp);
        echo "<td>" . $x['name'] . "</td>";

        $sql = "SELECT description from contracts where contractID=" . $result['contractID'];
        $temp = mysqli_query($db, $sql);
        $y = mysqli_fetch_array($temp);
        echo "<td>" . $y['description'] . "</td>";
        echo "<td>" . $result['date_payed'] . "</td>";

        echo '<form action="edit_contract.php" method="post" onsubmit="return confirm(\'Are you sure you want to delete this contribution?\')">';
        echo "<td><input class='ui button' type='submit' value='Delete Contribution' name='DelContributionButton'></td>";
        echo "<input type='hidden' name='contributionID' value='" . $result['contributionID'] . "'>";
        echo "</form>";

        echo "</tr>";

    }
    ?>
</table>

<h1 style="margin-left:35px;">Maintenance list</h1>
<table border="1" class="ui inverted table" style="width:100%;">
    <col style="width:25%">
    <col style="width:25%">
    <col style="width:15%">
    <col style="width:15%">
    <col style="width:15%">
    <col style="width:5%">
    <tr>
        <th>Rationale</th>
        <th>Contractor</th>
        <th>Contract</th>
        <th>Cost</th>
        <th>Date</th>
        <th>Delete</th>
    </tr>
    <?php


    $sql = "SELECT * FROM maintenance WHERE condoAssociationID=". $_SESSION['condoAssociationID'] ." ORDER BY date DESC";
    $row = mysqli_query($db, $sql);

    while($result = mysqli_fetch_array($row)){
        echo "<td>" . $result['rationale'] . "</td>";

        echo "<td>" . $result['contractor'] . "</td>";

        $sql = "SELECT description from contracts where contractID=" . $result['contractID'];
        $temp = mysqli_query($db, $sql);
        $y = mysqli_fetch_array($temp);
        echo "<td>" . $y['description'] . "</td>";
        echo "<td>$" . $result['cost'] . "</td>";
        echo "<td>" . $result['date'] . "</td>";

        echo '<form action="edit_contract.php" method="post" onsubmit="return confirm(\'Are you sure you want to delete this maintenance?\')">';
        echo "<td><input class='ui button' type='submit' value='Delete Maintenance' name='DelMaintenanceButton'></td>";
        echo "<input type='hidden' name='maintenanceID' value='" . $result['maintenanceID'] . "'>";
        echo "</form>";

        echo "</tr>";

    }
    ?>
</table>

</body>
</html>
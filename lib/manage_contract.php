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

</head>
<body>

<h1 style="margin-left:35px;" >Create Contract</h1>
<form action="contract_functions.php" method="post">
    <input style="margin-left:45px;" class="ui blue button" type="submit" value="Create" name="ContractButton" >
</form>

<h1>Create Maintenance</h1>
<form action="contract_functions.php" method="post">
    <input style="margin-left:45px;" class="ui blue button" type="submit" value="Create" name="MaintenanceButton" >
</form>

<h1>Contract List</h1>
<table border="1">
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

<h1>Contribution List</h1>
<table border="1">
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

<h1>Maintenance list</h1>
<table border="1">
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


<a href="../admin_page.html">Back</a>
</body>
</html>
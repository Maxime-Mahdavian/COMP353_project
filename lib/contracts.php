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
<div align="right">
    <button style="margin-left:1320px" class="ui blue left labeled icon button" type="submit" name="back" onclick="window.location.href='welcome.php';">
        <i class="left arrow icon"></i>
        Back to Main Page
    </button>
</div>
<div>
    <a style="margin:30px; font-size: 40px; color:black;" class="item">
        Contracts<i class="file alternate icon"></i>
    </a>
</div>
<br>

<h1 style="margin-left:40px;" >Create Contribution</h1>
<form action="contract_functions.php" method="post">
    <input style="margin-left:50px;" class="ui blue button" type="submit" value="Create" name="ContributionButton" >
</form>

<h1 style="margin-left:40px;">Contribution List</h1>
<table style="margin-left:50px; width:70%;" border="1" class="ui inverted table">
    <col style="width:50%">
    <col style="width:15%">
    <col style="width:20%">
    <col style="width:15%">
    <tr>
        <th>Reason</th>
        <th>Donator</th>
        <th>Contract</th>
        <th>Date</th>
    </tr>
    <?php

    //Find all contributions for this association then display them
    $sql = "SELECT * FROM contribution WHERE condoAssociationID=". $_SESSION['condoAssociationID'] ." ORDER BY date_payed DESC";
    $row = mysqli_query($db, $sql);

    //Display table
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



        echo "</tr>";

    }
    ?>
</table>

<h1 style="margin-left:40px;">Maintenance list</h1>
<table style="margin-left:50px; width:70%;" border="1" class="ui inverted table">
    <col style="width:45%">
    <col style="width:15%">
    <col style="width:15%">
    <col style="width:10%">
    <col style="width:15%">
    <tr>
        <th>Rationale</th>
        <th>Contractor</th>
        <th>Contract</th>
        <th>Cost</th>
        <th>Date</th>
    </tr>
    <?php

    //Find all maintenance for the association then display them
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



        echo "</tr>";

    }
    ?>
</table>
</body>
</html>
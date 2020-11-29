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

<h1>Contribution List</h1>
<table border="1">
    <tr>
        <th>Reason</th>
        <th>Donator</th>
        <th>Contract</th>
        <th>Date</th>
    </tr>
    <?php

    //Find all meetings then display them
    $sql = "SELECT * FROM contribution ORDER BY date_payed DESC";
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
    </tr>
    <?php

    //Find all meetings then display them
    $sql = "SELECT * FROM maintenance ORDER BY date DESC";
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
<a href="welcome.php">Back</a>
</body>
</html>
<?php
include('config.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Group page</title>

</head>
<body>
<h1>Group</h1>
<table border="1">
    <tr>
        <th>Name</th>
        <th>Description</th>
    </tr>
<?php
    //echo "<h1>" . $_SESSION['groupID'] . "</h1>";
    $sql = "SELECT groupID FROM groups g, group_membership m WHERE g.groupID = m.gID AND m.uID=". $_SESSION['ID'];
    $result2 = mysqli_query($db, $sql);
    $list = [];
    while($answer = mysqli_fetch_array($result2)){
        array_push($list, $answer['groupID']);
    }

    foreach ($_SESSION['groupID'] as $group){
        echo "<tr>";
        $sql = "SELECT * FROM groups WHERE groupID=".$group;
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_array($result);
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "</tr>";
    }



?>
</table>
</body>
</html>
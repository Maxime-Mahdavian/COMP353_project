<?php
include ('config.php');
session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Contract functions</title>
    <script src="../checkInput.js"></script>

</head>
<body>

<?php
//This is the form displayed if the user wants to create a meeting
if($_POST['ContributionButton'] == 'Create'){
    ?>
    <form action="edit_contract.php" method="post">
        <label for="contractID">Contractor:</label>
        <br>
        <select name="contractID">
            <?php

            $sql = "select awarded,contractID from contracts WHERE status='Active'";
            $result = mysqli_query($db,$sql);

            while($row = mysqli_fetch_array($result)){
                echo "<option value='" . $row['contractID'] ."'>". $row['awarded']  . "</option>";
            }
            ?>
        </select>
        <br>
        <label for="price:">Price:</label>
        <br>
        <input type="text" name="price" onblur="checkInput(this.value)">
        <br>
        <label for="reason">Reason:</label>
        <br>
        <input type="text" name="reason">
        <br>
        <input type="submit" name="create_contribution" value="submit">
    </form>
    <a href="contracts.php">Back</a>
    <?php

}
elseif (isset($_POST['ContractButton'])){
    ?>
    <form action="edit_contract.php" method="post">
        <label for="awarded">Contractor:</label>
        <br>
        <input type="text" name="awarded">
        <br>
        <label for="description:">Description:</label>
        <br>
        <input type="text" name="description">
        <br>
        <label for="Price">Price:</label>
        <br>
        <input type="text" name="price">
        <br>
        <input type="submit" name="create_contract" value="submit">
    </form>


<?php
    echo '<a href="manage_contract.php">Back</a>';
}

elseif (isset($_POST['MaintenanceButton'])){
    ?>
    <form action="edit_contract.php" method="post">
        <label for="contractID">Contractor:</label>
        <br>
        <select name="contractID">
            <?php

            $sql = "select awarded,contractID from contracts WHERE status='Active'";
            $result = mysqli_query($db,$sql);

            while($row = mysqli_fetch_array($result)){
                echo "<option value='" . $row['contractID'] ."'>". $row['awarded']  . "</option>";
            }
            ?>
        </select>
        <br>
        <label for="price:">Cost:</label>
        <br>
        <input type="text" name="cost">
        <br>
        <label for="reason">Rationale:</label>
        <br>
        <input type="text" name="rationale">
        <br>
        <input type="submit" name="create_maintenance" value="submit">
    </form>
    <?php
    echo '<a href="manage_contract.php">Back</a>';
}
?>


</body>
</html>

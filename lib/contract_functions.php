<?php

//INIT
include ('config.php');
session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Contract functions</title>
    <script src="../checkInput.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
</head>
<body style="background-color: #d5e2ff;">
<div style = "background-color:#aca3ec; height:100px; color:#4D39D6; padding:3px;"><b><br><i class="huge chess rook icon"></i></b><b align="middle" style="margin-bottom:10px; color:white; font-size:40px;">CON</b></div>
<br><br>
<a style="margin:30px; font-size: 40px; color:black;" class="item">
    Manage Contracts <i class="wrench icon"></i>
</a>
<?php
//This is the form displayed if the user wants to create a contribution
if($_POST['ContributionButton'] == 'Create'){
    ?>
<div align="right">
    <button style="margin-left:1370px" class="ui blue left labeled icon button" type="submit" name="back" onclick="window.location.href='contracts.php';">
        <i class="left arrow icon"></i>
        Back
    </button>
</div>
    <form action="edit_contract.php" method="post" onsubmit="return checkInput(document.getElementById('price').value, 'price')">
        <div style="margin:30px;" class="ui two column middle aligned relaxed grid basic segment">
            <div class="column">
                <div style=" background-color: #c9d3d8;" class="ui form segment AVAST_PAM_loginform">
                    <div class="field">
                        <h1>Contibution</h1>
                        <label for="contractID" style="margin-left: 10px">Contractor:</label>
                        <select style="margin-left: 10px; border:solid;" name="contractID">
                            <?php

                            //Search for all active contracts for the contractor name
                            $sql = "select awarded,contractID from contracts WHERE status='Active'";
                            $result = mysqli_query($db,$sql);

                            while($row = mysqli_fetch_array($result)){
                                echo "<option style='border: solid;' value='" . $row['contractID'] ."'>". $row['awarded']  . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="field">
                        <label for="price:" style="margin-left: 10px">Price:</label>
                        <div style="margin-left: 10px" class="ui left labeled icon input">
                            <input style=" border: solid;" type="text" name="price" id="price" ">
                            <i class="dollar sign icon"></i>
                        </div>
                    </div>
                    <div class="field">
                        <label for="reason" style="margin-left: 10px">Reason:</label>
                        <div style="width: 676px" class="ui input">
                            <input style=" margin-left: 10px; border: solid; width: 500px" type="text" name="reason">
                        </div>
                    </div>
                    <div align="right">
                        <input style="margin-left:580px;" class="ui positive button" type="submit" name="create_contribution" value="submit">
                    </div>
                </div>
            </div>
        </div>
    </form>
<!--    <form action="edit_contract.php" method="post">-->
<!--        <label for="contractID">Contractor:</label>-->
<!--        <br>-->
<!--        <select name="contractID">-->
<!--            --><?php
//
//            //Search for all active contracts for the contractor name
//            $sql = "select awarded,contractID from contracts WHERE status='Active'";
//            $result = mysqli_query($db,$sql);
//
//            while($row = mysqli_fetch_array($result)){
//                echo "<option value='" . $row['contractID'] ."'>". $row['awarded']  . "</option>";
//            }
//            ?>
<!--        </select>-->
<!--        <br>-->
<!--        <label for="price:">Price:</label>-->
<!--        <br>-->
<!--        <input type="text" name="price" onblur="checkInput(this.value)">-->
<!--        <br>-->
<!--        <label for="reason">Reason:</label>-->
<!--        <br>-->
<!--        <input type="text" name="reason">-->
<!--        <br>-->
<!--        <input type="submit" name="create_contribution" value="submit">-->
<!--    </form>-->
    <br>
    <?php

}
//Form to create a contract
elseif (isset($_POST['ContractButton'])){
    ?>
<div align="right">
    <button style="margin-left:1370px" class="ui blue left labeled icon button" type="submit" name="back" onclick="window.location.href='manage_contract.php';">
        <i class="left arrow icon"></i>
        Back
    </button>
</div>
    <form action="edit_contract.php" method="post" onsubmit="return checkInput(document.getElementById('price').value, 'price');">
        <div style="margin:30px;" class="ui two column middle aligned relaxed grid basic segment">
            <div class="column">
                <div style=" background-color: #c9d3d8;" class="ui form segment AVAST_PAM_loginform">
                    <h1>Contract</h1>
                    <div style="margin-left: 10px" class="field">
                        <label for="awarded">Contractor:</label>
                        <input style=" border: solid; width:667px" type="text" name="awarded">
                    </div>
                    <div class="field">
                        <label style="margin-left: 10px" for="description:">Description:</label>
                        <div style="margin-left: 10px" class="ui left labeled icon input">
                            <input style=" border: solid;" type="text" name="description">
                        </div>
                    </div>
                    <div class="field">
                        <label style="margin-left: 10px" for="Price">Price:</label>
                        <div style="margin-left: 10px" class="ui left labeled icon input">
                            <input style=" border: solid;" type="text" name="price" id="price">
                        </div>
                    </div>
                    <div align="right">
                        <input style="margin-left:580px;" class="ui positive button" type="submit" name="create_contract" value="submit">
                    </div>
                </div>
            </div>
        </div>
    </form>
<!--    <form action="edit_contract.php" method="post">-->
<!--        <label for="awarded">Contractor:</label>-->
<!--        <br>-->
<!--        <input type="text" name="awarded">-->
<!--        <br>-->
<!--        <label for="description:">Description:</label>-->
<!--        <br>-->
<!--        <input type="text" name="description">-->
<!--        <br>-->
<!--        <label for="Price">Price:</label>-->
<!--        <br>-->
<!--        <input type="text" name="price" onblur="checkInput(this.value)">-->
<!--        <br>-->
<!--        <input type="submit" name="create_contract" value="submit">-->
<!--    </form>-->


<?php
}
//Form to create a maintenance
elseif (isset($_POST['MaintenanceButton'])){
    ?>
<div align="right">
    <button style="margin-left:1370px" class="ui blue left labeled icon button" type="submit" name="back" onclick="window.location.href='manage_contract.php';">
        <i class="left arrow icon"></i>
        Back
    </button>
</div>

<form action="edit_contract.php" method="post" onsubmit="return checkInput(document.getElementById('cost').value, 'cost');">
    <div style="margin:30px;" class="ui two column middle aligned relaxed grid basic segment">
        <div class="column">
            <div style=" background-color: #c9d3d8;" class="ui form segment AVAST_PAM_loginform">
                <h1>Maintenance</h1>
                <div style="margin-left: 10px" class="field">
                    <label for="contractID">Contractor:</label>
                    <select style=" border: solid; width:667px;" name="contractID">
                        <?php

                        $sql = "select awarded,contractID from contracts WHERE status='Active'";
                        $result = mysqli_query($db,$sql);

                        while($row = mysqli_fetch_array($result)){
                            echo "<option value='" . $row['contractID'] ."'>". $row['awarded']  . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="field">
                    <label style="margin-left: 10px" for="Price">Price:</label>
                    <div style="margin-left: 10px" class="ui left labeled icon input">
                        <input style=" border: solid;" type="text" name="cost" id="cost">
                        <i class="dollar sign icon"></i>
                    </div>
                </div>
                <div class="field">
                    <label for="reason" style="margin-left: 10px">Rationale:</label>
                    <div style="margin-left: 10px" class="ui left labeled icon input">
                        <input style=" border: solid;" type="text" name="rationale">
                    </div>
                </div>
                <div align="right">
                    <input style="margin-left:580px;" class="ui positive button" type="submit" name="create_maintenance" value="submit">
                </div>
            </div>
        </div>
    </div>
</form>

<!--    <form action="edit_contract.php" method="post">-->
<!--        <label for="contractID">Contractor:</label>-->
<!--        <br>-->
<!--        <select name="contractID">-->
<!--            --><?php
//
//            $sql = "select awarded,contractID from contracts WHERE status='Active'";
//            $result = mysqli_query($db,$sql);
//
//            while($row = mysqli_fetch_array($result)){
//                echo "<option value='" . $row['contractID'] ."'>". $row['awarded']  . "</option>";
//            }
//            ?>
<!--        </select>-->
<!--        <br>-->
<!--        <label for="price:">Cost:</label>-->
<!--        <br>-->
<!--        <input type="text" name="cost">-->
<!--        <br>-->
<!--        <label for="reason">Rationale:</label>-->
<!--        <br>-->
<!--        <input type="text" name="rationale">-->
<!--        <br>-->
<!--        <input type="submit" name="create_maintenance" value="submit">-->
<!--    </form>-->
    <?php
}
?>
</body>
</html>
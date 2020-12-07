<?php
include('config.php'); 
session_start();
?>


<html>
<head>
    <title>Edit Percent Share</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
</head>
<body style="background-color: #d5e2ff;">
<div style = "background-color:#aca3ec; height:100px; color:#4D39D6; padding:3px;"><b><br><i class="huge chess rook icon"></i></b><b align="middle" style="margin-bottom:10px; color:white; font-size:40px;">CON</b></div>
<br>
<br>
<a style="margin:30px; font-size: 40px; color:black;" class="item">
    Edit Percent Share<i class="percent icon"></i>
</a>

<?php

//parse username and building number
$input = explode(",",$_POST['editNum']);
$username = $input[0];
$buildingID = $input[1];
$percentShare = $input[2];

if(isset($_POST['confirm'])) {

    if(empty($_POST['new_percentShare'])) {
        $_SESSION['message'] = "did not update, field was empty";
    }else {
        //update table
        $sql = "UPDATE percentShare SET percentShare=".$_POST['new_percentShare']." WHERE buildingID=$buildingID AND userID=(Select userID FROM Users WHERE name='$username')";
        if(mysqli_query($db,$sql)) $_SESSION['message'] = "record succesfully updated";
        else $_SESSION['message'] = mysqli_error($db);
    }

    //return to condoAssociation.php
    $_SESSION['print_message'] = true;
    
    $URL="condoAssociation.php";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';

} else if(isset($_POST['cancel'])) {

    $URL="condoAssociation.php";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';

}

?>

<div style="margin:30px;" class="ui two column middle aligned relaxed grid basic segment">
    <div class="column">
        <div style=" background-color: #c9d3d8;" class="ui form segment AVAST_PAM_loginform">
            <!--            get and display user name and the building-->
            <div class="field">
                <label style="font-size: 20px;">User:
                    <?php
                        echo "".$username."";
                    ?>
                </label>
            </div>
            <div class="field">
                <label style="font-size: 20px;">Building:
                    <?php
                    echo "".$buildingID."";
                    ?>
                </label>
            </div>
            <form action="edit_percentShare.php" method="post">
                <div class="field">
                    <label for="percentShare">Percent Share:</label>
                    <?php echo '<input type="text" name="new_percentShare" value="'.$percentShare.'">'; ?>
                    <br><br>
                    <?php echo '<input type="hidden" name="editNum" value="'.$_POST['editNum'].'">'; ?>
                </div>

                <input class="ui green button" type="submit" name="confirm" value="confirm">
                <input class="ui black button" type="submit" name="cancel" value="cancel">
            </form>
        </div>
    </div>
</div>



</body>
</html>

<?php
include('config.php'); 
session_start();
?>


<html>

<head>
    <title>Condo Association</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
</head>
<body style="background-color: #d5e2ff;">
<div style = "background-color:#aca3ec; height:100px; color:#4D39D6; padding:3px;"><b><br><i class="huge chess rook icon"></i></b><b align="middle" style="margin-bottom:10px; color:white; font-size:40px;">CON</b></div>
<br><br>
<button style="margin-left:1320px" class="ui blue left labeled icon button" type="submit" name="back" onclick="window.location.href='welcome.php';">
    <i class="left arrow icon"></i>
    Back to Main Page
</button>
<a style="margin:30px; font-size: 40px; color:black;" class="item">
    Condo Association Info<i class="building icon"></i>
</a>
<br><br>
<?php

	//print debug messages if there are any
	if($_SESSION['print_message']) {
		echo $_SESSION['message']."<br><br>";
		$_SESSION['message'] = "";
		$_SESSION['print_message'] = false;		//reset boolean tellin us theres a message to print
	}

	//get current users condo association ID
	$caID = $_SESSION['condoAssociationID'];

	//get and print budget and financial status
	$ca_query = mysqli_query($db,"SELECT budget,financialStatus FROM condoAssociations WHERE condoAssociationID=$caID");
	$ca = mysqli_fetch_array($ca_query);
	echo '<form action="condoAssociation.php" method="post">';
	
	
	//budget field
	if($_SESSION['admin'] == 1) { //give admins option to edit
		if(isset($_POST['edit_budget'])) {	//if we're editing, give admins a confirm button
			echo '	<h2 style="margin-left: 30px"><input type="submit" name="confirm_new_budget" value="confirm">'. "&nbsp;&nbsp;";
		} else { echo '	<h2 style="margin-left: 30px"><input class="ui black button" type="submit" name="edit_budget" value="edit">'. "&nbsp;&nbsp;"; }	//else show edit button
	}
	if(isset($_POST['edit_budget'])) {	//if we're editing, give admins a field
		echo '	<input type="text" name="new_budget" value="'.$ca['budget'].'">'.'</h2><br>';
	} else { echo "budget: " . $ca['budget'] . "$</h2><br>"; }	//else show value
	
	//financial status field
	if($_SESSION['admin'] == 1) {
		if(isset($_POST['edit_financialStatus'])) {	//if we're editing, give admins a confirm button
			echo '	<h2 style="margin-left: 30px"><input type="submit" name="confirm_new_financialStatus" value="confirm">'. "&nbsp;&nbsp;";
		} else { echo '	<h2 style="margin-left: 30px"><input class="ui black button" type="submit" name="edit_financialStatus" value="edit">'. "&nbsp;&nbsp;"; }	//else show edit button
	}
	if(isset($_POST['edit_financialStatus'])) {	//if we're editing, give admins a field
		echo '	<input type="text" name="new_financialStatus" value="'.$ca['financialStatus'].'">'.'</h2><br>';
	} else { echo " financial status: " . $ca['financialStatus'] . "</h2><br>"; }	//else show value
	
	echo "</form>";
	
	//handle admin delete button press
	if(isset($_POST['delete'])) {
		
		//parse username and building number
		$input = explode(",",$_POST['deleteNum']);
		$username = $input[0];
		$buildingID = $input[1];
		//remove from table
		$sql = "DELETE FROM percentShare WHERE buildingID=$buildingID AND percentShare.userID=(Select userID FROM Users WHERE name='$username')";
		if(mysqli_query($db,$sql)) $_SESSION['message'] = "record deleted";
		else $_SESSION['message'] = mysqli_error($db);
		//set session variable saying theres a message to print, then reload page
		$_SESSION['print_message'] = true;
		header("Location: " . $_SERVER['PHP_SELF']);
	
	} else if(isset($_POST['add_record'])) {	//handle create record
	
		//make sure all fields are filled in
		$valid = true;
		if(empty($_POST['username'])) $valid = false;
		else $username = $_POST['username'];
		if(empty($_POST['buildingNum'])) $valid = false;
		else $buildingNum = $_POST['buildingNum'];
		if(empty($_POST['percentShare'])) $valid = false;
		else $percentShare = $_POST['percentShare'];
		
		if($valid) {
			//make sure user exists
			$sql = "select * from Users WHERE name='$username'";
			$result = mysqli_query($db,$sql);
    	$row = mysqli_fetch_array($result);
    	if(mysqli_num_rows($result)==0) {
    		$_SESSION['message'] = "record not added, no user with that name exists";
    		$_SESSION['print_message'] = true;
				header("Location: " . $_SERVER['PHP_SELF']);
    	}
    	
			//make sure building exists
			$sql = "select * from buildings WHERE buildingID=$buildingNum";
			$result = mysqli_query($db,$sql);
    	$row = mysqli_fetch_array($result);
    	if(mysqli_num_rows($result)==0) {
    		$_SESSION['message'] = "record not added, no building with that number exists";
    		$_SESSION['print_message'] = true;
				header("Location: " . $_SERVER['PHP_SELF']);
    	}
		
			//insert into table
			$sql = "select userID from Users WHERE name='$username'";
			$result = mysqli_query($db,$sql);
			$user = mysqli_fetch_array($result);
			$sql = " insert into percentShare (userID,buildingID,percentShare) VALUES (".$user['userID'].",$buildingNum,$percentShare)";
			if(mysqli_query($db,$sql)) { $_SESSION['message'] = "record added"; }
			else { $_SESSION['message'] = mysqli_error($db); }
			
		} else { $_SESSION['message'] = "could not create record, please fill out all fields"; }
	
		$_SESSION['print_message'] = true;
		header("Location: " . $_SERVER['PHP_SELF']);
	
	} else if(isset($_POST['confirm_new_budget'])) {	//handle update budget
		$new_budget = $_POST['new_budget'];	//save new budget in a more convenient varialbe
		
		//update table
		$sql = "UPDATE condoAssociations SET budget=$new_budget WHERE condoAssociationID=$caID";
		if(mysqli_query($db,$sql)) $_SESSION['message'] = "Condo association budget has been updated";	//print confirmation
		else $_SESSION['message'] = mysqli_error($db);	//print dem errors
		
		//display messages and refresh page
		$_SESSION['print_message'] = true;
		header("Location: " . $_SERVER['PHP_SELF']);
		
	} else if(isset($_POST['confirm_new_financialStatus'])) {	//handle update financial status
		$new_fs = $_POST['new_financialStatus'];	//save financial status in a more convenient variable
		
		//update table
		$sql = "UPDATE condoAssociations SET financialStatus='$new_fs' WHERE condoAssociationID=$caID";
		if(mysqli_query($db,$sql)) $_SESSION['message'] = "Condo association financial status has been updated";
		else $_SESSION['message'] = mysqli_error($db);
		
		$_SESSION['print_message'] = true;
		header("Location: " . $_SERVER['PHP_SELF']);
		
	}

	//get all users names in condoassociation with a percent share in any building
	$sql = "SELECT  name as username, buildingID, percentShare FROM Users,percentShare WHERE condoAssociationID=$caID AND percentShare.userID=Users.userID;";
	$user_query = mysqli_query($db,$sql);
	echo mysqli_error($db);
	
	if($_SESSION['admin'] == 1) {
	    ?>


<form action="condoAssociation.php" method="post">
    <div style="margin-left:30px;" class="ui two column middle aligned relaxed grid basic segment">
        <div class="column">
            <div style=" background-color: #c9d3d8;" class="ui form segment AVAST_PAM_loginform">
                <div class="field">
                    <label for="username" style="font-size: 20px;">Username: </label>
                    <div class="ui left labeled icon input">
                            <input style=" border: solid;" type="text" placeholder="Username" name="username" >
                        <i class="user icon"></i>
                    </div>
                </div>
                <div class="field">
                    <label for="BuildingNum">Building Number: </label>
                    <div class="ui left labeled icon input">
                        <input style=" border: solid;" type="text" placeholder="Amount" name="buildingNum" >
                        <i class="building icon"></i>
                    </div>
                </div>
                <div class="field">
                    <label for="percentShare">Percent Share:</label>
                    <div class="ui left labeled icon input">
                        <input style=" border: solid;" type="text" placeholder="Percent Share" name="percentShare" >
                        <i class="percent icon"></i>
                    </div>
                </div>
                <input style="margin-left:625px;" class="ui positive button" type="submit" name="add_record" value="Add">
            </div>
        </div>
    </div>
</form>
<!---->
<!--		echo '<form action="condoAssociation.php" method="post">';-->
<!--    <label for="username">Username:</label>';-->
<!--		echo '	<br>';-->
<!--		echo '	<input type="text" name="username">';-->
<!--		echo '	<br>';-->
<!--    <label for="BuildingNum">Building Number:</label>';-->
<!--		echo '	<br>';-->
<!--		echo '	<input type="text" name="buildingNum">';-->
<!--		echo '	<br>';-->
<!--    <label for="percentShare">Percent Share:</label>';-->
<!--		echo '	<br>';-->
<!--		echo '	<input type="text" name="percentShare">';-->
<!--		echo '	<br><br>';-->
<!--		echo '	<input type="submit" name="add_record" value="add">';-->
<!--		echo '	<br>';-->
<!--		echo '</form>';-->
<!--	}-->

	<?php
    }
	
	//list buildings with users percent share
	$buildingIDs = array();
	$users = array();
	while($user = mysqli_fetch_array($user_query)) {
		//save user objects
		array_push($users, $user);
		//compile list of building numbers
		if(!in_array($user['buildingID'], $buildingIDs))
			array_push($buildingIDs, $user['buildingID']);
	}
	
	foreach($buildingIDs as $b) {
		
		//create a table for each building
		echo "<h1> Building $b </h1>";
		echo "<table class='ui table inverted' style='margin-left: 50px; width:30%;'>";
		echo "<col style='width: 20%'><col style='width:50%px;'><col style='width: 30%;'>";
		if($_SESSION['admin'] == 1) //allow only admins to edit/delete 
			echo "<th></th>";
		echo "<th> Username </th>";
		echo "<th> Percent Share </th></tr>";
		
		foreach($users as $user) {
			if($user['buildingID']==$b) {
				echo "<tr>";
				if($_SESSION['admin'] == 1) { //allow only admins to edit/delete
					echo '<td><form action="edit_percentShare.php" method="post">';
					echo '<input type="hidden" name="editNum" value="'.$user['username'].",".$b.",".$user['percentShare'].'">';
					echo '<input class="ui button" type="submit" name="edit" value="edit">';
					echo '</form>';
					echo '<form action="condoAssociation.php" method="post">';
					echo '<input type="hidden" name="deleteNum" value="'.$user['username'].",".$b.'">';
					echo '<input class="ui red button" type="submit" name="delete" value="delete">';
					echo '</form></td>';
				}
				echo "<td align='center'>".$user['username']."</td>";
				echo "<td>".$user['percentShare']."</td>";
				echo "</tr>";
			}
		}
		
		echo "</table><br>";
	
	}

?>






</body>
</html>

<?php
include('config.php'); 
session_start();
?>

<html>

<head>
    <title>Manage Condos </title>
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
<a style="margin-left:30px; font-size: 40px; color:black;" class="item">
    Manage Condos<i class="wrench icon"></i>
</a>

<table style="width: 100%;">
    <col style="width: 33%;">
    <col style="width: 34%;">
    <col style="width: 33%;"
    <tr style="border:solid;">
        <td>
            <form style="width: 100%;" action="manage_condos.php" method="post">
                <div style="margin:30px;" class="ui two column middle aligned relaxed grid basic segment">
                    <div class="column" style="width: 100%;">
                        <div style=" background-color: #c9d3d8; width: 100%;" class="ui form segment AVAST_PAM_loginform">
                            <div class="field">
                                <h2> Add Building </h2>
                                <label for="building_address">Address:</label>
                                <div class="ui left labeled icon input">
                                    <input style=" border: solid;" type="text" placeholder="Address" name="building_address" >
                                    <i class="building icon"></i>
                                </div>
                            </div>
                            <input class="ui positive button" type="submit" name="add_building" value="confirm">
                        </div>
                    </div>
                </div>
            </form>
        </td>
        <td>
            <form style="width: 100%;" action="manage_condos.php" method="post">
                <div style="margin:30px;" class="ui two column middle aligned relaxed grid basic segment">
                    <div class="column" style="width: 100%;">
                        <div style=" background-color: #c9d3d8; width: 100%;" class="ui form segment AVAST_PAM_loginform">
                            <div class="field">
                                <h2> Add Condo </h2>
                                <label for="floor_space">Floor Space in ft<sup>2</sup>:</label>
                                <div class="ui left labeled icon input">
                                    <input style=" border: solid;" type="text" placeholder="Floor Space" name="floor_space" >
                                    <i class="crop icon"></i>
                                </div>
                            </div>
                            <div class="field">
                                <h2> Add Condo </h2>
                                <label for="building_number">Building Number:</label>
                                <div class="ui left labeled icon input">
                                    <input style=" border: solid;" type="text" placeholder="Building Number" name="building_number" >
                                    <i class="building outline icon"></i>
                                </div>
                            </div>
                            <input class="ui positive button" type="submit" name="add_condo" value="confirm">
                        </div>
                    </div>
                </div>
            </form>
        </td>
        <td>
            <form style="width: 100%;" action="manage_condos.php" method="post">
                <div style="margin:30px;" class="ui two column middle aligned relaxed grid basic segment">
                    <div class="column" style="width: 100%;">
                        <div style=" background-color: #c9d3d8; width: 100%;" class="ui form segment AVAST_PAM_loginform">
                            <div class="field">
                                <h2> Add Parking Space </h2>
                                <label for="condo_number">Condo Number:</label>
                                <div class="ui left labeled icon input">
                                    <input style=" border: solid;" type="text" placeholder="Address" name="condo_number" >
                                    <i class="building outline icon"></i>
                                </div>
                            </div>
                            <input class="ui positive button" type="submit" name="add_parking_space" value="confirm">
                        </div>
                    </div>
                </div>
            </form>
        </td>
    </tr>
</table>
<?php

	//print debug messages if there are any
	if($_SESSION['print_message']) {
			echo $_SESSION['message']."<br><br>";
			$_SESSION['print_message'] = false;		//reset boolean tellin us theres a message to print
	}
	
	if(isset($_POST['add_building'])) { //handle add building button
	
		//validate fields are not empty
		if($_POST['building_address']!='') {
			$address = $_POST['building_address'];
			//insert row into database
			$sql = "INSERT INTO buildings (address) VALUES ('$address');";
			if(mysqli_query($db, $sql)) $_SESSION['message'] = "new building added";
			else $_SESSION['message'] = mysqli_error($db);
		} else $_SESSION['message'] = "building was not added, please enter an address";
		
		//set session variable saying theres a message to print, then reload page
		$_SESSION['print_message'] = true;
		header("Location: " . $_SERVER['PHP_SELF']);
	
	} else if(isset($_POST['add_condo'])) { //handle add condo button
		
		//validate fields are not empty
		if($_POST['floor_space']!='' && $_POST['building_number']!='') {
			$floorSpace = $_POST['floor_space'];
			$buildingID = $_POST['building_number'];
			//insert row into database
			$sql = "INSERT INTO condos (buildingID, floorspace) VALUES ($buildingID, $floorSpace);";
			if(mysqli_query($db, $sql)) $_SESSION['message'] = "new Condo added";
			else $_SESSION['message'] = mysqli_error($db);
		} else $_SESSION['message'] = "condo was not added, please fill out all fields";
		
		//set session variable saying theres a message to print, then reload page
		$_SESSION['print_message'] = true;
		header("Location: " . $_SERVER['PHP_SELF']);
	
	} else if(isset($_POST['add_parking_space'])) {	//handle add parking space button
		
		//validate that fields are not empty
		if($_POST['condo_number']!='') {
			$condoID = $_POST['condo_number'];
			//insert row into database
			$sql = "INSERT INTO parkingSpaces (condoID) VALUES ($condoID);";
			if(mysqli_query($db, $sql)) $_SESSION['message'] ="parking space added";
			else $_SESSION['message'] = mysqli_error($db);
		} else $_SESSION['message'] = "parking space was not added, please enter an assigned condo";
		
		//set session variable saying theres a message to print, then reload page
		$_SESSION['print_message'] = true;
		header("Location: " . $_SERVER['PHP_SELF']);
	
	} else if(isset($_POST['delete_building'])) { //handle delete building button press
	
		$deleteNum = $_POST['deleteNum'];
		//remove row from table
		$sql="DELETE FROM buildings WHERE buildingID=$deleteNum";
		if(mysqli_query($db, $sql)) $_SESSION['message'] = "building removed";
		else $_SESSION['message'] = mysqli_error($db);
	
		//set session variable saying theres a message to print, then reload page
		$_SESSION['print_message'] = true;
		header("Location: " . $_SERVER['PHP_SELF']);
	
	} else if(isset($_POST['delete_condo'])) {	//handle delete condo button press
	
		$deleteNum = $_POST['deleteNum'];
		//remove row from table
		$sql="DELETE FROM condos WHERE condoID=$deleteNum";
		if(mysqli_query($db, $sql)) $_SESSION['message'] = "condo removed";
		else $_SESSION['message'] = mysqli_error($db);
		
		//set session variable saying theres a message to print, then reload page
		$_SESSION['print_message'] = true;
		header("Location: " . $_SERVER['PHP_SELF']);
	
	} else if(isset($_POST['delete_parking'])) {	//handle delete parking button press
	
		$deleteNum = $_POST['deleteNum'];
		//remove row from table
		$sql="DELETE FROM parkingSpaces WHERE parkingSpaceID=$deleteNum";
		if(mysqli_query($db, $sql)) $_SESSION['message'] = "parking space removed";
		else $_SESSION['message'] = mysqli_error($db);
		
		//set session variable saying theres a message to print, then reload page
		$_SESSION['print_message'] = true;
		header("Location: " . $_SERVER['PHP_SELF']);
	
	}
	
	//set session variable determining which table is shown
	if(!isset($_SESSION['table'])) {	//if null, initialize to none
		$_SESSION['table'] = "none";
	} else if(isset($_POST['show_buildings'])) {	//if show buildings button pressed
		$_SESSION['table'] = "buildings";						//show buildings table
	} else if(isset($_POST['show_condos'])) {			//if show condos button pressed
		$_SESSION['table'] = "condos";								//show condos table
	} else if(isset($_POST['show_parking'])) {		//if show parking button pressed
		$_SESSION['table'] = "parking";							//show parking space table
	}
	
?>

<form style="margin-left:170px;" action="manage_condos.php" method="post">
	<input class="ui blue button" type="submit" name="show_buildings" value="list buildings">
	<input style="margin-left:420px;" class="ui blue button" type="submit" name="show_condos" value="list condos">
	<input style="margin-left:420px;" class="ui blue button" type="submit" name="show_parking" value="list parking">
</form>


<?php
//make buildings table visible if sessing variable is buildings
if($_SESSION['table']=="buildings") echo '<table class="ui selectable inverted table">';
else echo '<table class="ui selectable inverted table" style="display:none;">';
?>
    <thead>
    <tr>
        <th></th>
        <th>Building Number</th>
        <th> Address </th>
    </tr>
    </thead>
<?php
  $building_query = mysqli_query($db, "SELECT * FROM buildings");
  while($building = mysqli_fetch_array($building_query)){
  		echo "<tr>";
  		echo '<td><form action="manage_condos.php" method="post">';
  		echo '<input type="hidden" name="deleteNum" value="'.$building['buildingID'].'">';
  		echo '<input class="ui button" type="submit" name="delete_building" value="remove">';
  		echo "</form></td>";
      echo "<td>".$building['buildingID']."</td>";
      echo "<td>".$building['address']."</td>";
      echo "</tr>";
  }	
?>
</table>

<?php
//make condos table visible if sessing variable is condos
if($_SESSION['table']=="condos") echo '<table class="ui selectable inverted table">';
else echo '<table class="ui selectable inverted table" style="display:none;">';
?>
    <thead>
    <tr>
        <th></th>
        <th>condo Number</th>
        <th> Owner </th>
        <th> Building Number </th>
        <th> Floor Space (ft^2)</th>
    </tr>
    </thead>
<?php
  $condo_query = mysqli_query($db, " SELECT condoID,name as owner,buildingID,floorspace FROM condos,Users WHERE ownerID=userID UNION select * FROM condos WHERE ownerID IS NULL;
");
  while($condo = mysqli_fetch_array($condo_query)){
  		echo "<tr>";
  		echo '<td><form action="manage_condos.php" method="post">';
  		echo '<input type="hidden" name="deleteNum" value="'.$condo['condoID'].'">';
  		echo '<input class="ui red button" type="submit" name="delete_condo" value="remove">';		//delete button for condos
  		echo "</form>";
  		echo '<form action="assign_condo_owner.php" method="post">';	//goto assign_condo_owner.php on 'set owner' button press
  		echo '<input type="hidden" name="condoNum" value="'.$condo['condoID'].'">';
  		echo '<input class="ui green button" type="submit" name="assign_condo" value="Set Owner">';	//button for setting new condo owner
  		echo "</form></td>";
      echo "<td>".$condo['condoID']."</td>";
      if(empty($condo['owner'])) echo "<td>-</td>";		//display empty line if no owner
      else echo "<td>".$condo['owner']."</td>";				//else display owner
      echo "<td>".$condo['buildingID']."</td>";
      echo "<td>".$condo['floorspace']."</td>";
      echo "</tr>";
  }	
?>
</table>



<?php
//make parking spaces table visible if sessing variable is parking
if($_SESSION['table']=="parking") echo '<table class="ui selectable inverted table">';
else echo '<table class="ui selectable inverted table" style="display:none;">';
?>
    <thead>
    <tr>
        <th></th>
        <th> Parking Spot Number </th>
        <th> Assigned Condo Number </th>
    </tr>
    </thead>
<?php
  $parking_query = mysqli_query($db, "SELECT * FROM parkingSpaces");
  while($parking = mysqli_fetch_array($parking_query)){
  		echo "<tr>";
  		echo '<td><form action="manage_condos.php" method="post">';
  		echo '<input type="hidden" name="deleteNum" value="'.$building['buildingID'].'">';
  		echo '<input class="ui red button" type="submit" name="delete_parking" value="remove">';		//delete button for parking spaces
  		echo "</form></td>";
      echo "<td>".$parking['parkingSpaceID']."</td>";
      echo "<td>".$parking['condoID']."</td>";
      echo "</tr>";
  }	
?>
</table>

</body>
</html>

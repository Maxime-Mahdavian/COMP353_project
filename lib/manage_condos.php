<?php
include('config.php'); 
session_start();
?>



<html>

<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
<style>
#container {
  display: flex;                  /* establish flex container */
  flex-direction: row;            /* default value; can be omitted */
  flex-wrap: nowrap;              /* default value; can be omitted */
  justify-content: space-between; /* switched from default (flex-start, see below) */
}
#container > div {
  width: 300px;
  height: 300px;
  top: 50%;
  left: 50%;
  right: 50%;
  text-align: center;
}
</style>
</head>


<body style="background-color: #d5e2ff;">
<br>
<br>
	
	
<div id="container">
  <div>
  	<h2> Add Building </h2>
  	<form action="manage_condos.php" method="post">
    	<label for="building_address">address:</label>
			<br>
			<input type="text" name="building_address">
			<br>
			<br>
			<input type="submit" name="add_building" value="confirm">
			<br>
		</form>
	</div>
  <div>
  	<h2> Add Condo </h2>
  	<form action="manage_condos.php" method="post">
    	<label for="floor_space">floor Space (ft^2):</label>
			<br>
			<input type="text" name="floor_space">
			<br>
			<label for="building_number">Building Number:</label>
			<br>
			<input type="text" name="building_number">
			<br>
			<br>
			<input type="submit" name="add_condo" value="confirm">
			<br>
		</form>
	</div>
	<div>
	  <h2> Add Parking Space </h2>
	  <form action="manage_condos.php" method="post">
	   	<label for="condo_number">Assign to Condo Num:</label>
			<br>
			<input type="text" name="condo_number">
			<br>
			<br>
			<input type="submit" name="add_parking_space" value="confirm">
			<br>
		</form>
	</div>
</div>

<?php

	if($_SESSION['print_message']) {
			echo $_SESSION['message']."<br><br>";
			$_SESSION['print_message'] = false;
	}
	
	if(isset($_POST['add_building'])) {
	
		if($_POST['building_address']!='') {
			$address = $_POST['building_address'];
			$sql = "INSERT INTO buildings (address) VALUES ('$address');";
			if(mysqli_query($db, $sql)) $_SESSION['message'] = "new building added";
			else $_SESSION['message'] = mysqli_error($db);
		} else $_SESSION['message'] = "building was not added, please enter an address";
		
		$_SESSION['print_message'] = true;
		header("Location: " . $_SERVER['PHP_SELF']);
	
	} else if(isset($_POST['add_condo'])) {
		
		if($_POST['floor_space']!='' && $_POST['building_number']!='') {
			$floorSpace = $_POST['floor_space'];
			$buildingID = $_POST['building_number'];
			$sql = "INSERT INTO condos (buildingID, floorspace) VALUES ($buildingID, $floorSpace);";
			if(mysqli_query($db, $sql)) $_SESSION['message'] = "new Condo added";
			else $_SESSION['message'] = mysqli_error($db);
		} else $_SESSION['message'] = "condo was not added, please fill out all fields";
		
		$_SESSION['print_message'] = true;
		header("Location: " . $_SERVER['PHP_SELF']);
	
	} else if(isset($_POST['add_parking_space'])) {
		
		if($_POST['condo_number']!='') {
			$condoID = $_POST['condo_number'];
			$sql = "INSERT INTO parkingSpaces (condoID) VALUES ($condoID);";
			if(mysqli_query($db, $sql)) $_SESSION['message'] ="parking space added";
			else $_SESSION['message'] = mysqli_error($db);
		} else $_SESSION['message'] = "parking space was not added, please enter an assigned condo";
		
		$_SESSION['print_message'] = true;
		header("Location: " . $_SERVER['PHP_SELF']);
	
	} else if(isset($_POST['delete_building'])) {
	
		$deleteNum = $_POST['deleteNum'];
		$sql="DELETE FROM buildings WHERE buildingID=$deleteNum";
		if(mysqli_query($db, $sql)) $_SESSION['message'] = "building removed";
		else $_SESSION['message'] = mysqli_error($db);
	
		$_SESSION['print_message'] = true;
	
	} else if(isset($_POST['delete_condo'])) {
	
		$deleteNum = $_POST['deleteNum'];
		$sql="DELETE FROM condos WHERE condoID=$deleteNum";
		if(mysqli_query($db, $sql)) $_SESSION['message'] = "condo removed";
		else $_SESSION['message'] = mysqli_error($db);
	
		$_SESSION['print_message'] = true;
	
	} else if(isset($_POST['delete_parking'])) {
	
		$deleteNum = $_POST['deleteNum'];
		$sql="DELETE FROM parkingSpaces WHERE parkingSpaceID=$deleteNum";
		if(mysqli_query($db, $sql)) $_SESSION['message'] = "parking space removed";
		else $_SESSION['message'] = mysqli_error($db);
	
		$_SESSION['print_message'] = true;
	
	}
	
	if(!isset($_SESSION['table'])) {
		$_SESSION['table'] = "none";
	} else if(isset($_POST['show_buildings'])) {
		$_SESSION['table'] = "buildings";
	} else if(isset($_POST['show_condos'])) {
		$_SESSION['table'] = condos;
	} else if(isset($_POST['show_parking'])) {
		$_SESSION['table'] = "parking";
	}
	
?>

<form action="../admin_page.html" method="post">
	<input type="submit" name="back" value="back">
</form>

<br>

<form action="manage_condos.php" method="post">
	<input type="submit" name="show_buildings" value="list buildings">
	<input type="submit" name="show_condos" value="list condos">
	<input type="submit" name="show_parking" value="list parking">
</form>


<?php
if($_SESSION['table']=="buildings") echo '<table class="ui selectable inverted table">';
else echo '<table class="ui selectable inverted table" style="display:none;">';
?>
    <thead>
    <tr>
        <th></th>
        <th>Building Number</th>
        <th> Address </th>
		</tr>
<?php
  $building_query = mysqli_query($db, "SELECT * FROM buildings");
  while($building = mysqli_fetch_array($building_query)){
  		echo "<tr>";
  		echo '<td><form action="manage_condos.php" method="post">';
  		echo '<input type="hidden" name="deleteNum" value="'.$building['buildingID'].'">';
  		echo '<input type="hidden" name="show_buildings">';
  		echo '<input type="submit" name="delete_building" value="remove">';
  		echo "</form></td>";
      echo "<td>".$building['buildingID']."</td>";
      echo "<td>".$building['address']."</td>";
      echo "</tr>";
  }	
?>
</table>

<?php
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
<?php
  $condo_query = mysqli_query($db, " SELECT condoID,name as owner,buildingID,floorspace FROM condos,Users WHERE ownerID=userID UNION select * FROM condos WHERE ownerID IS NULL;
");
  while($condo = mysqli_fetch_array($condo_query)){
  		echo "<tr>";
  		echo '<td><form action="manage_condos.php" method="post">';
  		echo '<input type="hidden" name="deleteNum" value="'.$condo['condoID'].'">';
  		echo '<input type="hidden" name="show_condos">';
  		echo '<input type="submit" name="delete_condo" value="remove">';
  		echo "</form>";
  		echo '<form action="assign_condo_owner.php" method="post">';
  		echo '<input type="hidden" name="condoNum" value="'.$condo['condoID'].'">';
  		echo '<input type="submit" name="assign_condo" value="Set Owner">';
  		echo "</form></td>";
      echo "<td>".$condo['condoID']."</td>";
      if(empty($condo['owner'])) echo "<td>-</td>";
      else echo "<td>".$condo['owner']."</td>";
      echo "<td>".$condo['buildingID']."</td>";
      echo "<td>".$condo['floorspace']."</td>";
      echo "</tr>";
  }	
?>
</table>



<?php
if($_SESSION['table']=="parking") echo '<table class="ui selectable inverted table">';
else echo '<table class="ui selectable inverted table" style="display:none;">';
?>
    <thead>
    <tr>
        <th></th>
        <th> Parking Spot Number </th>
        <th> Assigned Condo Number </th>
<?php
  $parking_query = mysqli_query($db, "SELECT * FROM parkingSpaces");
  while($parking = mysqli_fetch_array($parking_query)){
  		echo "<tr>";
  		echo '<td><form action="manage_condos.php" method="post">';
  		echo '<input type="hidden" name="deleteNum" value="'.$building['buildingID'].'">';
  		echo '<input type="hidden" name="show_parking">';
  		echo '<input type="submit" name="delete_parking" value="remove">';
  		echo "</form></td>";
      echo "<td>".$parking['parkingSpaceID']."</td>";
      echo "<td>".$parking['condoID']."</td>";
      echo "</tr>";
  }	
?>
</table>

</body>
</html>

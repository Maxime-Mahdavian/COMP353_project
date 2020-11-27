<?php
include('config.php'); 
session_start();
?>


<html>

<head>
<style>

table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}

th, td {
  padding: 5px;
}

th {
  text-align: left;
}

</style>
</head>


<body>

Edit Group
<br>
<br>

<?php
	$groupToEdit = $_POST['groupID'];
	
	if(isset($_POST['kick'])) {
		
		$sql = "DELETE FROM group_membership WHERE gID=$groupToEdit AND uID=". $_POST['selectedUserID'];
    $result = mysqli_query($db,$sql);
    if($result) echo "User has been deleted<br><br>";
    else echo mysqli_error($db)."<br>";
		
	} else if(isset($_POST['set_owner'])) {
		
		$sql = "UPDATE groups SET owner=".$_POST['selectedUserID']." WHERE groupID=$groupToEdit";
    $result = mysqli_query($db, $sql);
		if($result) echo "A new owner has been set<br><br>";
    else echo mysqli_error($db)."<br><br>";
		
	}
	
	$group_query = mysqli_query($db, "SELECT groups.name, Users.name as owner_name FROM groups,Users WHERE groups.owner=Users.userID AND groups.groupID=$groupToEdit;");
	$group = mysqli_fetch_array($group_query);
	echo "group:	".$group['name']."<br>";
	echo "owner:	".$group['owner_name']."<br>";
	
?>

<br>
<form action="manage_groups.php" method="post">
		<?php echo'<input type="hidden" name="groupToDelete" value="'.$groupToEdit.'">'; ?>
		<input type="submit" name="back" value="back">
		<input type="submit" name="delete_group" value="delete group">
</form>
<br>

<table>
	<tr>
		<th></th>
		<th> members </th>
	</tr>
	
<?php

	

	//get members of group
  $sql = "SELECT Users.name, Users.userID FROM group_membership,Users WHERE group_membership.gID=$groupToEdit AND group_membership.uID=Users.userID;";
  $user_query = mysqli_query($db, $sql);
  echo mysqli_error($db)."<br>";
	
  while($user = mysqli_fetch_array($user_query)){
  		echo "<tr>";
  		echo '<td><form action="edit_group.php" method="post">';
  		echo '<input type="hidden" id="selectedUserID" name="selectedUserID" value="'.$user['userID'].'">';
  		echo '<input type="hidden" id="groupID" name="groupID" value="'.$groupToEdit.'">';
  		echo '<input type="submit" name="kick" value="kick">';
  		echo '<input type="submit" name="set_owner" value="set owner">';
  		echo "</form></td>";
      echo "<td>".$user['name']."</td>";
      echo "</tr>";
  }
	
?>
</table>


</body>
</html>

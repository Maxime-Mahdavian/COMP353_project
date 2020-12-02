<?php
//INIT
include('config.php'); 
session_start();
?>


<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
</head>


<body style="background-color: #d5e2ff;">
<div style = "background-color:#aca3ec; height:100px; color:#4D39D6; padding:3px;"><b><br><i class="huge chess rook icon"></i></b><b align="middle" style="margin-bottom:10px; color:white; font-size:40px;">CON</b></div>
    <br>
    <br>
    <a style="margin:30px; font-size: 40px; color:black;" class="item">
        Edit Group<i class="users icon"></i>
    </a>

    <?php
    		//save group ID to a variable
        $groupToEdit = $_POST['groupID'];

        if(isset($_POST['kick'])) {	//handle kick user buttons

          $sql = "DELETE FROM group_membership WHERE gID=$groupToEdit AND uID=". $_POST['selectedUserID'];
        	$result = mysqli_query($db,$sql);
        	if($result) echo "User has been deleted<br><br>";
        	else echo mysqli_error($db)."<br>";

        } else if(isset($_POST['set_owner'])) { //handle set owner buttons

            $sql = "UPDATE groups SET owner=".$_POST['selectedUserID']." WHERE groupID=$groupToEdit";
        		$result = mysqli_query($db, $sql);
            if($result) echo "A new owner has been set<br><br>";
        		else echo mysqli_error($db)."<br><br>";

        }

				//get and display group name and owner name
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



      //get every user in group from database and display their names in tabular format
      $sql = "SELECT Users.name, Users.userID FROM group_membership,Users WHERE group_membership.gID=$groupToEdit AND group_membership.uID=Users.userID;";
      $user_query = mysqli_query($db, $sql);
      echo mysqli_error($db)."<br>";

      while($user = mysqli_fetch_array($user_query)){		//iterate through group members
            echo "<tr>";
            echo '<td><form action="edit_group.php" method="post">';
            echo '<input type="hidden" id="selectedUserID" name="selectedUserID" value="'.$user['userID'].'">';	//post id of selected user
            echo '<input type="hidden" id="groupID" name="groupID" value="'.$groupToEdit.'">';		//re-post group 
            echo '<input type="submit" name="kick" value="kick">';						//kick button
            echo '<input type="submit" name="set_owner" value="set owner">';	//set owner button
            echo "</form></td>";
          echo "<td>".$user['name']."</td>";
          echo "</tr>";
      }

    ?>
    </table>
</body>
</html>

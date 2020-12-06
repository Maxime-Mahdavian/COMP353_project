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
<br><br>
<button style="margin-left:1370px" class="ui blue left labeled icon button" type="submit" name="back" onclick="window.location.href='manage_groups.php';">
    <i class="left arrow icon"></i>
    Back
</button>
<a style="margin:30px; font-size: 40px; color:black;" class="item">
    Edit Group <i class="users icon"></i>
</a>
<br>
    <?php
    		//save group ID to a variable
        $groupToEdit = $_POST['groupID'];

        if(isset($_POST['kick'])) {	//handle kick user buttons

          $sql = "DELETE FROM group_membership WHERE gID=$groupToEdit AND uID=". $_POST['selectedUserID'];
        	$result = mysqli_query($db,$sql);
        	if($result) echo "<p style='margin-left:30px; color:green;'>User has been deleted</p><br><br>";
        	else echo mysqli_error($db)."<br>";

        } else if(isset($_POST['set_owner'])) { //handle set owner buttons

            $sql = "UPDATE `groups` SET owner=".$_POST['selectedUserID']." WHERE groupID=$groupToEdit";
        		$result = mysqli_query($db, $sql);
            if($result) echo "<p style='margin-left:30px; color:green;'>A new owner has been set</p><br><br>";
        		else echo mysqli_error($db)."<br><br>";

        }
    ?>
<div style="margin:30px;" class="ui two column middle aligned relaxed grid basic segment">
    <div class="column">
        <div style=" background-color: #c9d3d8;" class="ui form segment AVAST_PAM_loginform">
<!--            get and display group name and owner name-->
            <div class="field">
                <label style="font-size: 20px;">Group: <?php
                    $group_query = mysqli_query($db, "SELECT `groups`.name FROM `groups`,Users WHERE `groups`.owner=Users.userID AND `groups`.groupID=$groupToEdit;");
                    $group = mysqli_fetch_array($group_query);
                    echo ' '.$group['name'].'';
                    ?>
                </label>
            </div>
            <div class="field">
                <div class="field">
                    <label style="font-size: 20px;">Owner: <?php
                    $group_query = mysqli_query($db, "SELECT Users.name as owner_name FROM `groups`,Users WHERE `groups`.owner=Users.userID AND `groups`.groupID=$groupToEdit;");
                    $group = mysqli_fetch_array($group_query);
                    echo ' '.$group['owner_name'].'';
                ?>
                    </label>
                </div>
            </div>
            <form action="manage_groups.php" method="post">
                <?php echo'<input type="hidden" name="groupToDelete" value="'.$groupToEdit.'">'; ?>
                <input class="ui red button" type="submit" name="delete_group" value="Delete group">
            </form>
        </div>
    </div>
</div>

    <table style="margin-left: 50px; width:30%" class="ui inverted table">
        <col style="width:50%">
        <col style="width:50%">
        <tr>
            <th align="center"> Action </th>
            <th> Members </th>
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
            echo '<input class="ui red button" type="submit" name="kick" value="Kick">';						//kick button
            echo '<input class="ui green button" type="submit" name="set_owner" value="Set owner">';	//set owner button
            echo "</form></td>";
          echo "<td>".$user['name']."</td>";
          echo "</tr>";
      }

    ?>
    </table>
</body>
</html>

<?php
include('session.php');
?>
<html">

<head>
    <title>Welcome </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
</head>

<body style="background-color: #d5e2ff;">
<div style = "background-color:#aca3ec; height:100px; color:#4D39D6; padding:3px;"><b><br><i class="huge chess rook icon"></i></b><b align="middle" style="margin-bottom:10px; color:white; font-size:40px;">CON</b></div>
    <br><br>
    <a align="center" style="margin:570px; font-size: 40px; font-weight: bolder; color:black;" class="item">
          Welcome <?php echo $_SESSION['username']; ?>  <i class="big green user circle icon"></i>
    </a>
    <br><br>

    <div class="ui grid">
        <div class="four wide column">
            <button style="margin:30px; width:300px;" class="ui huge blue left labeled icon button" type="submit" name="profile" onclick="window.location.href='profile.php';">
                <i class="user icon"></i>
                My Profile
            </button>
        </div>
        <div class="four wide column">
            <button style="margin:30px; width:300px;" class="ui huge blue left labeled icon button" type="submit" name="post" onclick="window.location.href='message.php';">
                <i class="envelope icon"></i>
                Message
            </button>
        </div>
        <div class="four wide column">
            <button style="margin:30px; width:300px;" class="ui huge blue left labeled icon button" type="submit" name="post" onclick="window.location.href='post.php';">
                <i class="bullhorn icon"></i>
                Post
            </button>
        </div>
        <div class="four wide column">
            <button style="margin:30px; width:300px;" class="ui huge blue left labeled icon button" type="submit" name="viewPosts" onclick="window.location.href='view_post.php';">
                <i class="globe icon"></i>
                View Posts
            </button>
        </div>
        <div class="four wide column">
            <button style="margin:30px; width:300px;" class="ui huge blue left labeled icon button" type="submit" name="viewGroups" onclick="window.location.href='group.php';">
                <i class="users icon"></i>
                Groups
            </button>
        </div>
        <div class="four wide column">
            <button style="margin:30px; width:300px;" class="ui huge blue left labeled icon button" type="submit" name="meetings" onclick="window.location.href='meeting.php';">
                <i class="calendar alternate outline icon"></i>
                Meetings
            </button>
        </div>
        <div class="four wide column">
            <button style="margin:30px; width:300px;" class="ui huge blue left labeled icon button" type="submit" name="pollList" onclick="window.location.href='poll_list.php';">
                <i class="archive icon"></i>
                Poll List
            </button>
        </div>
        <div class="four wide column">
            <button style="margin:30px; width:300px;" class="ui huge blue left labeled icon button" type="submit" name="contracts" onclick="window.location.href='contracts.php';">
                <i class="file alternate icon"></i>
                Contracts
            </button>
        </div>
        <div class="four wide column">
    			<button style="margin:30px; width:300px;" class="ui huge blue left labeled icon button" type="submit" name="pay_fee" onclick="window.location.href='pay_fee.php';">
        		<i class="file alternate icon"></i>
        		Pay Fee
    			</button>
        </div>
        <div class="four wide column">
    			<button style="margin:30px; width:300px;" class="ui huge blue left labeled icon button" type="submit" name="Association" onclick="window.location.href='condoAssociation.php';">
        		<i class="file alternate icon"></i>
        		Condo Association
    			</button>
        </div>
        <div class="four wide column">
            <?php if($_SESSION['admin'] == 1){echo "<a style='margin:30px; width:300px;' class='ui huge blue left labeled icon button' href='../admin_page.html'>
                <i class='wrench icon'></i>
                Admin Options
            </a>";} ?>
            <!--            --><?php //if($_SESSION['admin'] == 1){echo "<a href = '../admin_page.html'>Admin options</a>";} else{echo "no";}?>
        </div>
        <div class="four wide column">
        </div>
        <div class="four wide column">
        	<button style="margin:30px;" class="ui huge blue left labeled icon button" type="submit" name="signout" onclick="window.location.href='logout.php';">
        		<i class="sign out alternate icon"></i>
        		Logout
            </button>
        </div>
    </div>
    

<!--    <h2><a href="profile.php">My Profile</a></h2>-->
<!--    <h2><a href = "poll_list.php">poll</a></h2>-->
<!--    <h2><a href = "post.php">post</a></h2>-->
<!--    <h2><a href = "view_post.php">view post</a></h2>-->
<!--    <h2><a href="group.php">View groups</a></h2>-->
<!--    <h2><a href="meeting.php">Meetings</a></h2>-->
<!--    <h2><a href="message.php">Message</a></h2>-->
<!--    <h2><a href="contracts.php">Contracts</a></h2>-->
<!--    <h2><a href = "logout.php">Sign Out</a></h2>-->
</body>

</html>

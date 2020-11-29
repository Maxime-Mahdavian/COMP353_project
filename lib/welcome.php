<?php
include('session.php');
?>
<html">

<head>
    <title>Welcome </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
</head>

<body >
<div style = "background-color:#aca3ec; height:100px; color:#4D39D6; padding:3px;"><b><br><i class="huge chess rook icon"></i></b></div>

<div align="center">
    <h1 align="center" style="color:purple;">Welcome <?php echo $_SESSION['username']; ?>
</div>

<h1>Are you an admin: <?php if($_SESSION['admin'] == 1){echo "<a href = '../admin_page.html'>Admin options</a>";} else{echo "no";}?></h1>
<h2><a href="profile.php">My Profile</a></h2>
<h2><a href = "poll_list.php">poll</a></h2>
<h2><a href = "post.php">post</a></h2>
<h2><a href = "view_post.php">view post</a></h2>
<h2><a href="group.php">View groups</a></h2>
<h2><a href="meeting.php">Meetings</a></h2>
<h2><a href="message.php">Message</a></h2>
<h2><a href = "logout.php">Sign Out</a></h2>

</body>

</html>

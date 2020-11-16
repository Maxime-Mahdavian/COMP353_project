<?php
include('session.php');
?>
<html">

<head>
    <title>Welcome </title>
</head>

<body>
<h1>Welcome <?php echo $_SESSION['username']; ?></h1>
<h1>Are you an admin: <?php if($_SESSION['admin'] == 1){echo "<a href = '../admin_page.html'>Admin options</a>";} else{echo "no";}?></h1>
<h2><a href = "../poll.html">poll</a></h2>
<h2><a href = "logout.php">Sign Out</a></h2>
<h2><a href = "post.php">post</a></h2>
<h2><a href = "view_post.php">view post</a></h2>
<h2><a href="group.php">View groups</a></h2>

</body>

</html>
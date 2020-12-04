<?php
include ("lib/config.php");
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Poll Demo Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <script src="poll.js"></script>
</head>
<body>
<header id="page-head">
    Poll Demo Page
</header>
<div id="page-body">


    <!-- [THE POLL DOCKET] -->
    <!-- CHANGE THE POLL ID BELOW TO SET YOUR DESIRED QUESTION -->
    <input type="hidden" id="poll_id" value="<?php echo $_POST['poll_id'];?>"/>
    <div id="container"></div>
</div>
<footer id="page-foot">
    &copy; Copyright My Site. All rights reserved.
</footer>
</body>
</html>
<?php
include ("lib/config.php");
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Poll Vote</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <script src="poll.js"></script>
</head>
<body style="background-color: #d5e2ff;">
<div style = "background-color:#aca3ec; height:100px; color:#4D39D6; padding:3px;"><b><br><i class="huge chess rook icon"></i></b><b align="middle" style="margin-bottom:10px; color:white; font-size:40px;">CON</b></div>
<br><br>
<button style="margin-left:1370px" class="ui blue left labeled icon button" type="submit" name="back" onclick="window.location.href='lib/poll_list.php';">
    <i class="left arrow icon"></i>
    Back
</button>
<a style="margin:30px; font-size: 40px; color:black;" class="item">
    Poll Vote<i class="archive icon"></i>
</a>


<!--    [THE POLL DOCKET] -->
<!--    CHANGE THE POLL ID BELOW TO SET YOUR DESIRED QUESTION -->
<div style="margin:30px;" class="ui two column middle aligned relaxed grid basic segment">
    <div class="column">
        <div style=" background-color: #c9d3d8; width:60%;" class="ui form segment AVAST_PAM_loginform">
            <div class="field">
                <header id="page-head"></header>
            </div>
            <div class="field">
                <input type="hidden" id="poll_id" value="<?php echo $_POST['poll_id'];?>"/>
                <div id="container"></div>
            </div>
    </div>
</div>
<!---->
<!--<div id="page-body">-->
<!---->
<!---->
<!--    <input type="hidden" id="poll_id" value="--><?php //echo $_POST['poll_id'];?><!--"/>-->
<!--    <div id="container"></div>-->
<!--</div>-->
    <br><br>
<!--<div style="margin-left: 30px;" id="page-foot">-->
<!--    &copy; Copyright My Site. All rights reserved.-->
<!--</div>-->
</body>
</html>
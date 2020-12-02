<?php
//INIT -- Here we don't need a connection to the db, so we're not including the file
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Message</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <style>
        ul{
            background-color:#eee;
            cursor:pointer;
        }
        li{
            padding:12px;
        }
    </style>
    <link href="../theme.css" rel="stylesheet">
</head>
<body>

<h1>Create Message</h1>
<br /><br />
<?php
//Display the form to create a message, the sender field is readonly, since we don't want a user to be able to send a message from someone else
if(isset($_POST['create_message'])){
?>
<form action="add_message.php" method="post" id="form">
    <label>From:</label>
    <input type="text" value="<?php echo $_POST['username']?>" name="sender" readonly><br>
    <label>To:</label>
    <input type="text" name="receiver" id="receiver" placeholder="Enter Name" /><br>
    <div id="personList"></div>
    Body: <textarea form="form" type="text" name="body" class="bodyclass"></textarea><br>
    <input type="submit" name="create_message" value="Send">
</form>
<?php
}
//The form needs to change a little bit if it is a reply.
//Now the sender and receiver are both known
elseif(isset($_POST['replyButton'])){
    //We need to format the reply message a little bit to include previous messages
    $msg = "\n\n\n\n------------------------------------\n". $_POST['receiver'] . ":\n" .$_POST['body'] . "\n";
?>
<form action="add_message.php" method="post" id="form">
    <label>From:</label>
    <input type="text" value="<?php echo $_SESSION['username']?>" name="sender" readonly><br>
    <label>To:</label>
    <input type="text" name="receiver" id="receiver" value="<?php echo $_POST['receiver'];?>" readonly/><br>
    <div id="personList"></div>
    Body: <textarea form="form" type="text" name="body" class="bodyclass" ><?php echo $msg; ?></textarea><br>
    <input type="submit" name="reply" value="Send">
</form>
<?php
}
?>


</body>
</html>

<!--This is a part of script to have suggestions on the name for the receiver, the second part is in search_name.php-->
<script>
    $(document).ready(function(){
        $('#receiver').keyup(function(){
            var query = $(this).val();
            if(query != '')
            {
                $.ajax({
                    url:"search_name.php",
                    method:"POST",
                    data:{query:query},
                    success:function(data)
                    {
                        $('#personList').fadeIn();
                        $('#personList').html(data);
                    }
                });
            }
        });
        $(document).on('click', 'li', function(){
            $('#receiver').val($(this).text());
            $('#personList').fadeOut();
        });
    });
</script>
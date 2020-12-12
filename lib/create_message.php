<?php
//INIT -- Here we don't need a connection to the db, so we're not including the file
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>New Message</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>
<body style="background-color: #d5e2ff;">
<div style = "background-color:#aca3ec; height:100px; color:#4D39D6; padding:3px;"><b><br><i class="huge chess rook icon"></i></b><b align="middle" style="margin-bottom:10px; color:white; font-size:40px;">CON</b></div>
<br><br>
<div align="right">
    <button style="margin-left:1370px" class="ui blue left labeled icon button" type="submit" name="back" onclick="window.location.href='message.php';">
        <i class="left arrow icon"></i>
        Back
    </button>
</div>
<div>
    <a style="margin-left:30px; font-size: 40px; color:black;" class="item">
        Create Message <i class="paper plane icon"></i>
    </a>
</div>
<br /><br />
<?php
//Display the form to create a message, the sender field is readonly, since we don't want a user to be able to send a message from someone else
if(isset($_POST['create_message'])){
?>
    <form action="add_message.php" method="post" id="form">
        <div style="margin:30px;" class="ui two column middle aligned relaxed grid basic segment">
            <div class="column">
                <div style=" background-color: #c9d3d8;" class="ui form segment AVAST_PAM_loginform">
                    <div class="field">
                        <label>From:</label>
                        <div class="ui left labeled icon input">
                            <input style=" border: solid;" type="text" value="<?php echo $_POST['username'];?>" name="sender" readonly >
                        </div>
                    </div>
                    <div class="field">
                        <label>To:</label>
                        <div class="ui left labeled icon input">
                            <input style=" border: solid;" type="text" name="receiver" id="receiver" placeholder="Enter Name"  >
                        </div>
                    </div>
                    <div id="personList"></div>
                    <div class="field">
                        <label>Body:</label>
                        <div class="ui left labeled icon input">
                            <textarea style=" border: solid;" form="form" type="text" name="body" class="bodyclass"></textarea>
                        </div>
                    </div>
                    <div align="right">
                        <input style="margin-left:570px;" class="ui positive button" type="submit" name="create_message" value="Send">
                    </div>
                </div>
            </div>
        </div>
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
        <div style="margin:30px;" class="ui two column middle aligned relaxed grid basic segment">
            <div class="column">
                <div style=" background-color: #c9d3d8;" class="ui form segment AVAST_PAM_loginform">
                    <div class="field">
                        <label>From:</label>
                        <div class="ui left labeled icon input">
                            <input style=" border: solid;" type="text" value="<?php echo $_SESSION['username'];?>" name="sender" readonly >
                        </div>
                    </div>
                    <div class="field">
                        <label>To:</label>
                        <div class="ui left labeled icon input">
                            <input style=" border: solid;" type="text" name="receiver" id="receiver" value="<?php echo $_POST['receiver'];?>" readonly>
                        </div>
                    </div>
                    <div id="personList"></div>
                    <div class="field">
                        <label>Body:</label>
                        <div class="ui left labeled icon input">
                            <textarea style=" border: solid;" form="form" type="text" name="body" class="bodyclass"><?php echo $msg; ?></textarea>
                        </div>
                    </div>
                    <div align="right">
                        <input style="margin-left:570px;" class="ui positive button" type="submit" name="reply" value="Send">
                    </div>
                </div>
            </div>
        </div>
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
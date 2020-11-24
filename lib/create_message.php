<?php
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
<form action="add_message.php" method="post" id="form">
    <label>From:</label>
    <input type="text" value="<?php echo $_POST['username']?>" name="sender" readonly><br>
    <label>To:</label>
    <input type="text" name="receiver" id="receiver" placeholder="Enter Name" /><br>
    <div id="personList"></div>
    Body: <textarea form="form" type="text" name="body" class="bodyclass"></textarea><br>
    <input type="submit" name="create_message" value="Send">
</form>


</body>
</html>
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
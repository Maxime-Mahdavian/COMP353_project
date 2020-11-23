<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
</head>
<body>
<div style = "background-color:#aca3ec; height:100px; color:#4D39D6; padding:3px;"><b><br><i class="huge chess rook icon"></i></b><b align="middle" style="margin-bottom:10px; color:white; font-size:40px;">CON</b></div>
<br>
<br>
<a style="margin:30px; font-size: 40px;" class="item">
    Admin Options<i class="wrench icon"></i>
</a>
</body>

<?php
// INIT
require __DIR__ . DIRECTORY_SEPARATOR . "config.php";
require PATH_LIB . "Poll.php";
session_start();

$pollDB = new Poll();

// DUMMY USER SESSION
/*$_SESSION['user'] = [
    "id" => 999,
    "name" => "Jonh Doe"
];*/

// HANDLE AJAX REQUEST
switch ($_POST['req']) {
    /* [INVALID REQUEST] */
    default:
        echo "Invalid request";
        break;

    /* [SHOW POLLS LIST] */
    // YOU MIGHT WANT TO PROPERLY PAGINATE THIS
    case "list":
        $polls = $pollDB->getAll(); ?>
        <h1 style="margin:30px; color:#533fe2;">MANAGE POLLS</h1>
        <input style="margin:40px;" class="ui blue button" value="Add Poll" onclick="polljs.addEdit()"/>

        <?php if (is_array($polls)) {
        foreach ($polls as $p) {
            printf("<div style='margin:40px; font-size:20px;'>-%s <input class='ui red button' value='Delete' onclick='polljs.del(%u)'/> <input class='ui black button' value='Edit' onclick='polljs.addEdit(%u)'/></div>", $p['poll_question'], $p['poll_id'], $p['poll_id']);
        }
    } else {
        echo "No polls found";
    }
        break;

    /* [DELETE POLL] */
    case "del":
        echo $pollDB->del($_POST['poll_id']) ? "OK" : "ERR";
        break;

    /* [ADD/EDIT DOCKET] */
    case "addEdit":
        $edit = is_numeric($_POST['poll_id']);
        if ($edit) {
            $poll = $pollDB->get($_POST['poll_id']);
        } ?>
        <h1 style="margin-left:40px; color:#533fe2;"><?=$edit?"EDIT":"ADD"?> POLL</h1>
        <div style="margin-left:50px;"><p style="font-weight:bold; font-size:20.8px;">QUESTION</p>
        <input type="hidden" id="ae-poll-id" value="<?=$_POST['poll_id']?>"/>
        <input style="margin-left:15px;" class='ui big input' id="ae-poll-text" value="<?=$poll['question']?>"/>
        </div>
        <h3 style="margin-left:50px;">OPTIONS</h3>
        <div style="margin-left:60px;" id="ae-poll-opt"><?php
            if (is_array($poll['options'])) {
                foreach ($poll['options'] as $o) {
                    printf("<div><input style='margin-left:5px;' class='ui big input' class='ae-poll-opt' value='%s'> <input style='margin:5px;' class='ui tiny red button' value='Remove' onclick='polljs.remove(this)'/></div>", $o);
                }
            }
            ?></div>
        <input style='margin-left:40px;' class="ui teal button" value="Add option" onclick="polljs.create()"/>
        <br>
        <button style="margin-left:30px;" class="ui blue left labeled icon button" type="submit" name="back" onclick="polljs.list();">
            <i class="left arrow icon"></i>
            Back
        </button>
<!--        <input type="button" value="Back" onclick="polljs.list()"/>-->
        <button style="margin-left:10px;" class="ui green left labeled icon button" type="submit" name="Save" onclick="polljs.save();">
            <i class="save outline icon"></i>
            Save
        </button>

<!--        <input class="ui green button" value="Save" onclick="polljs.save()"/>-->
        <?php break;

    /* [ADD POLL] */
    case "add":
        echo $pollDB->add($_POST['poll_question'], $_POST['poll_options']) ? "OK" : "ERR";
        break;

    /* [EDIT POLL] */
    case "edit":
        echo $pollDB->edit($_POST['poll_question'], $_POST['poll_options'], $_POST['poll_id']) ? "OK" : "ERR";
        break;
}
?>

</html>

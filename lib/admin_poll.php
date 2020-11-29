<?php
// INIT
require __DIR__ . DIRECTORY_SEPARATOR . "config.php";
require PATH_LIB . "Poll.php";
session_start();

$pollDB = new Poll();

// HANDLE AJAX REQUEST
switch ($_POST['req']) {
    /* [INVALID REQUEST] */
    default:
        echo "Invalid request";
        break;

    /* [SHOW POLLS LIST] */
    case "list":
        $polls = $pollDB->getAll(); ?>
        <h1 style="margin:30px; color:#533fe2;">MANAGE POLLS</h1>
        <input style="margin:40px;" class="ui blue button" value="Add Poll" onclick="polljs.addEdit()"/>

        <?php if (is_array($polls)) {
        foreach ($polls as $p) {
            printf("<div style='margin:40px; font-size:20px;'>-%s <input class='ui red button' value='Delete' onclick='polljs.del(%u)'/> 
                    <input class='ui black button' value='Edit' onclick='polljs.addEdit(%u)'/>
                    <input class='ui black button' value='Close' onclick='polljs.close(%u)'/></div>",
                    $p['poll_question'], $p['poll_id'], $p['poll_id'], $p['poll_id']);
        }
    } else {
        echo "No polls found";
    }
        break;

    /* [DELETE POLL] */
    case "del":
        echo $pollDB->del($_POST['poll_id']) ? "OK" : "ERR";
        break;

    case "close":
        echo $pollDB->close($_POST['poll_id']) ? "OK" : "ERR";
        break;

    /* [ADD/EDIT DOCKET] */
    case "addEdit":
        $edit = is_numeric($_POST['poll_id']);
        if ($edit) {
            $poll = $pollDB->get($_POST['poll_id']);
        } ?>
        <h1 style="margin-left:40px; color:#533fe2;"><?=$edit?"EDIT":"ADD"?> POLL</h1>
        <div style="margin-left:50px;"><h3 style="font-weight:bold; font-size:20.8px;">QUESTION</h3>
        <input type="hidden" id="ae-poll-id" value="<?=$_POST['poll_id']?>"/>
        <input style="margin-left:15px;" class='ui big input' id="ae-poll-text" value="<?=$poll['question']?>"/>
        </div>
        <h3 style="margin-left:50px;">OPTIONS</h3>
        <div style="margin-left:60px;" id="ae-poll-opt"><?php
            if (is_array($poll['options'])) {
                foreach ($poll['options'] as $o) {
                    printf("<div><input style='margin-left:5px;' class='ui big input ae-poll-opt' value='%s'> <input style='margin:5px;' class='ui tiny red button' value='Remove' onclick='polljs.remove(this)'/></div>", $o);
                }
            }
            ?></div>
        <input style='margin-left:40px;'  class="ui teal button" value="Add option" onclick="polljs.create()"/>
        <hr>
        <input style="margin-left:30px;" class="ui blue left labeled icon button" name="Back" value="Back" onclick="polljs.list();">
            <!--<i class="left arrow icon"></i>
            Back-->
        </input>
<!--        <input type="button" value="Back" onclick="polljs.list()"/>-->
        <input style="margin-left:10px;" class="ui green left labeled icon button" name="Save" value="Save" onclick="polljs.save();">
            <!--<i class="save outline icon"></i>
            Save-->
        </input>

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

<?php
/* [INIT] */
session_start();
require __DIR__ . DIRECTORY_SEPARATOR . "config.php";
require PATH_LIB . "Comment.php";
$pdo = new Comments();

if(!isset($_SESSION['username'])){
    header("location: login.php");
}

/* [HANDLE AJAX REQUESTS] */
switch ($_POST['req']) {
    /* [INVALID REQUEST] */
    default:
        echo "ERR";
        break;

    /* [SHOW COMMENTS] */
    case "show":
        $comments = $pdo->get($_POST['post_id']);
        function show ($cid, $rid, $name, $time, $message, $indent = 0) { ?>
            <div class="ccomment<?= $indent ? " creply" : "" ?>">
                <div style="margin-left:20px; width: 1700px;" class="ui two column middle aligned relaxed grid basic segment">
                    <div class="column">
                        <div style=" background-color: #c9d3d8;" class="ui form segment AVAST_PAM_loginform">
                            <div class="field">
                                <span style="font-size: 20px; class="cname"><?=$name?></span>
                                <span class="ctime"> |   <?=$time?></span>
                                <div class="field">
                                    <textarea class="cmessage" style="height: 50px;" type="text" name="nmessage" readonly><?=$message?></textarea>
                                </div>
                            </div>
                            <input type="button" class="ui smaller blue button" value="Reply" onclick="comments.reply(<?=$cid?>, <?=$rid?>)"/>
                            <?php if($_SESSION['admin'] == 1)
                                echo '<input type="button" class="ui smaller red button" value="Delete" onclick="comments.del('.$cid.')"/>';
                            ?>
                            <div style="width: 700px;" id="reply-<?=$cid?>"></div>
                        </div>
                    </div>
                </div>
            </div>

        <?php }
        if (is_array($comments)) { foreach ($comments as $c) {
            show($c['comment_id'], $c['comment_id'], $c['name'], $c['timestamp'], $c['message']);
            if (is_array($c['reply'])) { foreach ($c['reply'] as $r) {
                show($r['comment_id'], $c['comment_id'], $r['name'], $r['timestamp'], $r['message'], 1);
            }}
        }}
        break;

    /* [SHOW REPLY FORM] */
    case "reply": ?>
        <form style="margin-left:20px; " onsubmit="return comments.add(this)" class="creplyform">
            <div style="margin-left:20px; width: 1400px;" class="ui two column middle aligned relaxed grid basic segment">
                <div style="margin-left:20px;" class="column">
                    <div style=" background-color: #d5e2ff;" class="ui form segment AVAST_PAM_loginform">
                        <div class="field">
                            <label style="font-size: 20px;">Leave a reply</label><br>
                            <div class="field">
                                <input type="hidden" name="reply_id" value="<?=$_POST['reply_id']?>"/>
                                <input type="text" name="name" placeholder="<?php echo $_SESSION['username'];?>" value="<?php echo $_SESSION['username'];?>" disabled/>
                            </div>
                        </div>
                        <div class="field">
                            <textarea style="height: 50px;" name="message" placeholder="Message (300 characters max)" maxlength="300" required></textarea>
                        </div>
                        <div align="right">
                            <input class="cbutton ui positive button" type="submit" value="Post Comment">
                        </div>
                    </div>
                </div>
            </div>
        </form>
<!--    -->
<!--        <form style="background-color: #d5e2ff" onsubmit="return comments.add(this)" class="creplyform">-->
<!--            <h1>Leave a reply</h1>-->
<!--            <input type="hidden" name="reply_id" value="--><?//=$_POST['reply_id']?><!--"/>-->
<!--            <input type="text" name="name" placeholder="--><?php //echo $_SESSION['username'];?><!--" value="--><?php //echo $_SESSION['username'];?><!--" disabled/>-->
<!--            <textarea name="message" placeholder="Message" required></textarea>-->
<!--            <input type="submit" class="cbutton ui positive button" value="Post Comment"/>-->
<!--        </form>-->
        <?php break;


    /* [ADD COMMENT] */
    case "add":
        echo $pdo->add($_POST['post_id'], $_SESSION['username'], $_POST['message'], $_POST['reply_id']) ? "OK" : "ERR";
        break;

    case "del":
        echo $pdo->delete($_POST['comment_id']) ? "OK" : "ERR";
        break;

    case "edit":
        echo $pdo->edit($_POST['comment_id'], $_POST['name'], $_POST['message']) ? "OK" : "ERR";
        break;
}
?>
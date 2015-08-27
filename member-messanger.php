<?php
/**
 * Created by PhpStorm.
 * User: iBoss
 * Date: 25.08.15
 * Time: 14:49
 */
include ('const_db.php');
$myConnect = mysql_connect($dbHost,$dbUser,$dbPass);
mysql_select_db($dbName,$myConnect);
mysql_set_charset('utf8');
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
mysql_query("SET NAMES 'utf8'");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="mystyle.css" rel="stylesheet" type="text/css">
    <title>Messanger</title>
    <script>
        function showTemplate(template) {
            var _ui=document.getElementById(template);
            _ui.style.display = (_ui.style.display == 'none') ? 'block' : 'none';
        }

    </script>

</head>
<body>
<div class="wrapper" style="width: 90%">
    <header class="clearfix">
        <div class="logo"></div>
        <div class="info"></div>
    </header>
    <nav>
        <a href="index.php">Main</a>
        <a href="admin-messanger.php">AdminMessanger</a>
        <a href="member-messanger.php">MemberMessanger</a>
    </nav>
    <?
    $myId='101002';
    $rows=0;
    $res = mysql_query("SELECT tbl.id, tbl.fname, tbl.lname FROM test.travel_register_member AS tbl where tbl.referal='<?=myId?>'",$myConnect);
    $rows=mysql_num_rows($res);
    if ($rows >0) {
        echo "showTemplate('haveRef');";
        echo "showTemplate('noRef');";
    }

    //Тут запрос в БД для формирования списка реффералов
    ?>
    <div class="wrapper2 clearfix">
        <div class="layout-widecol">

            <div id="haveRef" style="display: none;">
                <div class="h-form">New message for:</div>
                <select name="recipient">
                    <option disabled>Choose recipient</option>
                    <?
                        $referrals = array();
                        while ($referrals[]=mysql_fetch_array($res, MYSQL_ASSOC)) {
                            echo "<option value='".$referrals['id']."'>".$referrals['fname']." ".$referrals['lname']."</option>";
                        }
                    ?>
                </select>
                <button style="float: right; margin-right: 0;">Create message</button><br>
            </div>
            <div id="noRef" style="display: block;" class="h-form">
                Sorry! You can send message to admin only.
            </div>
            <div class="h-form" style="margin-bottom: 25px;">Templates:</div>

            <button class="dialog" onclick="showTemplate('freeAccess');">Free access request</button>
                <div id="freeAccess" class="template-request">
                    Dear Admins.  <br>Please open free access into Back Office for<br>
                    <input type="text"/><br>
                    email for registration<br>
                    <input type="email"/><br>
                    <div style="text-align: center;">
                        <input type="submit" value="Send">
                        <input type="button" style="margin-right: 0;" value="Cancel">
                    </div>
                </div>
        </div>

        <div class="layout-widecol">
            <form action="" id="speech"></form>
            <div class="h-form" style="margin-bottom: 25px;">Dialogs:</div>
            <button class="dialog admins" onclick="showTemplate('_ui_openD_admin')">Administration (5 new)</button>
            <div id="_ui_openD_admin" class="speechWrapper">
                <div class="dialogOpen">
                    <p class="speech guest">Hi!</p>
                    <p class="speech owner">Hi!</p>
                    <p class="speech guest">Do you know about skynet?</p>
                    <p class="dt-separator">--------------------------- 2015.02.01 ---------------------------</p>
                    <p class="speech owner">No. What is it?</p>
                    <p class="speech guest">This is artificial intellect!</p>
                    <p class="speech guest">If we'll do nothing it will nuclear war and destroy whole humanoid!</p>
                    <p class="speech guest">But really i want ask you about discount on hotel :)</p>
                </div>
                <input form="speech" type="text" class="" name="frase" id="_ui_frase">
                <input form="speech" type="submit" class="" name="sendFrase" value="Send">
            </div>
            <button class="dialog common newMess">John Smith (1 new)</button>
            <button class="dialog common newMess" onclick="showTemplate('_ui_openD_101233')">Sara Konor (2 new)</button>
            <div id="_ui_openD_101233" class="speechWrapper">
                <div class="dialogOpen">
                    <p class="speech guest">Hi!</p>
                    <p class="speech owner">Hi!</p>
                    <p class="speech guest">Do you know about skynet?</p>
                    <p class="dt-separator">--------------------------- 2015.02.01 ---------------------------</p>
                    <p class="speech owner">No. What is it?</p>
                    <p class="speech guest">This is artificial intellect!</p>
                    <p class="speech guest">If we'll do nothing it will nuclear war and destroy whole humanoid!</p>
                    <p class="speech guest">But really i want ask you about discount on hotel :)</p>
                </div>
                <input form="speech" type="text" class="" name="frase" id="_ui_frase">
                <input form="speech" type="submit" class="" name="sendFrase" value="Send">
            </div>
            <button class="dialog common">Arnold Shvarcnegger</button>

        </div>
    </div>
    </div>
</body>
</html>
<?
mysql_close($myConnect);
?>
<?php
/**
 * Created by PhpStorm.
 * User: iBoss
 * Date: 25.08.15
 * Time: 14:49
 */

include ('const_db.php');
$myConnect = mysql_connect($dbHost,$dbUser,$dbPass);
if (!$myConnect) {
    echo 'Error connection to BD';
    exit;
}
$testConnect = mysql_select_db($dbName,$myConnect);
if (!$testConnect) {
    echo 'Error connection to TEST BD';
    echo 'Error connection to TEST BD';
    exit;
}
//mysql_set_charset('utf8');
//mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
//mysql_query("SET NAMES 'utf8'");
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

        function accordion(template) {
            var _ui=document.getElementById(template);
            if (_ui.style.display == 'none') {
                var aAllSpeeches = document.getElementsByClassName('speechWrapper');
                for (var i=0; i<aAllSpeeches.length; i++)
                    if (aAllSpeeches[i].style.display == 'block') aAllSpeeches[i].style.display = 'none';
                _ui.style.display = 'block';
            } else {
                _ui.style.display = 'none';
            }
        }

        function divCreate (elem, className, idElement, innerHTML, parentElement, onClickF) {
            var ui_dv = document.createElement(elem);
            ui_dv.className = className;
            ui_dv.idElem = idElement;
            ui_dv.onclick = onClickF;
            ui_dv.innerHTML = innerHTML;
            parentElement.appendChild(ui_dv);
        }

        function createDialog () {
            //берем имя выбранного получателя и его id
            var recipient = document.getElementsByName('recipient')[0].value;
            // разделяем id и имя
            for (var i=0; i< recipient.length; i++)
                if (recipient.charAt(i)==' ') {
                    var recipientId = recipient.substring(0,i); // id
                    var recipientName = recipient.substring(i); // имя
                    break;
                }

            //создать кнопку с именем получателя
            var ui_dv = document.createElement('button');
            ui_dv.className = 'dialog common newMess';
            var idElem = '_ui_openD_'+recipientId;
            ui_dv.idElem = idElem;
            ui_dv.onclick = function() { accordion(this.idElem);};
            ui_dv.innerHTML = recipientName;

            //найти парент блок администратора и прихерачить кнопку к нему
            var ui_owner = document.getElementsByClassName('layout-widecol')[1];
            ui_owner.appendChild(ui_dv);
            ui_dv.style.display = 'block';
            //создать окно диалога и напихать туда данных, если есть

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
    <div class="wrapper2 clearfix">
        <div class="layout-widecol">

        <?
        $myId='101002';
        $rows=0;
        $res = mysql_query("SELECT tbl.id, tbl.fname, tbl.lname FROM test.travel_register_member AS tbl where tbl.referal='".$myId."'",$myConnect);
        $rows=mysql_num_rows($res);
        if ($rows >0) {
            ?>
            <div class="h-form">New message for:</div>
            <select name="recipient">
                <option disabled selected>Choose recipient</option>
                <?
                $referrals = array();
                $i=0;
                while ($referrals[] = mysql_fetch_array($res, MYSQL_ASSOC)) {
                    echo "<option value='" . $referrals[$i]['id'] ." ".$referrals[$i]['fname']." ".$referrals[$i]['lname']."'>" . $referrals[$i]['fname'] . " " . $referrals[$i]['lname'] . "</option>";
                    $i++;
                };
                ?>
            </select>
            <button style="float: right; margin-right: 0;" onclick="createDialog();">Create message</button><br>
        <?
        } else {
            ?>
            <div id="noRef" style="display: block; margin-bottom: 25px;" class="h-form">
                Sorry! You can send message to admin only.
            </div>
            <?
        }
        ?>
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
            <button class="dialog admins" onclick="accordion('_ui_openD_admin')">Administration (5 new)</button>
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
            <button class="dialog common newMess" onclick="accordion('_ui_openD_101233')">Sara Konor (2 new)</button>
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
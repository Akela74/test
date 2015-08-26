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
    $myId=13;
    //Тут запрос в БД для формирования списка реффералов
    ?>
    <div class="wrapper2 clearfix">
        <div class="layout-widecol">
            <div class="h-form">New message for:</div>
            <select name="recipient">
                <option disabled>Choose recipient</option>
                <option value="106234">Иванов</option>
                <option value="106235">Петров</option>
                <option value="106236">Сидоров</option>
            </select>
            <button style="float: right; margin-right: 0;">Create message</button><br>

            <button class="dialogPanel">Free access request</button>
                <div id="hiddenRequest" class="access-request">
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

        </div>
    </div>
    </div>
</body>
</html>
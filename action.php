<?php
//подключаем конфигурационный файл бд
include_once("config.php");

if((isset($_POST["name_txt"]) && strlen($_POST["name_txt"])>0)
    &&(isset($_POST["email_txt"]) && strlen($_POST["email_txt"])>0)
    &&(isset($_POST["message_txt"]) && strlen($_POST["message_txt"])>0))
{

    $nameToSave = $_POST["name_txt"];
    $emailToSave = $_POST["email_txt"];
    $messageToSave = $_POST["message_txt"];
    
    if(mysql_query("INSERT INTO comments SET `name` = '".$nameToSave."',`email` = '".$emailToSave."',`message` = '".$messageToSave."'"))
    {
        $my_id = mysql_insert_id(); //Get ID of last inserted record from MySQL
        echo '<div class="item col-xs-12 col-sm-6 col-md-4 col-lg-3 text-center"><div class="panel panel-custom" id="item_'.$my_id.'">';
        echo '<div class="panel-heading"><h3 class="panel-title">'.$nameToSave.'</h3></div>';
        echo '<div class="panel-body">';
        echo '<a href="mailto:'.$emailToSave.'">'.$emailToSave.'</a>';
        echo '<br><p>'.$messageToSave.'</p>';
        echo '</div></div></div>';
        mysql_close($useDB);

    }else{
        header('HTTP/1.1 500 Looks like mysql error, could not insert record!');
        exit();
    }
}else{
    header('HTTP/1.1 500 Error occurred, Could not process request!');
    exit();
}
?>
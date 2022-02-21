<?php 
    include "../mysql_connect.php";

    if(isset($_POST['boardName']) && $_POST['boardName'] != ""){
        $createBoard = $db_conn->prepare("INSERT INTO bord (`user_id`, `name`, `date`, `status`) VALUES ('".$_COOKIE['login_id']."', '".$_POST['boardName']."', '".date("Y-m-d")."', '1')");
        $createBoard->execute();
    }
?>
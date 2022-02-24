<?php 
    include "../mysql_connect.php";

    if(isset($_POST['id']) && $_POST['id'] != "" && isset($_POST['val']) && $_POST['val'] != ""){
        $changeRole = $db_conn->prepare("UPDATE users SET role_id=:role_id WHERE id=:id");
        $changeRole->bindParam(":role_id", $_POST['val']);
        $changeRole->bindParam(":id", $_POST['id']);
        $changeRole->execute();
    }
?>
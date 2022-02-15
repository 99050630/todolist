<?php 
    include "../mysql_connect.php";

    if(isset($_GET['type']) && $_GET['type'] != "" && isset($_GET['id']) && $_GET['id'] != ""){
        if($_GET['type'] == "remove"){
            $removeRow = $db_conn->prepare("DELETE FROM bord_items WHERE id='".$_GET['id']."'");
            $removeRow->execute();
        }
    }
?>
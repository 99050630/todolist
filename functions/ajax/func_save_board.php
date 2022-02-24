<?php 
    include "../mysql_connect.php";

    if(isset($_POST['boardIdEdit']) && $_POST['boardIdEdit'] != ''){
        $editSave = $db_conn->prepare("UPDATE bord SET `name`='".$_POST['boardNameEdit']."' WHERE id='".$_POST['boardIdEdit']."'");
        $editSave->execute();

        $indexCount = 0;
        $boardItems = $_POST['listItemEdit'];
        $dateItems = $_POST['listDateEdit'];
        // echo "<pre>";
        // print_r($board);
        // echo "</pre>";
        for($i = 0; $i < count($boardItems); $i++){
            $getRowData = $db_conn->prepare("SELECT `id` FROM bord_items WHERE bord_id=:bordid LIMIT 1 OFFSET ".$indexCount."");
            $getRowData->bindParam(":bordid", $_POST['boardIdEdit']);
            $getRowData->execute();
            $rowID = $getRowData->fetch();

            $updateRowData = $db_conn->prepare("UPDATE bord_items SET desc_1='".$boardItems[$i]."' date='".$dateItems[$i]."' WHERE id='".$rowID['id']."'");
            $updateRowData->execute();

            $indexCount++;
        }
    }
?>
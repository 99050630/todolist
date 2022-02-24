<?php 
    include "../mysql_connect.php";

    if(isset($_POST['addRow']) && $_POST['addRow'] != '' && isset($_POST['boardId'])){
        if(isset($_POST['addTime']) && $_POST['addTime'] != ''){
            $dateTime = $_POST['addTime'];
        }else{
            $dateTime = "0000-00-00 00:00:00";
        }

        $insertRow = $db_conn->prepare("INSERT INTO bord_items (`bord_id`, `desc_1`, `date`, `status`) VALUES (:bord_id, :desc_1, :date, :status)");
        $insertRow->execute(array("bord_id" => $_POST['boardId'], "desc_1" => $_POST['addRow'], "date" => $dateTime, "status" => '1'));

        echo $_POST['boardId'];
    }
?>
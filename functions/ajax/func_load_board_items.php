<?php 
    include "../mysql_connect.php";

    if(isset($_GET['filter']) && $_GET['filter'] != ''){
        $setFilter = "ORDER BY ".$_GET['filter'];
    }else{
        $setFilter = "";
    }

    $selectBoardItems = $db_conn->prepare("SELECT * FROM bord_items WHERE bord_id=:bord_id ".$setFilter."");
    $selectBoardItems->bindParam(":bord_id", $_GET['id']);
    $selectBoardItems->execute();
    $i = 0;
    while($result = $selectBoardItems->fetch()){
        echo "<div class=\"list_item\">";
        echo "  <div class=\"list_item_status\">";
        if($result['status'] == "1"){
            echo "<i class=\"fa-solid fa-circle\" style=\"color: green;\"></i>";
        }else{
            echo "<i class=\"fa-solid fa-circle\" style=\"color: orange;\"></i>";
        }
        echo "  <div>".$result['desc_1']."</div>";
        echo "</div>";
        if($result['date'] != "0000-00-00 00:00:00"){
            echo    "<div>".$result['date']."</div>";
        }
        echo "</div>";
    }    

?>
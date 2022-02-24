<?php 
    include "../mysql_connect.php";

    if(isset($_GET['type']) && $_GET['type'] != ''){
        if($_GET['type'] == "remove"){
            if(isset($_GET['id']) && $_GET['id'] != ''){
                $boardId = $_GET['id'];
                $removeBoard = $db_conn->prepare("DELETE FROM bord WHERE id=:id");
                $removeBoardItems = $db_conn->prepare("DELETE FROM bord_items WHERE bord_id=:bord_id");

                $removeBoard->bindParam(":id", $boardId);
                $removeBoardItems->bindParam(":bord_id", $boardId);

                $removeBoard->execute();
                $removeBoardItems->execute();

                echo "Bord is verwijderd";
            }
        }elseif($_GET['type'] == "edit"){
            if(isset($_GET['id']) && $_GET['id'] != ''){
                echo "<div class=\"todolist_header_title\">";
                echo "    <h2>Bord bewerken</h2>";
                echo "</div>";
                $selectBoardInfo = $db_conn->prepare("SELECT `name`, `id` FROM bord WHERE id=:id");
                $selectBoardInfo->bindParam(":id", $_GET['id']);
                $selectBoardInfo->execute();
                $resultBoard = $selectBoardInfo->fetch();
                ?>
                <div class="todolist_content">
                    <form method="POST" id="editBoardForm">
                        <div class="edit_header">
                            <h2>Bord naam</h2>
                            <input type="hidden" name="boardIdEdit" value="<?php echo $resultBoard['id']; ?>">
                            <input type="text" name="boardNameEdit" placeholder="Bijv. boodschappenlijst.." value="<?php echo $resultBoard['name']; ?>">
                        </div>
                        <div class="edit_body">
                            <h2>Bord items</h2>
                        <?php
                            $selectBoardItems = $db_conn->prepare("SELECT * FROM bord_items WHERE bord_id=:bord_id");
                            $selectBoardItems->bindParam(":bord_id", $resultBoard['id']);
                            $selectBoardItems->execute();
                            while($getBordInfo = $selectBoardItems->fetch()){
                                echo "<div class=\"list_item\">";
                                echo    "<input type='text' name='listItemEdit[]' value='".$getBordInfo['desc_1']."'>";
                                if($getBordInfo['date'] == "0000-00-00 00:00:00"){
                                    $date = str_replace($getBordInfo['date'], " ", "T");
                                }else{
                                    $date = $getBordInfo['date'];
                                }
                                echo    "<input type=\"datetime-local\" class=\"datetimeInput\" name=\"listDateEdit[]\" value=\"".$date."\">";
                                echo    "<i class=\"fa-solid fa-trash-can\" onclick=\"boardItemAction('remove', ".$getBordInfo['id'].", ".$_GET['id'].");\"></i>";
                                echo "</div>";
                            }
                        ?>
                        <button type="button" onclick="saveBoard(<?php echo $resultBoard['id']; ?>)">Bewerken</button>
                        </div>
                    </form>
                </div>
                <?php
            }
        }
    }
?>
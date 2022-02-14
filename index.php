<?php 
    include "functions/mysql_connect.php";
    include "functions/classes.php";

    $todo = new toDoList($conn);
    //Remove content handelers
    if(isset($_POST['boardRemove']) && isset($_POST['boardRemoveId']) && $_POST['boardRemoveId'] != ""){
        $todo->removeUser($_POST['boardRemoveId']);
    }
    //Edit content handelers
    if(isset($_POST['boardEditSave']) && isset($_POST['boardNameEdit']) && $_POST['boardNameEdit'] != '' && isset($_POST['listItemEdit'])){
        $todo->updateBoard($_POST['boardNameEdit'], $_POST['boardIdEdit'], $_POST['listItemEdit']);
    }
    //Nieuwe content handelers
    if(isset($_POST['addRowBtn']) && isset($_POST['addRow']) && isset($_POST['addTime'])){
        $todo->insertNewRow($_POST['board_id'], $_POST['addRow'], $_POST['addTime']);
    }
    if(isset($_POST['newBoard']) && isset($_POST['boardName']) && $_POST['boardName'] != ""){
        $todo->makeBoard($_POST['boardName']);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To do list | Jordan Bel | 99050630</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div id="todolist">
        <div class="todolist_container">
            <div class="todolist_header">
                <?php 
                    if(isset($_POST['boardEdit']) && isset($_POST['boardEditId']) && $_POST['boardEditId'] != ''){
                        $editResult = $todo->loadBoard($_POST['boardEditId']);
                        ?>
                            <div class="todolist_header_title">
                                <h2>Bord bewerken</h2>
                            </div>
                            <div class="todolist_content">
                                <form method="POST">
                                    <div class="edit_header">
                                        <h2>Bord naam</h2>
                                        <input type="hidden" name="boardIdEdit" value="<?php echo $editResult[0]['id']; ?>">
                                        <input type="text" name="boardNameEdit" placeholder="Bijv. boodschappenlijst.." value="<?php echo $editResult[0]['name']; ?>">
                                    </div>
                                    <div class="edit_body">
                                        <h2>Bord items</h2>
                                    <?php
                                        $getBordInfo = $todo->loadBoardInfo($editResult[0]['id']);
                                        for($j = 0; $j < count($getBordInfo); $j++){
                                            echo "<div class=\"list_item\">";
                                            echo    "<input type='text' name='listItemEdit[]' value='".$getBordInfo[$j]['desc_1']."'>";
                                            echo    "<input type=\"datetime-local\" name=\"listDateEdit[]\" value=\"".$getBordInfo[$i]['date']."\">";
                                            echo    "<button type='submit' name='boardRemove'><i class=\"fa-solid fa-trash-can\"></i></button>";
                                            echo "</div>";
                                        }
                                    ?>
                                    <button type="submit" name="boardEditSave">Bewerken</button>
                                    </div>
                                </form>
                            </div>
                        <?php
                    }else{
                ?>
                        <div class="todolist_header_title">
                            <h2>Maak bord</h2>
                        </div>
                        <div class="todolist_content">
                            <form method="POST">
                                <input type="text" name="boardName" placeholder="Bijv. boodschappenlijst..">
                                <button type="submit" name="newBoard">Aanmaken</button>
                            </form>
                        </div>
                <?php 
                    }
                ?>
            </div>
            <?php 
                $result = $todo->loadBoard();
                // echo "<pre>";
                // print_r($result);
                // echo "</pre>";
                for($i = 0; $i < count($result); $i++){
                    echo "<div class=\"list_container\" id=\"".$result[$i]['id']."\">";
                    echo "  <div class=\"list_header\">";
                    echo "      <h2>".$result[$i]['name']."</h2>";
                    echo "      <div class=\"list_header_right\">";
                    echo "          <p>".$result[$i]['date']."</p>";
                    echo "          <form method='POST'>";
                    echo "              <input type='hidden' name='boardEditId' value='".$result[$i]['id']."'>";
                    echo "              <button type='submit' name='boardEdit'><i class=\"fa-solid fa-pencil\"></i></button>";
                    echo "          </form>";
                    echo "          <form method='POST'>";
                    echo "              <input type='hidden' name='boardRemoveId' value='".$result[$i]['id']."'>";
                    echo "              <button type='submit' name='boardRemove'><i class=\"fa-solid fa-trash-can\"></i></button>";
                    echo "          </form>";
                    echo "      </div>";
                    echo "  </div>";
                    echo "  <div class=\"list_content\">";
                                $getBordInfo = $todo->loadBoardInfo($result[$i]['id']);
                                for($j = 0; $j < count($getBordInfo); $j++){
                                    echo "<div class=\"list_item\">";
                                    echo    "<div>".$getBordInfo[$j]['desc_1']."</div>";
                                    if($getBordInfo[$j]['date'] != "0000-00-00 00:00:00"){
                                        echo    "<div>".$getBordInfo[$j]['date']."</div>";
                                    }
                                    echo "</div>";
                                }
                    echo "  </div>";
                    echo "  <div class=\"list_footer\">";
                    echo "      <form method=\"POST\">";
                    echo "          <input type='hidden' name='board_id' value=\"".$result[$i]['id']."\">";        
                    echo "          <input type='text' name='addRow' placeholder=\"Nieuwe regel toevoegen..\">";
                    echo "          <input type='datetime-local' class=\"datetimeInput\" name='addTime'>";
                    echo "          <button type='submit' name=\"addRowBtn\">Toevoegen</button>";        
                    echo "      </form>";    
                    echo "  </div>";
                    echo "</div>";
                }
            ?>
        </div>
    </div>
</body>
</html>
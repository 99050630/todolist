<?php 
    include "functions/mysql_connect.php";
    include "functions/classes.php";

    $todo = new toDoList($db_conn);
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="functions/ajax.js"></script>
</head>
<body>
    <div id="todolist">
        <div class="todolist_container">
            <div class="todolist_header" id="todolist_header">
                <div class="todolist_header_title">
                    <h2>Maak bord</h2>
                </div>
                <div class="todolist_content">
                    <form method="POST" id="makeBoardForm">
                        <input type="text" name="boardName" placeholder="Bijv. boodschappenlijst..">
                        <button type="button" onclick="makeBoard()">Aanmaken</button>
                    </form>
                </div>
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
                    echo "          <select name='boardFilter' onchange=\"loadBoardItems(".$result[$i]['id'].", this.value)\">";
                    echo "              <option value=''>Selecteer een filter..</option>";
                    echo "              <option value='date ASC'>Datum/tijd oplopend</option>";
                    echo "              <option value='date DESC'>Datum/tijd aflopend</option>";
                    echo "              <option value='status ASC'>Status oplopend</option>";
                    echo "              <option value='status DESC'>Status aflopend</option>";
                    echo "          </select>";
                    echo "          <i class=\"fa-solid fa-pencil\" onclick=\"boardAction('edit', '".$result[$i]['id']."')\"></i>";
                    echo "          <i class=\"fa-solid fa-trash-can\" onclick=\"boardAction('remove', '".$result[$i]['id']."')\"></i>";
                    echo "      </div>";
                    echo "  </div>";
                    echo "  <div class=\"list_content\" id=\"list_content_".$result[$i]['id']."\">";
                                ?>
                                    <script>
                                        loadBoardItems(<?php echo $result[$i]['id']; ?>);
                                    </script>
                                <?php 
                    echo "  </div>";
                    echo "  <div class=\"list_footer\">";
                    echo "      <form method=\"POST\" id=\"addRowForm\">";
                    echo "          <input type='hidden' name='boardId' value=\"".$result[$i]['id']."\">";        
                    echo "          <input type='text' name='addRow' placeholder=\"Nieuwe regel toevoegen..\">";
                    echo "          <input type='datetime-local' class=\"datetimeInput\" name='addTime'>";
                    echo "          <button type='button' onclick=\"addNewRow('".$result[$i]['id']."');\">Toevoegen</button>";        
                    echo "      </form>";    
                    echo "  </div>";
                    echo "</div>";
                }
            ?>
        </div>
    </div>
</body>
</html>
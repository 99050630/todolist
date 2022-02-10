<?php 
    include "functions/mysql_connect.php";
    include "functions/classes.php";

    $todo = new toDoList($conn);

    if(isset($_POST['addRowBtn']) && isset($_POST['addRow'])){
        $todo->insertNewRow($_POST['board_id'], $_POST['addRow']);
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

            <?php 
                $result = $todo->loadBoard();
                echo "<pre>";
                print_r($result);
                echo "</pre>";
                for($i = 0; $i < count($result); $i++){
                    echo "<div class=\"list_container\" id=\"".$result[$i]['id']."\">";
                    echo "  <div class=\"list_header\"><h2>".$result[$i]['name']."</h2><div class=\"list_header_right\"><p>".$result[$i]['date']."</p><i class=\"fa-solid fa-bars\"></i></div></div>";
                    echo "  <div class=\"list_content\">";
                                $getBordInfo = $todo->loadBoardInfo($result[$i]['id']);
                                for($j = 0; $j < count($getBordInfo); $j++){
                                    echo "<div class=\"list_item\">";
                                    echo    $getBordInfo[$j]['desc_1'];
                                    echo "</div>";
                                }
                    echo "  </div>";
                    echo "  <div class=\"list_footer\">";
                    echo "      <form method=\"POST\">";
                    echo "          <input type='hidden' name='board_id' value=\"".$result[$i]['id']."\">";        
                    echo "          <input type='text' name='addRow' placeholder=\"Nieuwe regel toevoegen..\">";
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
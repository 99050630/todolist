<?php 
    include "../mysql_connect.php";

    $return_arr = array();
    $whereClause = "";
    $userID = "";
    if(isset($_GET['id']) && $_GET['id'] != ""){
        $whereClause = "AND id='".$_GET['id']."'";
    }
    if(isset($_GET['type']) && $_GET['type'] == "admin"){
        if(isset($_GET['user_id']) && $_GET['user_id'] != ''){
            $userID = $_GET['user_id'];
        }else{
            $userID = $_COOKIE['login_id'];
        }
    }else{
        $userID = $_COOKIE['login_id'];
    }
    $stmt = $db_conn->prepare("SELECT * FROM bord WHERE `user_id`=:userid AND `status`=:status $whereClause ORDER BY `date` DESC");
    $stmt->bindParam(":userid", $userID);
    $stmt->bindParam(":status", "1");
    $stmt->execute();
    $i = 0;
    while($result = $stmt->fetch()){
        $return_arr[$i] = $result;
        $i++;
    }

    $result = $return_arr;

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
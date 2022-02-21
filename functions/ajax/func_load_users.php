<?php 
    include "../mysql_connect.php";

    $selectAllUsers = $db_conn->prepare("SELECT `id`, `username`, `status` FROM users");
    $selectAllUsers->execute();

    while($resultAllUsers = $selectAllUsers->fetch()){
        echo "<div class=\"admin_user_item\" onclick=\"loadUserBoard(".$resultAllUsers['id'].");\">";
        echo "  <div class=\"admin_user_status\">";
            if($resultAllUsers['status'] == 1){
                echo "<i class=\"fa-solid fa-circle\" style=\"color: green;\"></i>";
            }else{
                echo "<i class=\"fa-solid fa-circle\" style=\"color: orange;\"></i>";
            }
        echo "  </div>";
        echo "  <div class=\"admin_user_username\">";
        echo "      <p>".$resultAllUsers['username']."</p>";
        echo "  </div>";
        echo "</div>";
    }
?>
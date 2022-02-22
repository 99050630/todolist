<?php 
    error_reporting(E_ALL);
    include "../mysql_connect.php";

    $selectAllUsers = $db_conn->prepare("SELECT `users`.`id`, `users`.`username`, `users`.`status`, `role`.`name` FROM users LEFT JOIN `role` ON `role`.`id`=`users`.`role_id`");
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
        echo "  <div class=\"admin_user_roles\">";
        echo "      <select name=\"admin_user_role\" onchange=\"chageUserRole(this.value, ".$resultAllUsers['id'].")\">";
                $selectRoles = $db_conn->prepare("SELECT * FROM `role`");
                $selectRoles->execute();
                while($resultRoles = $selectRoles->fetch()){
                    if($resultRoles['name'] == $resultAllUsers['name']){
                        echo "<option value=\"".$resultRoles['id']."\" SELECTED>".$resultRoles['name']."</option>";
                    }else{
                        echo "<option value=\"".$resultRoles['id']."\">".$resultRoles['name']."</option>";
                    }
                }
        echo "      </select>";
        echo "  </div>";
        echo "</div>";
    }
?>
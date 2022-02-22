<?php 
    include "functions/mysql_connect.php";

    if(isset($_COOKIE['login_id'])){
        $selectRole = $db_conn->prepare("SELECT `users`.`role_id`, `role`.`name` FROM users LEFT JOIN `role` ON `users`.`role_id`=`role`.`id` WHERE `users`.`id`='".$_COOKIE['login_id']."'");
        $selectRole->execute();
        $resultRole = $selectRole->fetch();
        if($resultRole['name'] == "admin"){
            ?>
                <div class="admin_user_container">
                    <div class="admin_user_header">
                        <h2>Gebruikers</h2>
                    </div>
                    <div class="admin_users" id="admin_users">
                        
                    </div>
                </div>
                <div class="admin_content" id="admin_content"></div>
                <script>
                    $(document).ready(function(){
                        $("#todolist").css("padding", "20px");
                        $("#todolist").css("justify-content", "flex-start");
                        $("#todolist").css("align-items", "flex-start");
                        loadUsers();
                    })
                </script>
            <?php
        }else{
            echo "<h2>U heeft geen rechten om deze pagina te bekijken.</h2>";
            echo "<a href=\"\">Klik hier om terug te gaan</a>";
            ?>
                <script>
                    $("#todolist").css("flex-direction", "column");
                </script>
            <?php
        }
    }else{
        echo "<h2>U heeft geen rechten om deze pagina te bekijken.</h2>";?>
        <script>
            $("#todolist").css("flex-direction", "column");
        </script>
    <?php
    }
?>
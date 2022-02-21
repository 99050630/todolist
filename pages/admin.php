<?php 
    include "functions/mysql_connect.php";
    $adminID = 4;

    if(isset($_COOKIE['login_id']) && $_COOKIE['login_id'] == $adminID){
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
    }
?>
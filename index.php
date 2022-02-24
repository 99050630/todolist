<?php 
    include "functions/mysql_connect.php";
    include "functions/classes.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To do list | Jordan Bel | 99050630</title>
    <base href="http://localhost/blok7/backend/todolist/">

    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="functions/ajax.js"></script>
</head>
<body>
    <div id="todolist">
        <?php 
            if(isset($_GET['p']) && $_GET['p'] == 'admin'){
                include "pages/admin.php";
            }else{
                if(isset($_COOKIE['login_id']) && $_COOKIE['login_id'] != ''){
            ?>
                    <div class="logout_container">
                        <a href="admin/"><i class="fa-solid fa-gears"></i></a>
                        <i onclick="logOut()" class="fa-solid fa-right-from-bracket"></i>
                    </div>
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
                        <div id="all_list_container"></div>
                        <script>
                            $(document).ready(function(){
                                loadBoard();
                            })
                        </script>
                    </div>
            <?php 
                }else{
                    include "pages/login.php";
                }
            }
            ?>
    </div>
</body>
</html>
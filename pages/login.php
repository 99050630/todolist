<?php 
    include "functions/mysql_connect.php";
?>
<div class="login_container">
    <?php 
        if(isset($_GET['p']) && $_GET['p'] == "register"){
    ?>
            <h2>Registreren</h2>
            <div id="error_form"></div>
            <form id="registerForm">
                <input type="hidden" name="type" id="type" value="register">
                <div class="form_item">
                    <input type="text" name="name" id="name" placeholder="Volledige naam..">
                </div>
                <div class="form_item">
                    <input type="text" name="username" id="username" placeholder="Gebruikersnaam..">
                </div>
                <div class="form_item">
                    <input type="password" name="password" id="password" placeholder="Wachtwoord..">
                </div>
                <div class="form_item">
                    <button type="button" onclick="register();">Registreren</button>    
                </div>
            </form>
            <a href="login/">Login hier</a>
    <?php 
        }else{
    ?>
            <h2>Inloggen</h2>
            <div id="error_form"></div>
            <form id="loginForm">
                <input type="hidden" name="type" id="type" value="login">
                <div class="form_item">
                    <input type="text" name="username" id="username" placeholder="Gebruikersnaam..">
                </div>
                <div class="form_item">
                    <input type="password" name="password" id="password" placeholder="Wachtwoord..">
                </div>
                <div class="form_item">
                    <button type="button" onclick="checkLogin();">Inloggen</button>    
                </div>
            </form>
            <a href="register/">Registreer hier</a>
    <?php 
        }
    ?>
</div>
<?php 
    include "../mysql_connect.php";
    $return_arr = array();
    if(isset($_POST['type']) && $_POST['type'] != ''){
        if($_POST['type'] == "login"){
            if($_POST['username'] != "" && $_POST['password'] != ""){
                $password = hash("sha256", $_POST['password']);
                $selectUserCount = $db_conn->prepare("SELECT COUNT('id') AS rowCount FROM users WHERE username=:username AND password=:passwrd AND status=1");
                $selectUserCount->bindParam(":username", $_POST['username']);
                $selectUserCount->bindParam(":passwrd", $password);
                // $selectUserCount->bindParam(":stts", "1");
                $selectUserCount->execute();
                $num_rows = $selectUserCount->fetchColumn();
                if($num_rows > 0){
                    //User gevonden
                    $selectUser = $db_conn->prepare("SELECT `id`, `name` FROM users WHERE username=:username AND password=:passwrd AND status=1");
                    $selectUser->bindParam(":username", $_POST['username']);
                    $selectUser->bindParam(":passwrd", $password);
                    // $selectUser->bindParam(":stts", "1");
                    $selectUser->execute();
                    $resultUser = $selectUser->fetch();
                    setcookie("login_id", $resultUser['id'], time() + (86400 * 30), "/");
                    setcookie("login_name", $resultUser['name'], time() + (86400 * 30), "/");
                    $return_arr['message'] = "login";
                }else{
                    $return_arr['message'] = "e";
                }
            }else{
                $return_arr['message'] = "e";
            }
        }elseif($_POST['type'] == "register"){
            if($_POST['name'] != '' && $_POST['username'] != "" && $_POST['password'] != ""){
                $selectUsername = $db_conn->prepare("SELECT COUNT(`username`) FROM users WHERE username=:username");
                $selectUsername->bindParam(":username", $_POST['username']);
                $selectUsername->execute();
                $num_rows_username = $selectUsername->fetchColumn();
                // echo $num_rows_username;
                if($num_rows_username > 0){
                    $return_arr['message'] = "Deze gebruiksnaam is al in gebruik.";
                }else{
                    $password = hash("sha256", $_POST['password']);
                    $db_conn->query("INSERT INTO users (`role_id`,
                                                            `name`,
                                                            `username`,
                                                            `password`,
                                                            `status`) VALUES (  '1',
                                                                                '".$_POST['name']."',
                                                                                '".$_POST['username']."',
                                                                                '".$password."',
                                                                                '1')");
                    $selectUser = $db_conn->prepare("SELECT `id`, `name` FROM users WHERE username='".$_POST['username']."' AND password='".$password."' AND status='1'");
                    $selectUser->execute();
                    $resultUser = $selectUser->fetch();
                    setcookie("login_id", $resultUser['id'], time() + (86400 * 30), "/");
                    setcookie("login_name", $resultUser['name'], time() + (86400 * 30), "/");
                }
            
            }else{
                $return_arr['message'] = "e";
            }
        }elseif($_POST['type'] == "logout"){
            unset($_COOKIE['login_id']); 
            unset($_COOKIE['login_name']); 
            setcookie('login_id', null, -1, '/'); 
            setcookie('login_name', null, -1, '/'); 
        }
    }else{
        $return_arr['message'] = "Er is een ongeldige actie uitgevoerd";
    }

    echo json_encode($return_arr);
?>
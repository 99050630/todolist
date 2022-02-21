//BOARD FUNCTIONS
function loadBoard(){
    $.ajax({
        type: "GET",
        url: "functions/ajax/func_load_board.php",
        data: {},
        success: function(data){
            $("#all_list_container").html(data);
        }
    })
}

function loadBoardItems(id, filter=""){
    $.ajax({
        type: "GET",
        url: "functions/ajax/func_load_board_items.php",
        data: {id: id, filter: filter},
        success: function(data){
            $("#list_content_"+id).html(data);
        }
    })
}

function addNewRow(){
    $.ajax({
        type: "POST",
        url: "functions/ajax/func_add_new_row.php",
        data: $("#addRowForm").serialize(),
        success: function(data){
            loadBoardItems(data);
        }
    })
}

function boardAction(type, id, name){
    $.ajax({
        type: "GET",
        url: "functions/ajax/func_board_action.php",
        data: {type: type, id: id},
        success: function(data){
            if(type == "remove"){
            }else if(type == "edit"){
                $("#todolist_header").html(data);
            }
        }
    })
}

function boardItemAction(type, id, bord_id){
    $.ajax({
        type: "GET",
        url: "functions/ajax/func_board_item_action.php",
        data: {type: type, id: id},
        success: function(data){
            if(type == "remove"){
                boardAction('edit', bord_id);
            }else if(type == "edit"){
                boardAction('edit', bord_id);
            }
        }
    })
}

function saveBoard(id){
    $.ajax({
        type: "POST",
        url: "functions/ajax/func_save_board.php",
        data: $("#editBoardForm").serialize(),
        success: function(data){

        }
    })
}

function makeBoard(){
    $.ajax({
        type: "POST",
        url: "functions/ajax/func_make_board.php",
        data: $("#makeBoardForm").serialize(),
        success: function(data){
            location.reload();
        }
    })
}


//LOGIN FUNCTIONS
function register(){
    $.ajax({
        type: "POST",
        url: "functions/ajax/func_login_handeler.php",
        data: $('#registerForm').serialize(),
        success: function(data){
            console.log(data['message']);
            if(data['message'] == "e"){
                //Input velden leeg;
                $('.form_item input').css('border-color', 'red');
            }else if(data['message'] == ""){
                location.href = "";
            }else{
                $("#error_form").html(data['message']);
            }
        },
        dataType: "JSON"
    });
}

function checkLogin(){
    $.ajax({
        type: "POST",
        url: "functions/ajax/func_login_handeler.php",
        data: $('#loginForm').serialize(),
        success: function(data){
            if(data['message'] == "e"){
                //Input velden leeg;
                $('.form_item input').css('border-color', 'red');
            }else if(data['message'] == "login"){
                location.href="";
            }
        },
        dataType: "JSON"
    });
}

function logOut(){
    $.ajax({
        type: "POST",
        url: "functions/ajax/func_login_handeler.php",
        data: {type: "logout"},
        success: function(data){
            location.href = "login/"
        }
    })
}


//ADMIN FUNCTIONS
function loadUsers(filter){
    $.ajax({
        type: "GET",
        url: "functions/ajax/func_load_users.php",
        data: {filter: filter},
        success: function(data){
            $("#admin_users").html(data);
        }
    })
}

function loadUserBoard(id){
    $.ajax({
        type: "GET",
        url: "functions/ajax/func_load_board.php",
        data: {type: "admin", user_id: id},
        success: function(data){
            $("#admin_content").html(data);
        }
    })
}
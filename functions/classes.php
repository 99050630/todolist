<?php 
    class toDoList{
        //Variables
        public $db_conn;
        //Constructors
        function __construct($db_conn){
            $this->db_conn = $db_conn;
        }
        //Functions
        //All remove functions
        //All update functions 
        //All load functions
        public function loadBoard($id="", $loginID){
            $return_arr = array();
            $whereClause = "";
            if($id != ""){
                $whereClause = "AND id='".$id."'";
            }
            $stmt = $this->db_conn->prepare("SELECT * FROM bord WHERE `user_id`='".$loginID."' AND `status`='1' $whereClause ORDER BY `date` DESC");
            $stmt->execute();
            $i = 0;
            while($result = $stmt->fetch()){
                $return_arr[$i] = $result;
                $i++;
            }

            return $return_arr;
        }
    }
?>
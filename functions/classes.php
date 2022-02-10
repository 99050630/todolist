<?php 
    class toDoList{
        //Variables
        public $conn;
        //Constructors
        function __construct($conn){
            $this->conn = $conn;
        }
        //Functions
        //All load functions
        public function loadBoard(){
            $return_arr = array();
            $stmt = $this->conn->prepare("SELECT * FROM bord WHERE `status`='1' ORDER BY `date` DESC");
            $stmt->execute();
            $i = 0;
            while($result = $stmt->fetch()){
                $return_arr[$i] = $result;
                $i++;
            }

            return $return_arr;
        }

        public function loadBoardInfo($boardID){
            $return_arr = array();
            try{
                $stmt = $this->conn->prepare("SELECT * FROM bord_items WHERE bord_id='".$boardID."'");
                $stmt->execute();
                $i = 0;
                while($result = $stmt->fetch()){
                    $return_arr[$i] = $result;
                    $i++;
                }    
            } catch(Exception $e){

            }

            return $return_arr;
        }
        
        //All insert data functions
        public function insertNewRow($boardID, $data){
            try{
                $stmt = $this->conn->prepare("INSERT INTO bord_items (`bord_id`, `desc_1`, `status`) VALUES ('".$boardID."', '".$data."', '1')");
                $stmt->execute();
                header("Location: index.php");
            } catch(Exception $e){

            }
        }
    }
?>
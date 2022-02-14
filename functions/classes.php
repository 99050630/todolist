<?php 
    class toDoList{
        //Variables
        public $conn;
        //Constructors
        function __construct($conn){
            $this->conn = $conn;
        }
        //Functions
        //All remove functions
        public function removeUser($boardId){
            try{
                $removeBoard = $this->conn->prepare("DELETE FROM bord WHERE id='".$boardId."'");
                $removeBoardItems = $this->conn->prepare("DELETE FROM bord_items WHERE bord_id='".$boardId."'");

                $removeBoard->execute();
                $removeBoardItems->execute();

                header("Location: index.php");
            }catch(Exception $e){

            }
        }
        //All update functions 
        public function updateBoard($newBoardName, $boardId, $boardItems){
            try{
                $stmt = $this->conn->prepare("UPDATE bord SET `name`='".$newBoardName."' WHERE id='".$boardId."'");
                $stmt->execute();
                // print_r($boardItems);
                $indexCount = 0;
                for($i = 0; $i < count($boardItems); $i++){
                    $getRowData = $this->conn->prepare("SELECT `id` FROM bord_items WHERE bord_id='".$boardId."' LIMIT 1 OFFSET ".$indexCount."");
                    $getRowData->execute();
                    $rowID = $getRowData->fetch();

                    $updateRowData = $this->conn->prepare("UPDATE bord_items SET desc_1='".$boardItems[$i]."' WHERE id='".$rowID['id']."'");
                    $updateRowData->execute();

                    $indexCount++;
                }

                header("Location: index.php");
            }catch(Exception $e){
                echo 'Message: ' .$e->getMessage();
            }
        }
        //All load functions
        public function loadBoard($id=""){
            $return_arr = array();
            $whereClause = "";
            if($id != ""){
                $whereClause = "AND id='".$id."'";
            }
            $stmt = $this->conn->prepare("SELECT * FROM bord WHERE `status`='1' $whereClause ORDER BY `date` DESC");
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
        public function insertNewRow($boardID, $data, $date){
            try{
                $stmt = $this->conn->prepare("INSERT INTO bord_items (`bord_id`, `desc_1`, `date`, `status`) VALUES ('".$boardID."', '".$data."', '".$date."', '1')");
                $stmt->execute();
                header("Location: index.php");
            } catch(Exception $e){

            }
        }

        //make functions
        public function makeBoard($name){
            try{
                $stmt = $this->conn->prepare("INSERT INTO bord (`name`, `date`, `status`) VALUES ('".$name."', '".date("Y-m-d")."', '1')");
                $stmt->execute();
                header("Location: index.php");
            }catch(Exception $e){
            }
        }
    }
?>
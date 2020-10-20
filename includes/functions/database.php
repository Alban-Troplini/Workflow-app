<?php 

require_once("init.php");

class Database{

public $connection;
public $db;


function __construct(){
    $this->open_db_connection();
}

public function open_db_connection(){

   // $this->connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);


    // if($this->connection->connect_errno){
    //     die("Database conection failed." . $this->connection->connect_error);
    // }
    // return $this->db;
}

public function query($sql){

    $result = $this->db->query($sql);
    $this->confirm_query($result);
    return $result;
}


private function confirm_query($result){
    
    if(!$result){
        die("Query Failed" . $this->db->error);
    }
}
 
public function escape_string($string){

 return $this->db->real_escape_string($string);

}

public function insert_id(){
    return $this->db->insert_id;
}


}

$database = new Database();   

?>
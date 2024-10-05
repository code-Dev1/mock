<?php
// namespace Database;
if(!isset($_SESSION)){
    session_start();
}


// use PDO;
// use PDOException;
class Database extends PDO{

    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $db_name = 'mock';
    private $con;
    
    public function __construct(){
        try{
            $this->con = new PDO("mysql:host=$this->host;dbname=$this->db_name",$this->username, $this->password);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }catch(PDOException $e){
            echo "We can't connect to server pleace chick the erorr and try agin later  ===>". $e->getMessage();
        }
    }
    public function __destruct(){
        $this->con = null;
    }
    public function executeStatement($sql , $params = []){
        try{
            $stmt = $this->con->prepare($sql);
            if(!empty($params)){
            foreach($params as $key => $param){
                $stmt->bindValue($key + 1, $param , PDO::PARAM_STR);
                }
            }
            $stmt->execute();
            if(str_starts_with($sql,"SELECT")){
                $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            }
            elseif(str_starts_with($sql,"SHOW")){
                $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            }else{
                $result = $stmt->rowCount();
            }
            return $result;
        }catch(PDOException $e){
            return "Server error" . $e->getMessage();
        }
    }
}
// $d = new Database();

// $sql = "SELECT * FROM users";

// $e = $d->executeStatement($sql);
// var_dump($e);

// $params = [ 
//     'admin',
//     '*4ACFE3202A5FF5CF467898FC58AAB1D615029441'
// ];
// $sql = "SELECT * FROM users WHERE user_id = ?";
// $params = [ 
//     122
// ];
<?php
class Database {

    public $con;

    public function getConnection(){

        $this->con = null;

        try{
            $this->con = new PDO('sqlite:db\sample.db');
            //$this->con = new PDO('sqlite:C:Users\Edu\sample.db');
            //$this->con = new SQLite3(__DIR__ . 'sample.db');
        }catch(PDOException $exception){
            echo "Connection error: ".$exception->getMessage();
        }

        return $this->con;
    }
   
}
?>
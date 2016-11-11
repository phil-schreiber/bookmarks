<?php
namespace bm\db;
use PDO;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PDOAdapter implements AdapterInterface {
    private $conn;
    private $dsn,$user,$password;
    public function __construct($dsn,$user,$password) {                        
        $this->dsn = $dsn;
        $this->user = $user;
        $this->password = $password;
    }
    
    public function connect(){
        
        if ($this->conn) {
            return;
        }
        
        try {
            /*Breaking DI here, but passing in the connection seem a little off*/
            $this->conn = new PDO($this->dsn, $this->user, $this->password);
            $this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }
        
    
    public function query($query,$params){        
        $result = array();
        
        $stmt = $this->conn->prepare($query);
        
        foreach($params as $key => $value){
            
            if(is_int($value)){                
                $stmt->bindParam($key, $value, \PDO::PARAM_INT);
            }else{
                $stmt->bindValue($key, $value);
            }
        }
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            array_push($result,$row);
        }
        
        return $result;
    }
    
    /*TODO implement all crud methods*/
}
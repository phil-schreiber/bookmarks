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
    public function __construct($dsn,$user,$password) {                        
        try {
            /*Breaking DI here, but passing in the connection seem a little off*/
            $this->conn = new PDO($dsn, $user, $password);
            $this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }
    
        
    
    public function query($query,$params){
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt->fetch();
    }
    
    
}
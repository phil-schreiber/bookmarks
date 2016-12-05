<?php
/**
 * Implementing DB CRUD methods for PHP's PDO.
 * 
 * PHP version 5
 * 
 * @category Class
 * @package  Bookmarks
 * @author   Philipp Schreiber <phil.schreiber@ephemeroid.net>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/phil-schreiber/bookmarks    
 */

namespace bm\db;

use PDO;

class PDOAdapter implements AdapterInterface {
    protected static $_instance = null;
    
    private $conn;
    private $dsn,$user,$password;
    
    protected function __construct($dsn,$user,$password) {                        
        $this->dsn = $dsn;
        $this->user = $user;
        $this->password = $password;
    }
    
    public function connect(){
        
        if ($this->conn) {
            return;
        }
        
        try {                    
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
        while($row = $stmt->fetch(PDO::FETCH_NAMED)){
            array_push($result,$row);
        }
        
        return $result;
    }
    
    public function insert($table,$params){
        $binds = array();
        $cols = implode(',',array_keys($params));
        $vals = implode(',:',array_keys($params));
        
        foreach($params as $key => $param){
            $binds[':'.$key]=$param;
        }
        
        $stmt = $this->conn->prepare("INSERT INTO ".$table." (".$cols.") VALUES (:".$vals.")");
        $stmt->execute($binds);
        return (int) $this->conn->lastInsertId();
    }
    
    public function update($table,$params,$uid){
        $updates = array();
        $binds = array();
        foreach($params as $key => $param){
            $updates[] = $key.' = :'.$key;
            $binds[':'.$key] = $param;
        }
        $binds[':uid'] = $uid;
        $stmt = $this->conn->prepare("UPDATE ".$table." SET ".implode(',',$updates)." WHERE uid = :uid");
        return $stmt->execute($binds);
    }
    
    public function getLastInsertId($name = null) {
        $this->connect();
        return $this->conn->lastInsertId($name);
    }
    
    public function getInstance($dsn,$user,$password){
        if (null === self::$_instance)
       {
           self::$_instance = new self($dsn,$user,$password);
       }
       return self::$_instance;
    }
    
    private function __clone() {
        
    }
}
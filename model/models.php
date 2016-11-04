<?php
namespace bm\model;

/**
 * Description of models
 *
 * @author master1
 */
class models {
    protected $table;
    protected $db;
    function __construct($db) {
        $this->db=$db;
    }
    
    public function find($params=array()){        
        $result = $this->db->getAdapter()->query("SELECT * "
                . "FROM ".$this->table." "
                . "WHERE ".$params["conditions"]."",$params["bind"]);        
        return $result;
    }
    
    public function findOneById($id){        
         $result = $this->db->getAdapter()->query("SELECT * "
                . "FROM ".$this->table." "
                . "WHERE uid = ?",array(1=>$id));        
         
        
        return $result[0];        
    }
}

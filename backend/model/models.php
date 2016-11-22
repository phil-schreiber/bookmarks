<?php
/**
 * Basic backend configuration.
 * 
 * @author  Philipp Schreiber <phil.schreiber@ephemeroid.net>   
 * @categoy interface
 * @package bookmarks 
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link    https://github.com/phil-schreiber/bookmarks
 * 
 */

namespace bm\model;

abstract class models {
    protected $_table;
    protected $_db;
    protected $_tableMm;
    protected $_tableForeign;
    
    function __construct(\bm\db\db $db) {
        $this->_db=$db;
    }
    
    public function find($params=array()){        
        $entities = array();
        $results = $this->_db->getAdapter()->query("SELECT * "
                . "FROM ".$this->_table." "
                . "WHERE ".$params["conditions"]."",$params["bind"]);        
        if($results){
            foreach($results as $result){
                $entities[]=$this->createEntity($result);
            }
        }
       
        return $entities;
    }
    
    public function findOneById($id){        
        
        $result = $this->_db->getAdapter()->query("SELECT * "
                . "FROM ".$this->_table." "
                . "WHERE uid = ?",array(1=>$id));        
         
        
        return $this->createEntity($result[0]);        
    }
    
    public function findOneByAttr($attr,$val){        
        $comp = " LIKE :";
        $bindKey = ":".$val;
        if(is_int($val)){
            $comp = " = ?";
            $bindKey = $val;
        }
        $result = $this->_db->getAdapter()->query("SELECT * "
                . "FROM ".$this->_table." "
                . "WHERE ".$attr.$comp,
                array($binKey=>$val));        
         
        
        return $this->createEntity($result[0]);        
    }
    
    public function findMM($params=array()){
        $entities = array();
        $results = $this->_db->getAdapter()->query("SELECT local.*,foreign.* "
                . "FROM ".$this->_table." AS local "
                . "LEFT JOIN ".$this->_tableMm." ON ".$this->_table.".uid = ".$this->_tableMm.".".$this->_table.".uid "
                . "LEFT JOIN ".$this->_tableForeign." AS foreign ON ".$this->_tableForeign.".uid = ".$this->_tableMm.".".$this->_tableForeign.".uid "
                . "WHERE ".$params["conditions"]."",$params["bind"]);        
        if($results){
            foreach($results as $result){
                $entities[]=$this->createEntity($result);
            }
        }
       
        return $entities;
        
    }
    
    abstract public function insert(AbstractEntity $object);
    
    
    abstract protected function createEntity(array $row);
    
    
    
}

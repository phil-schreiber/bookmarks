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
    
    abstract public function insert(AbstractEntity $object);
    
    
    abstract protected function createEntity(array $row);
    
    
    
}

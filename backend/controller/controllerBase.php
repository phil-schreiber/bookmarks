<?php
namespace bm\controller;

/**
 * Description of controllerBase
 *
 * @author master1
 */
class controllerBase {
   protected $_db;
   protected $_mappers;
   
   function __construct(\bm\db\db $db, $mappers){
        $this->_db = $db;
        $this->_mappers=$mappers;
   }
   
   
}

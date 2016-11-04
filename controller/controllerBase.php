<?php
namespace bm\controller;

/**
 * Description of controllerBase
 *
 * @author master1
 */
class controllerBase {
   protected $db;
   
   function __construct(\bm\db\db $db){
        $this->db = $db;
   }
}

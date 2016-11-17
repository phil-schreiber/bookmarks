<?php
namespace bm\db;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class db{
    protected $_adapter;
    public function __construct(AdapterInterface $adapter) {
        $this->_adapter=$adapter;
    }
    
    public function getAdapter(){
        return $this->_adapter;
    }
}


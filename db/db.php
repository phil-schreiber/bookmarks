<?php
namespace bm\db;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class db{
    protected $adapter;
    public function __construct(AdapterInterface $adapter) {
        $this->adapter=$adapter;
    }
    
    public function getDb(){
        return $this->adapter;
    }
}


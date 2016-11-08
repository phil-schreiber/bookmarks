<?php
namespace bm\model;


class bookmarksMapper extends models{
    function __construct($db) {
        parent::__construct($db);
        $this->table = 'bookmarks';
    }
    
    
    function createEntity(array $row) {
        return $row;
    }
}

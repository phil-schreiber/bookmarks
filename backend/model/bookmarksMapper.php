<?php
namespace bm\model;


class bookmarksMapper extends models{
    function __construct($db) {
        parent::__construct($db);
        $this->_table = 'bookmarks';
    }
    
    public function insert(bookmarks $bookmark){
        $this->_db->getAdapter()->insert(
                );
    }
    function createEntity(array $row) {        
        return new bookmarks(intval($row["uid"]),$row["title"],$row["url"],$row["tstamp"]);
    }
    
    
}

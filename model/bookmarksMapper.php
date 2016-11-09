<?php
namespace bm\model;


class bookmarksMapper extends models{
    function __construct($db) {
        parent::__construct($db);
        $this->_table = 'bookmarks';
    }
    
    
    function createEntity(array $row) {
    return new bookmarks($row["uid"],$row["title"],$row["url"],$row["tstamp"]);
    }
}

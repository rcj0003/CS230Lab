<?php

class PageDoesNotExistException extends Exception {}

class Paginator {
    private $pageSize;
    private $sql;
    private $table;
    private $orderField;

    function __construct($pageSize, $sql, $fieldTypes, ...$variables) {
        $this->pageSize = $pageSize;
        $this->sql = $sql;
        $this->$fieldTypes = $fieldTypes;
        $this->$variables = $variables;
    }

    function getNumberOfRecords() {
        require 'sql-helper';
        $recordCount = prepareQuery("SELECT COUNT(*) FROM (".$this->sql.") Q", $fieldTypes, ...$variables);
        return $recordCount[0];
    }

    function getPageNumber($pageNumber) {
        if ($pageNumber < 0 || $pageNumber * $this->pageSize >= $this->getNumberOfRecords()) {
            throw new PageDoesNotExistException();
        }

        $pageRecords = prepareQuery($this->sql." LIMIT ".$this.pageSize." OFFSET ".($pageNumber * $this->pageSize), $fieldTypes, ...$variables);

        return $pageRecords;
    }
}

?>
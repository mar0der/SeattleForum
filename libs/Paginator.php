<?php
class Paginator{
    private $_resultsPerPage = 10;
    private $_visiblePages = 5;
    private $_currentPage = 1;
    private $_totalResults;
    private $_totalPages;
    public function __construct() {
        
    }
    
    function getResultsPerPage() {
        return $this->_resultsPerPage;
    }

    function getVisiblePages() {
        return $this->_visiblePages;
    }

    function getCurrentPage() {
        return $this->_currentPage;
    }

    function getTotalResults() {
        return $this->_totalResults;
    }

    function getTotalPages() {
        return $this->_totalPages;
    }

    public function setResultsPerPage($resultsPerPage) {
        $this->_resultsPerPage = $resultsPerPage;
        return $this;
    }

    public function setVisiblePages($visiblePages) {
        $this->_visiblePages = $visiblePages;
        return $this;
    }

    public function setCurrentPage($currentPage) {
        $this->_currentPage = $currentPage;
        return $this;
    }

    public function setTotalResults($totalResults) {
        $this->_totalResults = $totalResults;
        return $this;
    }

    public function setTotalPages($totalPages) {
        $this->_totalPages = $totalPages;
        return $this;
    }


}

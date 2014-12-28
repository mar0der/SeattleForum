<?php

class Paginator {

    private static $instance;
    private $_resultsPerPage = 10;
    private $_currentPage = 1;
    private $_totalResults;
    private $_totalPages;
    private $_model;
    private $_method;
    private $_dataParams;
    private $_paginatorHtml = "paginator.php";
    //render settings
    private $_hasFirstBtn = false;
    private $_hasLastBtn = false;
    private $_visiblePages = 5;
    private $_linkPrefix = "";
    private $_pageLink;
    private $_firstVisiblePage = 1;
    private $_lastVisiblePage = 5;

    public function __construct() {
        
    }

    /**
     * 
     * @param Model $model
     * @param string $method model method name
     * @return type Paginator object
     */
    public static function create($model = "", $method = "") {
        if (!isset(self::$instance)) {
            self::$instance = new Paginator();
        }
        if ($model == '' or ! ($model instanceof Model)) {
            die("Paginator: no model objec was passed!");
        } else {
            self::$instance->_model = $model;
        }
        if ($method == "" or ! method_exists($model, $method)) {
            die("Paginator: No valid model method passed to \$params[\"modelMethod\"]");
        } else {
            self::$instance->_method = $method;
        }
        return self::$instance;
    }

    /**
     * @params no params required
     * @return array - the data from the model function
     */
    public function getData() {
        $this->setTotalResults();
        $this->_dataParams["getCount"] = 0;
        $this->setTotalPages();
        $this->_dataParams["resultsPerPage"] = $this->_resultsPerPage;
        $this->_dataParams["limitFirstResult"] = ((($this->_currentPage < 1) ? 1 : $this->_currentPage) - 1) * $this->_resultsPerPage;
        $model = $this->_model;
        $method = $this->_method;
        return $model->$method($this->_dataParams);
    }

    /**
     * @param no params required
     * @return void - renders the paginator html file
     */
    public function render() {
        if ($this->_totalPages < 2) {
            return "";
        }
        $paths = Config::getValue("paths");
        $paginatorFile = $paths["views"] . $this->_paginatorHtml;
        $this->hasFirstButton();
        $this->hasLastButton();
        $this->calcVisiblePages();

        if (file_exists($paginatorFile)) {
            require $paginatorFile;
        } else {
            die("Paginator: No PaginatorView file found!");
        }
    }

    /**
     * 
     * @param string $paginatorHtml
     * @return \Paginator
     */
    public function setPaginatorHtml($paginatorHtml) {
        if (!preg_match("/\.php$/", $paginatorHtml)) {
            $paginatorHtml .= ".php";
        }
        $this->_paginatorHtml = $paginatorHtml;
        return $this;
    }

    /**
     * 
     * @param array $dataParams all params required by the models data method
     * @return \Paginator
     */
    public function setDataParams($dataParams) {
        $this->_dataParams = $dataParams;
        return $this;
    }

    /**
     * 
     * @param int $resultsPerPage
     * @return \Paginator
     */
    public function setResultsPerPage($resultsPerPage) {
        $this->_resultsPerPage = $resultsPerPage;
        return $this;
    }

    /**
     * 
     * @param int $visiblePages
     * @return \Paginator
     */
    public function setVisiblePages($visiblePages) {
        $this->_visiblePages = $visiblePages;
        return $this;
    }

    /**
     * adds a prefix for index actions
     * @param string $linkPrefix
     * @return \Paginator
     */
    public function setLinkPrefix($linkPrefix) {
        $this->_linkPrefix = $linkPrefix;
        return $this;
    }

    /**
     * 
     * @param int $currentPage
     * @return \Paginator
     */
    public function setCurrentPage($currentPage) {
        $this->_currentPage = $currentPage;
        return $this;
    }

    /**
     * 
     * @param void
     * @return \Paginator
     */
    private function setTotalResults() {
        $this->_dataParams["getCount"] = 1;
        $model = $this->_model;
        $method = $this->_method;
        $this->_totalResults = $model->$method($this->_dataParams);
        return $this;
    }

    /**
     * 
     * @param void
     * @return \Paginator
     */
    private function setTotalPages() {
        if ($this->_totalResults == 0) {
            die("Paginator: No total results set");
        }
        $this->_totalPages = ceil($this->_totalResults / $this->_resultsPerPage);
        return $this;
    }

    private function hasFirstButton() {
        if ($this->_currentPage > ceil($this->_visiblePages / 2)) {
            $this->_hasFirstBtn = true;
        } else {
            $this->_hasFirstBtn = false;
        }
    }

    private function hasLastButton() {
        if ($this->_currentPage > $this->_totalPages - ceil($this->_visiblePages / 2)) {
            $this->_hasLastBtn = false;
        } else {
            $this->_hasLastBtn = true;
        }
    }

    private function calcVisiblePages() {
        if ($this->_currentPage > $this->_visiblePages - ceil($this->_visiblePages / 2)) {
            if ($this->_currentPage > $this->_totalPages - ceil($this->_visiblePages / 2)) {
                if ($this->_currentPage - $this->_visiblePages <= 0) {
                    $this->_firstVisiblePage = 1;
                } else {
                    $this->_firstVisiblePage = $this->_totalPages - $this->_visiblePages;
                }
                $this->_lastVisiblePage = $this->_totalPages;
            } else {
                $this->_firstVisiblePage = $this->_currentPage - floor($this->_visiblePages / 2);
                $this->_lastVisiblePage = $this->_currentPage + floor($this->_visiblePages / 2);
            }
        } else {
            $this->_firstVisiblePage = 1;
            if ($this->_totalPages > $this->_visiblePages) {
                $this->_lastVisiblePage = $this->_visiblePages;
            } else {
                $this->_lastVisiblePage = $this->_totalPages;
            }
        }
    }

}

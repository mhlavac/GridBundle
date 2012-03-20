<?php

namespace SoftCode\GridBundle\Paginator;

class PagePaginator
{
    /**
     * @var int
     */
    private $page = 1;

    /**
     * @var int
     */
    private $resultsPerPage = 30;

    /**
     * @var int
     */
    private $resultsCount;

    /**
     * @param int $resultsCount
     */
    public function __construct($resultsCount = 0)
    {
        $this->setResultsCount($resultsCount);
    }

    /**
     * @param int $results
     */
    public function setResultsCount($resultsCount)
    {
        $resultsCount = (int) $resultsCount;
        if($resultsCount < 0) {
            throw new \Exception('Results count can not be negative');
        }

        $this->resultsCount = $resultsCount;
        $this->checkAndFixCurrentPage();
    }

    /**
     * @param int[] $values
     */
    public function bind($values)
    {
        if(isset($values['paginator'])) {
            $paginatorValues = $values['paginator'];

            if(isset($paginatorValues['results_per_page'])){
                $this->setResultsPerPage($paginatorValues['results_per_page']);
            }

            if(isset($paginatorValues['page'])){
                $this->setPage($paginatorValues['page']);
            }
        }
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param int $page
     */
    public function setPage($page)
    {
        $page = (int) $page;
        if($page < 1) {
            $this->page = 1;
            return;
        }

        $this->page = $page;
        $this->checkAndFixCurrentPage();
    }

    /**
     * @return int
     */
    public function getTotalPages()
    {
        return ceil($this->resultsCount / $this->resultsPerPage);
    }

    /**
     * @return int
     */
    public function getResultsPerPage()
    {
        return $this->resultsPerPage;
    }

    /**
     * @param int $resultsPerPage
     */
    public function setResultsPerPage($resultsPerPage)
    {
        $resultsPerPage = (int) $resultsPerPage;
        if($resultsPerPage < 1) {
            throw new \Exception('Results per page cannot be zero or negative');
        }

        $this->resultsPerPage = $resultsPerPage;
        $this->checkAndFixCurrentPage();
    }

    /**
     * Chcecks if current page is valid, if not sets nearest possible value
     */
    private function checkAndFixCurrentPage()
    {
        $totalPages = $this->getTotalPages();
        if($this->getPage() > $totalPages)
        {
            $this->setPage($totalPages);
        }
    }

    /**
     * @return bool
     */
    public function isCurrentPageFirst()
    {
        if($this->isResultsCountZero()) {
            return true;
        }

        return $this->page == 1;
    }

    /**
     * @return bool
     */
    public function isCurrentPageLast()
    {
        if($this->isResultsCountZero()) {
            return true;
        }

        return $this->page == $this->getTotalPages();
    }

    /**
     * @return int
     */
    public function getIndexOfFirstVisibleResult()
    {
        $multiplier = $this->getPage() - 1;
        $firstResult = $multiplier * $this->getResultsPerPage();
        return $firstResult;
    }

    /**
     * @return int
     */
    public function getIndexOfLastVisibleResult()
    {
        if($this->isCurrentPageLast()) {
            return $this->resultsCount;
        }

        $multiplier = $this->getPage();
        $lastResult = $multiplier * $this->getResultsPerPage();
        return $lastResult - 1;
    }

    /**
     * @return bool
     */
    private function isResultsCountZero()
    {
        return $this->resultsCount == 0;
    }
}

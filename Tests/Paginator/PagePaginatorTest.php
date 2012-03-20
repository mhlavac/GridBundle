<?php
namespace SoftCode\GridBundle\Tests\Paginator;

use SoftCode\GridBundle\Paginator\PagePaginator;

use Symfony\Component\HttpFoundation\Request;

class PagePaginatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SoftCode\GridBundle\Paginator\PagePaginator
     */
    private $paginator;

    private $defaultPage = 1;
    private $defaultResultsPerPage = 30;
    private $defaultResultsCount = 135;

    public function setUp()
    {
        $paginator = new PagePaginator($this->defaultResultsCount);
        $paginator->setPage($this->defaultPage);
        $paginator->setResultsPerPage($this->defaultResultsPerPage);

        $this->paginator = $paginator;
    }

    public function tearDown()
    {
        unset($this->paginator);
        unset($this->defaultPage);
        unset($this->defaultResultsPerPage);
    }

    public function testConstruct()
    {
        $paginator = $this->paginator;

        $this->assertEquals($this->defaultPage, $paginator->getPage());
        $this->assertEquals($this->defaultResultsPerPage, $paginator->getResultsPerPage());
        $this->assertTrue($paginator->isCurrentPageFirst());
        $this->assertFalse($paginator->isCurrentPageLast());

        $paginator = new PagePaginator();
        $this->assertEquals(0, $paginator->getTotalPages());
    }

    public function testBind()
    {
        $bindArray = array(
            'paginator' => array(
                'page' => 2,
                'results_per_page' => 50
            )
        );

        $this->paginator->bind($bindArray);
        $this->assertEquals(2, $this->paginator->getPage());
        $this->assertEquals(50, $this->paginator->getResultsPerPage());
    }

    public function testGetPage()
    {
        $this->assertEquals($this->defaultPage, $this->paginator->getPage());

        $this->paginator->setResultsCount(0);
        $this->assertEquals(1, $this->paginator->getPage());
    }

    public function testSetPage()
    {
        for($page = 2; $page < 6; $page++) {
            $this->paginator->setPage($page);
            $this->assertEquals($page, $this->paginator->getPage());
        }
    }

    public function testSetPageSetsFirstPageIfZeroOrLowerPageGiven()
    {
        foreach(array(0, -1) as $page) {
            $this->paginator->setPage($page);
            $this->assertEquals(1, $this->paginator->getPage());
        }
    }

    public function testSetPageSetsLastPageIfPageIsGreaterThanLastPage()
    {
        $page = 6;
        $this->paginator->setPage($page);
        $this->assertEquals(5, $this->paginator->getPage());
    }

    public function testGetTotalPages()
    {
        $this->assertEquals(5, $this->paginator->getTotalPages());

        $this->paginator->setResultsCount(210);
        $this->assertEquals(7, $this->paginator->getTotalPages());

        $this->paginator->setResultsPerPage(70);
        $this->assertEquals(3, $this->paginator->getTotalPages());

        $this->paginator->setResultsCount(0);
        $this->assertEquals(0, $this->paginator->getTotalPages());
    }

    public function testGetResultsPerPage()
    {
        $this->assertEquals($this->defaultResultsPerPage, $this->paginator->getResultsPerPage());
    }

    public function testSetResultsPerPage()
    {
        $this->paginator->setResultsPerPage(50);
        $this->assertEquals(50, $this->paginator->getResultsPerPage());

        $this->paginator->setPage(3);
        $this->paginator->setResultsPerPage(200);
        $this->assertEquals(1, $this->paginator->getPage());
    }

    public function testSetResultsPerPageThrowsExceptionIfZeroOrNegativeNumberGiven()
    {
        try{
            $this->paginator->setResultsPerPage(0);
            $this->assertTrue(false);
        } catch(\Exception $e) {
            $this->assertTrue(true);
        }

        try{
            $this->paginator->setResultsPerPage(-1);
            $this->assertTrue(false);
        } catch(\Exception $e) {
            $this->assertTrue(true);
        }
    }

    public function testSetResultsCount()
    {
        $this->paginator->setResultsPerPage(1);
        $this->paginator->setResultsCount(10);
        $this->assertEquals(10, $this->paginator->getTotalPages());

        $this->paginator->setResultsCount(0);
        $this->assertEquals(0, $this->paginator->getTotalPages());
    }

    public function testSetResultsCountThrowsExceptionIfNegativeNumberGiven()
    {
        try{
            $this->paginator->setResultsCount(-1);
            $this->assertTrue(false);
        } catch(\Exception $e) {
            $this->assertTrue(true);
        }
    }

    public function testIsCurrentPageFirst()
    {
        $this->assertTrue($this->paginator->isCurrentPageFirst());

        $this->paginator->setPage(2);
        $this->assertFalse($this->paginator->isCurrentPageFirst());

        $this->paginator->setResultsCount(0);
        $this->assertTrue($this->paginator->isCurrentPageFirst());
    }

    public function testIsCurrentPageLast()
    {
        $this->assertFalse($this->paginator->isCurrentPageLast());

        $this->paginator->setPage(5);
        $this->assertTrue($this->paginator->isCurrentPageLast());

        $this->paginator->setResultsCount(0);
        $this->assertTrue($this->paginator->isCurrentPageLast());
    }

    public function testGetIndexOfFirstVisibleResult()
    {
        $this->assertEquals(0, $this->paginator->getIndexOfFirstVisibleResult());

        $this->paginator->setPage(2);
        $this->assertEquals(30, $this->paginator->getIndexOfFirstVisibleResult());

        $this->paginator->setResultsPerPage(120);
        $this->assertEquals(120, $this->paginator->getIndexOfFirstVisibleResult());

        $this->paginator->setResultsPerPage(140);
        $this->assertEquals(0, $this->paginator->getIndexOfFirstVisibleResult());
    }

    public function testGetIndexOfLastVisibleResult()
    {
        $this->assertEquals(29, $this->paginator->getIndexOfLastVisibleResult());

        $this->paginator->setPage(5);
        $this->assertEquals($this->defaultResultsCount, $this->paginator->getIndexOfLastVisibleResult());
    }
}
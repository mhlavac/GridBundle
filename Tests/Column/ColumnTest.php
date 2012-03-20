<?php

namespace SoftCode\GridBundle\Tests\Column;

use SoftCode\GridBundle\Column\Column;

class ColumnTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Column
     */
    private $column;

    public function setUp()
    {
        $this->column = $this->createColumn('test');
    }

    /**
     * @return Column
     */
    protected function createColumn($name)
    {
        return new Column($name);
    }

    /**
     * @return Column
     */
    protected function getColumn()
    {
        return $this->column;
    }

    public function testConstruct()
    {
        $this->assertEquals('test', $this->column->getName());
        $this->assertEquals(false, $this->column->isPrimaryColumn());
    }

    public function testGetName()
    {
        $this->assertEquals('test', $this->column->getName());
    }

    public function testSetName()
    {
        $this->column->setName('abc');

        $this->assertEquals('abc', $this->column->getName());
    }

    public function testIsPrimaryColumn()
    {
        $this->assertEquals(false, $this->column->isPrimaryColumn());
    }

    public function testSetPrimaryColumn()
    {
        $this->column->setPrimaryColumn(true);
        $this->assertEquals(true, $this->column->isPrimaryColumn());

        $this->column->setPrimaryColumn(false);
        $this->assertEquals(false, $this->column->isPrimaryColumn());
    }

    public function testFormat()
    {
        $this->assertEquals('test', $this->column->format('test'));
    }
}
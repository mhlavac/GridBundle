<?php

namespace SoftCode\GridBundle\Tests\Column;

use SoftCode\GridBundle\Column\StateColumn;

class StateColumnTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var StateColumn
     */
    private $column;

    private $testStates = array(
        true  => 'Yes',
        false => 'No'
    );

    public function setUp()
    {
        $this->column = new StateColumn('test', $this->testStates);
    }

    public function testConstruct()
    {
        $this->assertEquals('test', $this->column->getName());
        $this->assertEquals($this->testStates, $this->column->getStates());
    }

    public function testSetStates()
    {
        $column = $this->column;
        $column->setStates(array());

        $this->assertEquals(0, count($column->getStates()));

        $column->setStates($this->testStates);
        $states = $column->getStates();

        $this->assertTrue(isset($states[true]));
        $this->assertTrue(isset($states[false]));
    }

    public function testAddState()
    {
        $this->column->addState('hello', 'ahoj');
        $this->column->addState('world', 'cau');

        $states = $this->column->getStates();
        $this->assertEquals('ahoj', $states['hello']);
        $this->assertEquals('cau', $states['world']);
    }

    public function testGetStates()
    {
        $this->assertEquals($this->testStates, $this->column->getStates());
    }

    public function testFormat()
    {
        $this->assertEquals('Yes', $this->column->format(true));
        $this->assertEquals('No', $this->column->format(false));
    }

    /**
     * @expectedException        SoftCode\GridBundle\Column\Exception\StateNotDefinedException
     * @expectedExceptionMessage Given state "iDoNotExist" is not defined.
     */
    public function testFormatThrowsExceptionIfGivenStateIsNotSet()
    {
        $this->column->format('iDoNotExist');
    }
}
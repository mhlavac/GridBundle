<?php

namespace SoftCode\GridBundle\Tests\Column;

use SoftCode\GridBundle\Column\IntColumn;

class IntColumnTest extends \PHPUnit_Framework_TestCase
{
    public function testFormat()
    {
        $column = new IntColumn('test');

        $this->assertEquals(1, $column->format(1));
        $this->assertEquals(-1, $column->format(-1));

        $this->assertEquals(0, $column->format(false));
        $this->assertEquals(1, $column->format(true));

        $this->assertEquals(0, $column->format('test'));

        $this->assertEquals(0, $column->format(array()));

        $this->assertEquals(3, $column->format(3.14));
    }
}
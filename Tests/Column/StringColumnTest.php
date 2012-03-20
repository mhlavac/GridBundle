<?php

namespace SoftCode\GridBundle\Tests\Column;

use SoftCode\GridBundle\Column\StringColumn;

class StringColumnTest extends \PHPUnit_Framework_TestCase
{
    public function testFormat()
    {
        $column = new StringColumn('test');

        $this->assertInternalType('string', $column->format('test'));
        $this->assertInternalType('string', $column->format(1));
        $this->assertInternalType('string', $column->format(3.14));
    }
}
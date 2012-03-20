<?php

namespace SoftCode\GridBundle\Tests\Column;

use SoftCode\GridBundle\Column\DumpColumn;

class DumpColumnTest extends ColumnTest
{
    protected function createColumn($name)
    {
        return new DumpColumn($name);
    }

    public function testConstructDefaultEncaseValueIsTrue()
    {
        $this->assertEquals(true, $this->getColumn()->getEncaseWithPre());
    }

    public function testSetEncaseWithPre()
    {
        $column = $this->getColumn();

        $column->setEncaseWithPre(false);
        $this->assertEquals(false, $column->getEncaseWithPre());

        $column->setEncaseWithPre(true);
        $this->assertEquals(true, $column->getEncaseWithPre());

        $column->setEncaseWithPre(3);
        $this->assertEquals(true, $column->getEncaseWithPre());
    }

    public function testFormat()
    {
        $this->formatWithPreEncase();
        $this->formatWithoutPreEncase();
    }

    public function formatWithPreEncase()
    {
        $this->getColumn()->setEncaseWithPre(true);

        $formattedString = $this->getColumn()->format('test');

        $this->assertStringStartsWith('<pre>', $formattedString);
        $this->assertStringEndsWith('</pre>', $formattedString);
    }

    public function formatWithoutPreEncase()
    {
        $this->getColumn()->setEncaseWithPre(false);

        $formattedString = $this->getColumn()->format('test');

        $this->assertStringStartsNotWith('<pre>', $formattedString);
        $this->assertStringEndsNotWith('</pre>', $formattedString);
    }
}
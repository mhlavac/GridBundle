<?php

/**
 *
 * Column renders value as it is wihout any modifications
 * @author mhlavac
 *
 */

namespace SoftCode\GridBundle\Column;

class Column
{
    /**
     * Name of the column
     * @var string
     */
    private $name;

    /**
     * Primary columns are useful to identify rows in the grid
     * values of these cells are then used in generated links
     * @var bool
     */
    private $primaryColumn;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->setName($name);
        $this->primaryColumn = false;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param bool $primary
     */
    public function setPrimaryColumn($primaryColumn)
    {
        $this->primaryColumn = $primaryColumn == true;
    }

    /**
     * @return bool
     */
    public function isPrimaryColumn()
    {
        return $this->primaryColumn;
    }

    /**
     * Formats value with columns formatter and then returns it
     * @return string
     */
    public function format($value)
    {
        return $value;
    }
}
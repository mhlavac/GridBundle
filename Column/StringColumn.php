<?php

namespace SoftCode\GridBundle\Column;

/**
 *
 * String grid column
 * Renders given value in string format.
 * Formated examples:
 *     test
 *     another string
 *     5 is more than 3
 * @author Martin Hlaváč
 *
 */

class StringColumn extends Column
{
    public function format($value)
    {
        return (string)$value;
    }
}

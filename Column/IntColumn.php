<?php

namespace SoftCode\GridBundle\Column;

/**
 *
 * Integer grid column
 * Renders given value in integer format. Strips floating numbers.
 * Formated examples:
 *     -3
 *     0
 *     3
 * @author Martin Hlaváč
 *
 */
class IntColumn extends Column
{
    public function format($value)
    {
        return (int) $value;
    }
}

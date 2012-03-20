<?php

/**
 *
 * Exception for StateColumn
 * @author mhlavac
 *
 */

namespace SoftCode\GridBundle\Column\Exception;

class StateNotDefinedException extends \Exception
{
    /**
     * @param string $state
     */
    public function __construct($state)
    {
        parent::__construct('Given state "' . $state . '" is not defined.', 0);
    }
}
<?php

/**
 *
 * StateColumn is used for enumartion values. It autumatically sets value
 * of column basen on cells real value
 * @author mhlavac
 *
 */

namespace SoftCode\GridBundle\Column;

use SoftCode\GridBundle\Column\Exception\StateNotDefinedException;

class StateColumn extends Column
{
    /**
     * @var array
     */
    private $states;

    /**
     * @param string $name
     * @param array $states
     */
    public function __construct($name, array $states)
    {
        parent::__construct($name);
        $this->setStates($states);
    }

    /**
     * @param array $states
     */
    public function setStates(array $states)
    {
        $this->states = $states;
    }

    /**
     * @param string $name
     * @param string $value
     */
    public function addState($name, $value)
    {
        $this->states[$name] = $value;
    }

    /**
     * @return array
     */
    public function getStates()
    {
        return $this->states;
    }

    /**
     * @throws StateNotDefinedException If given state is not defined
     *
     * @param string $value
     * @return string
     */
    public function format($value)
    {
        if(isset($this->states[$value])) {
            return $this->states[$value];
        }

        throw new StateNotDefinedException($value);
    }
}
<?php

namespace SoftCode\GridBundle\Column;

/**
 *
 * Dump grid column
 * Renders given value in var_dumped format.
 * Formated examples:
 *     {1,2,3,4}
 * @author Martin Hlaváč
 *
 */
class DumpColumn extends Column
{
    /**
     * @var bool
     */
    private $encaseWithPre;

    /**
     * @param string $name
     * @param bool $encaseWithPre
     */
    public function __construct($name, $encaseWithPre = true)
    {
        parent::__construct($name);

        $this->setEncaseWithPre($encaseWithPre);
    }

    public function getEncaseWithPre()
    {
        return $this->encaseWithPre;
    }

    public function setEncaseWithPre($encaseWithPre = true)
    {
        $this->encaseWithPre = $encaseWithPre == true;
    }

    public function format($value)
    {
        $dump = print_r($value, true);
        if ($this->encaseWithPre) {
            $dump = '<pre>' . $dump . '</pre>';
        }

        return $dump;
    }
}

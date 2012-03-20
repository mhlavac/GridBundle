<?php

/**
 *
 * @author Martin Hlaváč
 *
 */

namespace SoftCode\GridBundle\Tests;

use SoftCode\GridBundle\HtmlElement;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function testRolesAsString()
    {
        $htmlElement = new HtmlElement('a');
        $xml = simplexml_load_string($htmlElement);
    }
}

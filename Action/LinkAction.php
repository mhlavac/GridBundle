<?php
namespace SoftCode\GridBundle\Action;

use SoftCode\GridBundle\HtmlElement;

/**
 * Grid link action
 * @author mhlavac
 */
class LinkAction
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $link;

    /**
     * @var array
     */
    private $params;

    /**
     * @param string $name Action name
     * @param string $link Href of an A element
     * @param array $tagAttributes html element attributes
     *
     * @throws \InvalidArgumentException If name or link is not given
     */
    public function __construct($name, $link, array $params = array())
    {
        $this->setName($name);
        $this->setLink($link);
        $this->params = $params;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return 'link';
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
     *
     * @throws \InvalidArgumentException If name or link is not given
     */
    public function setName($name)
    {
        if (!is_string($name) || !$name) {
            throw new \InvalidArgumentException('Argument name is invalid');
        }

        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param string $link
     *
     * @throws \InvalidArgumentException If name or link is not given
     */
    public function setLink($link)
    {
        if (!is_string($link)) {
            throw new \InvalidArgumentException('Argument link is not string');
        }

        $this->link = $link;
    }

    /**
     * @return string
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param array $params
     */
    public function setParams(array $params)
    {
        $this->params = $params;
    }
}
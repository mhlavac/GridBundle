<?php
namespace SoftCode\GridBundle\Action\Row;
use SoftCode\GridBundle\Action\LinkAction;

/**
 * @author mhlavac
 */
class LinkRowAction extends LinkAction
{
    /**
     * @param  mixed $id
     * @return string
     */
    public function getBuildLink($id)
    {
        return '<a href="' . str_replace('{id}', $id, $this->getLink()) . '">' . $this->getName() . '</a>';
    }
}

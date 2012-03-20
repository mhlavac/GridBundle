<?php
namespace SoftCode\GridBundle\Renderer;

use SoftCode\GridBundle\Grid;

/**
 *
 * @author Martin Hlaváč
 *
 */
class TableRenderer extends AbstractRenderer
{
    public function render(Grid $grid, $serviceId = null)
    {
        $count = $grid->getCount();
        $grid->getPaginator()->setResultsCount($count);

        return $this->getTemplating()->render('SoftCodeGridBundle:Renderer:table.html.twig', array('grid' => $grid, 'service_id' => $serviceId));
    }
}
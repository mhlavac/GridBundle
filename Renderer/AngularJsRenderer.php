<?php
namespace SoftCode\GridBundle\Renderer;

use SoftCode\GridBundle\Grid;

class AngularJsRenderer extends TableRenderer
{
    public function render(Grid $grid, $serviceId = null)
    {
        return $this->getTemplating()->render('SoftCodeGridBundle:Renderer:angularjs.html.twig', array(
            'grid'       => $grid,
            'service_id' => $serviceId
        ));
    }
}

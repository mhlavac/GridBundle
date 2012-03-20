<?php

/**
 *
 * Abstract for grid renderers
 * @author mhlavac
 *
 */

namespace SoftCode\GridBundle\Renderer;

use SoftCode\GridBundle\Grid;

abstract class AbstractRenderer
{
    /**
     * @var \Twig_Environment
     */
    private $templating;

    /**
     * @param Grid $grid
     * @param string $serviceId
     * @return mixed
     */
    abstract public function render(Grid $grid, $serviceId = null);

    /**
     * @param \Twig_Environment $templating
     */
    public function setTemplating(\Twig_Environment $templating)
    {
        $this->templating = $templating;
    }

    /**
     * @return \Twig_Environment
     */
    public function getTemplating()
    {
        return $this->templating;
    }

    /**
     * @param Grid $grid
     * @return string[]
     */
    protected function renderActions(Grid $grid)
    {
        $template = $this->templating->loadTemplate('SoftCodeGridBundle:Action:link.html.twig');

        $renderedActions = array();
        foreach ($grid->getActions() as $action) {
            $renderedActions[$action->getName()] = $template->renderBlock($action->getType(), array('action' => $action));
        }

        return $renderedActions;
    }
}
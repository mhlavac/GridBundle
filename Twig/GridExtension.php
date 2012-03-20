<?php
namespace SoftCode\GridBundle\Twig;

/**
 * @author mhlavac
 */
class GridExtension extends \Twig_Extension
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;

    /**
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $serviceContainer
     */
    public function __construct(\Symfony\Component\DependencyInjection\ContainerInterface $serviceContainer)
    {
        $this->container = $serviceContainer;
    }

    /**
     * @param string $rendererId Renderer service
     * @param string $gridId Grid service
     */
    public function renderGrid($rendererId, $gridId)
    {
        $renderer = $this->getRenderer($rendererId);
        $grid     = $this->getGrid($gridId);

        $request = $this->getRequest();
        $grid->bindRequest($request);

        return $renderer->render($grid, $gridId);
    }

    /**
     * @param string $rendererId
     * @return SoftCode\GridBundle\Renderer\TableRenderer
     */
    private function getRenderer($rendererId)
    {
        $rendererId = 'grid.renderer.' . $rendererId;
        $renderer   = $this->container->get($rendererId);

        return $renderer;
    }

    /**
     * @param string $gridId
     * @return SoftCode\GridBundle\Grid
     */
    private function getGrid($gridId)
    {
        $grid = $this->container->get($gridId);

        return $grid;
    }

    public function getName()
    {
        return 'softcodegridbundle.grid_extension';
    }

    public function getFunctions()
    {
        return array(
            'grid' => new \Twig_Function_Method($this, 'renderGrid')
        );
    }

    /**
     * @return \Symfony\Component\BrowserKit\Request
     */
    public function getRequest()
    {
        return $this->container->get('request');
    }
}
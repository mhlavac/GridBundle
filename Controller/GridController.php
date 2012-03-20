<?php
namespace SoftCode\GridBundle\Controller;

use FOS\RestBundle\View\View;

use Symfony\Component\BrowserKit\Response;
use SoftCode\GridBundle\Renderer\ArrayRenderer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GridController extends Controller
{
    public function gridAction($serviceId)
    {
        $grid = $this->get($serviceId);

        $array = $this->get('grid.renderer.array')->render($grid);

        $view = View::create()
            ->setStatusCode(200)
            ->setData($array)
            ->setFormat('json')
        ;

        return $this->get('fos_rest.view_handler')->handle($view);
    }
}
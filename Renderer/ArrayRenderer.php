<?php
namespace SoftCode\GridBundle\Renderer;

use SoftCode\GridBundle\Grid;

/**
 *
 * Array grid renderer is used to output grid as an array
 * @author mhlavac
 *
 */
class ArrayRenderer extends AbstractRenderer
{
    /**
     * @var Grid
     */
    private $grid;

    public function render(Grid $grid, $serviceId = null)
    {
        $this->grid = $grid;

        $array = array(
            'paginator'  => $this->getPaginatorArray($grid),
            'data'       => $grid->getData(),
            'actions'    => $this->renderActions($grid),
            'columns'    => $this->getColumns($grid),
            'service_id' => $serviceId,
            'name'       => $grid->getName(),
            'totalCount' => $grid->getTotalCount()
        );

        return $array;
    }

    /**
     * @param Grid $grid
     * @return array
     */
    private function getPaginatorArray(Grid $grid)
    {
        $paginator = $grid->getPaginator();

        return array(
            'page'             => $paginator->getPage(),
            'total_pages'      => $paginator->getTotalPages(),
            'results_per_page' => $paginator->getResultsPerPage(),
            'results_count'    => $paginator->getResultsPerPage()
        );
    }

    /**
     * @param Grid $grid
     * @return array
     */
    private function getColumns(Grid $grid)
    {
        $columns = array();
        foreach ($grid->getColumns() as $column) {
            $columns[] = $column->getName();
        }

        return $columns;
    }
}
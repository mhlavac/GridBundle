<?php
namespace SoftCode\GridBundle;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;
use SoftCode\GridBundle\Column\Column;
use SoftCode\GridBundle\Action\Row\LinkRowAction;
use SoftCode\GridBundle\Action\LinkAction;
use SoftCode\GridBundle\Paginator\PagePaginator;

/**
 * @author mhlavac
 */
abstract class Grid extends ContainerAware
{
    /**
     * @var \SoftCode\GridBundle\DataSource\DataSourceInterface
     */
    private $dataSource;

    /**
     * @var Column[]
     */
    private $columns;

    /**
     * @var LinkAction[]
     */
    private $actions;

    /**
     * @var LinkRowAction[]
     */
    private $rowActions;

    /**
     * @var PagePaginator
     */
    private $paginator;

    /**
     * You have to override this method to let your templates know grid's name
     *
     * @return string
     */
    public abstract function getName();

    /**
     * @return \SoftCode\GridBundle\DataSource\DataSourceInterface
     */
    public function getDataSrouce()
    {
        return $this->dataSource;
    }

    /**
     * @param \SoftCode\GridBundle\DataSource\DataSourceInterface $dataSource
     */
    public function setDataSource($dataSource)
    {
        $this->dataSource = $dataSource;
    }

    /**
     * @return \SoftCode\GridBundle\Paginator\PagePaginator
     */
    public function getPaginator()
    {
        return $this->paginator;
    }

    /**
     * @param PagePaginator $paginator
     */
    public function setPaginator(PagePaginator $paginator)
    {
        $this->paginator = $paginator;
    }

    /**
     * Initializes grid from binded request.
     * @param Symfony\Component\HttpFoundation\Request $request
     */
    public function bindRequest(Request $request)
    {
        $this->bindArray($request->get('grid'));
    }

    /**
     * Initializes grid from binded data. Data are given as an array
     * @param array $values
     */
    public function bindArray($values)
    {
        $this->paginator->bind($values);
    }

    /**
     * Returns all grid params
     * @return array
     */
    public function getParams()
    {
        $params = array(
            'paginator' => $this->paginator,
            'data' => $this->getData(),
            'actions' => $this->actions,
            'columns' => $this->columns,
            'rowActions' => $this->rowActions,
            'name' => $this->getName(),
        );

        return $params;
    }

    /**
     * @return array
     */
    public function getData()
    {
        $rawData = $this->getRawData();
        $data    = array();

        foreach ($rawData as $id => $rawRow) {
            $row = array();

            foreach ($this->getColumns() as $columnName => $column) {
                if ($columnName == '_actions') {
                    continue;
                }
                $row[$columnName] = $column->format($rawRow[$columnName]);
            }

            if (isset($this->columns['_actions'])) {
                $rowActions = array();
                foreach ($this->rowActions as $rowAction) {
                    $rowActions[] = $rowAction->getBuildLink($id);
                }
                $row['_actions'] = implode(' ', $rowActions);
            }

            $data[] = $row;
        }

        return $data;
    }

    /**
     * @return array All data frow data source
     */
    public function getRawData()
    {
        $offset = $this->paginator->getIndexOfFirstVisibleResult();
        $limit = $this->paginator->getResultsPerPage();

        return $this->dataSource->getData($offset, $limit);
    }

    /**
     * Returns number of filtered data rows
     * @return int
     */
    public function getCount()
    {
        return $this->dataSource->getCount();
    }

    /**
     * Returns number of all data rows
     * @return int
     */
    public function getTotalCount()
    {
        return $this->dataSource->getTotalCount();
    }

    /**
     * @return Column[]
     */
    public function getColumns()
    {
        if (count($this->rowActions) > 0 && !isset($this->columns['_actions'])) {
            $this->addColumn(new Column('_actions'));
        }

        return $this->columns;
    }

    /**
     * Adds new column
     * @param Column $column
     * @param bool $primary Defines if the column should be used as a primary identificator for row
     */
    public function addColumn(Column $column, $primary = false)
    {
        $column->setPrimaryColumn($primary);
        $this->columns[$column->getName()] = $column;
    }

    /**
     * @return LinkAction[]
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * Adds new action
     * @param LinkAction $action
     */
    public function addAction(LinkAction $action)
    {
        $name = $action->getName();

        $this->actions[$name] = $action;
    }

    /**
     * @param LinkRowAction[]
     */
    public function getRowActions()
    {
        return $this->rowActions;
    }

    /**
     * @param LinkRowAction $rowAction
     */
    public function addRowAction(LinkRowAction $rowAction)
    {
        $this->rowActions[$rowAction->getName()] = $rowAction;
    }
}

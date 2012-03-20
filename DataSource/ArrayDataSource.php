<?php
namespace SoftCode\GridBundle\DataSource;

// TODO UnitTesty + Dodelat + Dokumentace
class ArrayDataSource implements DataSourceInterface
{
    /**
     * @var array
     */
    private $data;

    /**
     * @param array $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getData($offset = 0, $length = 30, $filters = null)
    {
        return $this->data;
    }

    public function getCount()
    {
        return $this->getTotalCount();
    }

    public function getTotalCount()
    {
        return 0;
    }
}

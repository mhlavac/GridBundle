<?php

namespace SoftCode\GridBundle\DataSource;

/**
 *
 * DataSource Interface is used to implement grid's data gathering methods
 * @author Martin Hlaváč
 *
 */
interface DataSourceInterface
{
    /**
     * Gets list of data used by grid
     * @param int $offset
     * @param int $length
     * @param Fitler[] $filters
     * @return array
     */
    public function getData($offset = 0, $length = 30, $filters = null);

    /**
     * Gets count of filtered items
     * @return int
     */
    public function getCount();

    /**
     * Gets count of all items
     * @return int
     */
    public function getTotalCount();
}
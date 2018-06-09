<?php

namespace DRD\DatabaseBundle\Repository;

class TotalCountList extends SimpleList implements TotalCountListInterface
{
    /**
     * @var integer
     */
    private $totalCount;

    /**
     * @param array $list
     */
    public function __construct(array $list, int $totalCount)
    {
        parent::__construct($list);

        $this->totalCount = $totalCount;
    }

    /**
     * @return int
     */
    public function getTotalCount(): int
    {
        return $this->totalCount;
    }
}

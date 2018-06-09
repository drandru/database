<?php

namespace DRD\DatabaseBundle\Repository;

interface TotalCountListInterface extends SimpleListInterface
{
    /**
     * @return integer
     */
    public function getTotalCount(): int;
}

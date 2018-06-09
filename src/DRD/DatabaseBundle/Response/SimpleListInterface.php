<?php

namespace DRD\DatabaseBundle\Repository;

use DRD\DatabaseBundle\Entity\EntityInterface;

interface SimpleListInterface
{
    /**
     * @return EntityInterface[]
     */
    public function getList(): array;
}

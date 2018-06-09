<?php

namespace  DRD\DatabaseBundle\Repository;

use Doctrine\Common\Persistence\ObjectRepository;
use DRD\DatabaseBundle\Entity\EntityInterface;

interface TotalCountRepositoryInterface
{
    /**
     * @param string $builderName
     * @param string|array $fields
     * @param int $perPage
     * @param int $offset
     * @param array $where
     * @param array $sort
     * @return TotalCountListInterface
     */
    public function findList($builderName, $fields, int $perPage, int $offset, array $where = [], array $sort = []);

    /**
     * @param string $builderName
     * @param string|array $fields
     * @param int $perPage
     * @param int $offset
     * @param array|null $where
     * @param array $sort
     * @return TotalCountListInterface
     */
    public function findObjectList($builderName, $fields, int $perPage, int $offset, array $where = [], array $sort = []);
}

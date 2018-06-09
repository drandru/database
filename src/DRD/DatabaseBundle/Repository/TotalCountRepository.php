<?php

namespace  DRD\DatabaseBundle\Repository;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query;
use DRD\DatabaseBundle\Entity\EntityInterface;

class TotalCountRepository extends Repository
{
    /**
     * @param string $builderName
     * @param array|string $fields
     * @param int $perPage
     * @param int $offset
     * @param array|null $where
     * @param array $sort
     * @return SimpleListInterface
     */
    public function findList($builderName, $fields, int $perPage, int $offset, array $where = null, array $sort = [])
    {
        $query = $this->getFilledQuery($builderName, $perPage, $offset, (array) $where);

        $all = $query->select("count($builderName.id)")->getQuery()->getSingleScalarResult();

        $query = $this->addSort($query, $sort);

        $result = (array) $query->select($fields)->getQuery()->getResult(Query::HYDRATE_ARRAY);

        $result = $this->combineResult($result);

        return new TotalCountList($result, $all);
    }

    /**
     * @param string $builderName
     * @param array|string $fields
     * @param int $perPage
     * @param int $offset
     * @param array|null $where
     * @param array $sort
     * @return SimpleList
     */
    public function findObjectList($builderName, $fields, int $perPage, int $offset, array $where = null, array $sort = [])
    {
        $query = $this->getFilledQuery($builderName, $perPage, $offset, (array) $where);

        $all = $query->select("count($builderName.id)")->getQuery()->getSingleScalarResult();

        $query = $this->addSort($query, $sort);

        $result = $query->select($fields)->getQuery()->getResult();

        return new TotalCountList($result, $all);
    }
}

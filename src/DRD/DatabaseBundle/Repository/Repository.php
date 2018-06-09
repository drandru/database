<?php

namespace  DRD\DatabaseBundle\Repository;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query;
use DRD\DatabaseBundle\Entity\EntityInterface;

class Repository implements RepositoryInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $em = null;

    /**
     * @var string
     */
    private $className = '';

    /**
     * Repository constructor.
     * @param EntityManagerInterface $em
     * @param string $className
     */
    public function __construct(EntityManagerInterface $em, string $className)
    {
        $this->em = $em;
        $this->className = $className;
    }

    /**
     * @param $id
     * @return object
     */
    public function findById($id)
    {
        return $this->em->find($this->className, $id);
    }

    /**
     * @param EntityInterface $entity
     * @return int
     */
    public function save(EntityInterface $entity)
    {
        $this->em->persist($entity);

        return $entity->getId();
    }

    /**
     * @param EntityInterface $entity
     * @return int
     */
    public function saveImmediately(EntityInterface $entity)
    {
        $this->save($entity);

        $this->em->flush();

        return $entity->getId();
    }

    /**
     * @param EntityInterface $entity
     * @return int
     */
    public function delete(EntityInterface $entity)
    {
        $this->em->remove($entity);

        return true;
    }

    /**
     * @param EntityInterface $entity
     * @return int
     */
    public function deleteImmediately(EntityInterface $entity)
    {
        $this->delete($entity);

        $this->em->flush();

        return true;
    }

    /**
     * @return ObjectRepository
     */
    public function getRepository()
    {
        return $this->em->getRepository($this->className);
    }

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

        $query = $this->addSort($query, $sort);

        $result = (array) $query->select($fields)->getQuery()->getResult(Query::HYDRATE_ARRAY);

        $result = $this->combineResult($result);

        return new SimpleList($result);
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

        $query = $this->addSort($query, $sort);

        $result = $query->select($fields)->getQuery()->getResult();

        return new SimpleList($result);
    }

    /**
     * @return EntityManagerInterface
     */
    private function getEntityManager():ObjectRepository
    {
        return $this->em->getRepository($this->className);
    }

    /**
     * @param array $result
     * @return array
     */
    protected function combineResult(array $result)
    {
        $newResult = [];
        foreach ($result as $item) {
            if (!empty($item[0])) {
                $i = $item[0];
                unset($item[0]);
                $newResult[] = array_merge(
                    $item,
                    $i
                );
            } else {
                $newResult[] = $item;
            }
        }

        return $newResult;
    }

    /**
     * @param string $builderName
     * @param int $perPage
     * @param int $offset
     * @param array $where
     * @return QueryBuilder
     */
    protected function getFilledQuery(string $builderName, int $perPage, int $offset, array $where): QueryBuilder
    {
        /** @var QueryBuilder $query */
        $query = $this->getEntityManager()->createQueryBuilder($builderName);

        $query
            ->setMaxResults($perPage)
            ->setFirstResult($offset)
        ;

        if ($where) {
            foreach ($where as $key => $values) {
                $query->where($key);
                foreach ($values as $valueKey => $value) {
                    $query->setParameter($valueKey, $value);
                }
            }
        }

        return $query;
    }

    /**
     * @param QueryBuilder $query
     * @param array $sort
     * @return QueryBuilder
     */
    protected function addSort(QueryBuilder $query, array $sort): QueryBuilder
    {
        if ($sort) {
            foreach ($sort as $field) {
                $query->orderBy($field[0], $field[1]);
            }
        }

        return $query;
    }
}

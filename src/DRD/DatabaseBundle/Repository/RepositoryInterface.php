<?php

namespace  DRD\DatabaseBundle\Repository;

use Doctrine\Common\Persistence\ObjectRepository;
use DRD\DatabaseBundle\Entity\EntityInterface;

interface RepositoryInterface
{
    /**
     * @param $id
     * @return EntityInterface
     */
    public function findById($id);

    /**
     * @param EntityInterface $entity
     * @return int
     */
    public function save(EntityInterface $entity);

    /**
     * @param EntityInterface $entity
     * @return int
     */
    public function saveImmediately(EntityInterface $entity);

    /**
     * @param EntityInterface $entity
     * @return int
     */
    public function delete(EntityInterface $entity);

    /**
     * @param EntityInterface $entity
     * @return int
     */
    public function deleteImmediately(EntityInterface $entity);

    /**
     * @return ObjectRepository
     */
    public function getRepository();

    /**
     * @param string $builderName
     * @param string|array $fields
     * @param int $perPage
     * @param int $offset
     * @param array|null $where
     * @param array $sort
     * @return SimpleListInterface
     */
    public function findList($builderName, $fields, $perPage, $offset, array $where = null, array $sort = []);

    /**
     * @param string $builderName
     * @param string|array $fields
     * @param int $perPage
     * @param int $offset
     * @param array|null $where
     * @param array $sort
     * @return SimpleListInterface
     */
    public function findObjectList($builderName, $fields, $perPage, $offset, array $where = null, array $sort = []);
}

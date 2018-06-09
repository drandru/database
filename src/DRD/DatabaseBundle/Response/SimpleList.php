<?php

namespace DRD\DatabaseBundle\Repository;

use DRD\DatabaseBundle\Entity\EntityInterface;

class SimpleList implements SimpleListInterface
{
    /**
     * @var EntityInterface[]
     */
    private $list;

    /**
     * @param array $list
     */
    public function __construct(array $list)
    {
        foreach ($list as $entity) {
            $this->add($entity);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getList(): array
    {
        return $this->list;
    }

    /**
     * @param EntityInterface $entity
     * @return $this
     */
    private function add(EntityInterface $entity)
    {
        $this->list[] = $entity;

        return $this;
    }
}

<?php

namespace DRD\DatabaseBundle\Entity\Transformer;

use DRD\DatabaseBundle\Entity\EntityInterface;

interface FromArrayToEntity
{
    /**
     * @param array $data
     * @return EntityInterface
     */
    public function transform(array $data): EntityInterface;
}

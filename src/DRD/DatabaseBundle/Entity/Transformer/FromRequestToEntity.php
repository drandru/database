<?php

namespace DRD\DatabaseBundle\Entity\Transformer;

use DRD\DatabaseBundle\Entity\EntityInterface;
use DRD\GeneralBundle\Request\RequestInterface;

interface FromRequestToEntity
{
    /**
     * @param RequestInterface $request
     * @return EntityInterface
     */
    public function transform(RequestInterface $request): EntityInterface;
}

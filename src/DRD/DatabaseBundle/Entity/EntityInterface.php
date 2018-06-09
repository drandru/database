<?php

namespace DRD\DatabaseBundle\Entity;

interface EntityInterface
{
    /**
     * @return bool
     */
    public function isNew(): bool;

    /**
     * @return int
     */
    public function getId(): int;
}

<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Board\Entity;

use LapisAngularis\Senshu\Framework\Model\EntityInterface;

class User implements EntityInterface
{
    protected $id;
    protected $name;

    public function getId(): int
    {
        return (int) $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}

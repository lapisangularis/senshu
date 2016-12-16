<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Framework\Repository;

use LapisAngularis\Senshu\Framework\Database\DatabaseInterface;

class PDORepository implements RepositoryInterface
{
    protected $database;

    public function __construct(DatabaseInterface $database)
    {
        $this->database = $database;
    }
}

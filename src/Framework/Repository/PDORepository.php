<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Framework\Repository;

use LapisAngularis\Senshu\Framework\Database\DatabaseInterface;
use LapisAngularis\Senshu\Framework\Model\EntityInterface;

abstract class PDORepository implements RepositoryInterface
{
    protected $database;
    protected $entityName;

    public function __construct(DatabaseInterface $database, string $entityName)
    {
        $this->database = $database;
        $this->entityName = $entityName;
    }

    public function query(string $sql, array $args): EntityInterface
    {
        $statement = $this->database->query($sql, $args);
        $object = $this->database->fetchObject($statement, $this->entityName);

        return $object;
    }
}

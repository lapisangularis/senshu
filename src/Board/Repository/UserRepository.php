<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Board\Repository;

use LapisAngularis\Senshu\Board\Entity\User;
use LapisAngularis\Senshu\Framework\Repository\PDORepository;

class UserRepository extends PDORepository
{
    public function findById(int $id): User
    {
        $sql = 'SELECT id, name FROM users WHERE id = :id';

        $args = [
            ':id' => $id
        ];

        return $this->query($sql, $args);
    }
}

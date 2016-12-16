<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Framework\Database\PDO;

use LapisAngularis\Senshu\Framework\Config\MainConfigInterface;
use LapisAngularis\Senshu\Framework\Database\DatabaseInterface;
use \PDO;
use \PDOStatement;

class PDOWrapper implements DatabaseInterface
{
    protected $type;
    protected $host;
    protected $port;
    protected $name;
    protected $user;
    protected $password;

    public function __construct(MainConfigInterface $config)
    {
        $config = $config->getConfig('database');
        $this->type = $config['type'];
        $this->host = $config['host'];
        $this->port = $config['port'];
        $this->name = $config['name'];
        $this->user = $config['user'];
        $this->password = $config['password'];
    }

    public function connect(): PDO
    {
        $pdo = new PDO(
                $this->type
                .':host='.$this->host
                .';port='.$this->port
                .';dbname='.$this->name,
            $this->user,
            $this->password
        );

        return $pdo;
    }

    public function query(string $sql, array $args): PDOStatement
    {
        $connection = $this->connect();
        $statement = $connection->prepare($sql);
        $statement->execute($args);

        return $statement;
    }
}

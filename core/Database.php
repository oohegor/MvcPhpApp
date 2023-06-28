<?php

declare(strict_types=1);

class Database
{
    private PDO $dbHandler;

    private PDOStatement|false $statement;

    public function __construct()
    {
        try {
            $this->dbHandler = new PDO(
                'mysql:host=' . ENV['MYSQL_HOST'] . ';dbname=' . ENV['MYSQL_DATABASE'],
                ENV['MYSQL_USER'],
                ENV['MYSQL_PASSWORD'],
                [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function execute(array $data = null): bool
    {
        return $this->statement->execute($data);
    }

    public function prepareQuery(string $sql): void
    {
        $this->statement = $this->dbHandler->prepare($sql);
    }

    public function resultAll(): bool|array
    {
        $this->execute();

        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function bind($parameter, $value, $type = null): void
    {
        $type = match (is_null($type)) {
            is_int($value) => PDO::PARAM_INT,
            is_bool($value) => PDO::PARAM_BOOL,
            is_null($value) => PDO::PARAM_NULL,
            default => PDO::PARAM_STR,
        };
        $this->statement->bindValue($parameter, $value, $type);
    }
}
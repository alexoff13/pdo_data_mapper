<?php

namespace workers;


require_once('../vendor/autoload.php');
$dotenv = \Dotenv\Dotenv::createImmutable('../');

$dotenv->load();

class DBRequester
{
    protected static $connection;

    protected static function connect()
    {
        if (!isset(self::$connection)) {
            self::$connection = new \PDO("mysql:host=" . $_ENV['MYSQL_HOST'] . ";port=" . $_ENV['MYSQL_PORT'] . ";",
                $_ENV['MYSQL_USER'], $_ENV['MYSQL_PASSWORD']);
        }
    }

    protected static function unsetConnect()
    {
        self::$connection = null;
    }

    public static function execute_with_fetch(string $sql, array $parameters, bool $fetchAll = false)
    {
        self::connect();

        $statement = self::$connection->prepare($sql);
        $statement->execute($parameters);
        if (!$fetchAll) {
            $result = $statement->fetch();
        } else {
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        }
        self::unsetConnect();
        return $result;
    }

    public static function execute(string $sql, array $parameters)
    {
        self::connect();

        $statement = self::$connection->prepare($sql);
        $statement->execute($parameters);

        self::unsetConnect();
    }
}
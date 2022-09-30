<?php

declare(strict_types=1);

namespace Shieldforce\FrameSf\Database\Drivers;

use PDO;
use Shieldforce\FrameSf\Enums\ChannelsLogsEnum;
use Shieldforce\FrameSf\Log\LogCustomImplement;

class Mysql implements InterfaceDriverConnection
{
    private $host;
    private $dbname;
    private $user;
    private $pass;
    private $charset;
    private $port;

    private $classConnection;

    private $connection;

    public function __construct(array $dataConnection)
    {
        $this->host = $dataConnection["DB_HOST"] ?? null;
        $this->dbname = $dataConnection["DB_DATABASE"] ?? null;
        $this->user = $dataConnection["DB_USER"] ?? null;
        $this->pass = $dataConnection["DB_PASSWORD"] ?? null;
        $this->charset = $dataConnection["DB_CHARSET"] ?? null;
        $this->port = $dataConnection["DB_PORT"] ?? null;
        $this->setConnection();
    }

    private function setConnection()
    {
        try {
            $dsn = 'mysql:dbname='.$this->dbname.';host='.$this->host.';port='.$this->port.'';
            $user = ''.$this->user.'';
            $password = ''.$this->pass.'';
            $this->connection = new PDO($dsn, $user, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $exception) {
            $array = exceptionLogArray($exception);
            LogCustomImplement::error(
                ChannelsLogsEnum::PDOExceptionCore,
                $array["message"],
                $array
            );
        }
    }

    public function classConnection()
    {
        return $this;
    }

    public function connection()
    {
        return $this->connection;
    }

    public function createTable(string $table, array $columns = [])
    {
        $implode = implode(",", $columns);
        $sql = "CREATE TABLE {$table} ({$implode}) ";
        return $this->connection->exec($sql);
        // Exemplo de criação de tabela
        /*$array = [
            "id INT(255) PRIMARY KEY AUTO_INCREMENT NOT NULL",
            "name VARCHAR (30) NOT NULL",
            "email VARCHAR (50)"
        ];*/
    }
}
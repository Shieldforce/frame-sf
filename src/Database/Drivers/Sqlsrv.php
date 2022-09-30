<?php

declare(strict_types=1);

namespace Shieldforce\FrameSf\Database\Drivers;

use PDO;
use Shieldforce\FrameSf\Enums\ChannelsLogsEnum;
use Shieldforce\FrameSf\Log\LogCustomImplement;

class Sqlsrv implements InterfaceDriverConnection
{
    private $host;
    private $dbname;
    private $user;
    private $pass;
    private $charset;
    private $port;
    private $drive;

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
        $this->drive = $dataConnection["DB_DRIVER"] ?? null;
        $this->setConnection();
    }

    private function setConnection()
    {
        $pdoConfig  = $this->drive . ":". "Server=" . $this->host . ";";
        $pdoConfig .= "Database=".$this->dbname.";";
        try {
            $this->connection =  new PDO($pdoConfig, $this->user, $this->pass);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $exception) {
            $array = exceptionLogArray($exception);
            $array["message"] .= ", Drivers disponiveis: " . implode(",", PDO::getAvailableDrivers());
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
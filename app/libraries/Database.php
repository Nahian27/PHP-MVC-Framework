<?php

class Database
{
    private string $host = DB_HOST;
    private string $user = DB_USER;
    private string $dbname = DB_NAME;
    private string $pass = DB_PASSWORD;

    private $dbh, $stmt, $error;

    public function __construct()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->dbname";
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::FETCH_OBJ => true
        ];

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $err) {
            echo $this->error = $err->getMessage();
        }
    }

    public function query($sql): void
    {
        $this->stmt = $this->dbh->prepare($sql);
    }
    public function bind($param,$value,$type=null)
    {
        if(is_null($type))
        {
            $type = match (true) {
                is_int($value) => PDO::PARAM_INT,
                is_bool($value) => PDO::PARAM_BOOL,
                is_null($value) => PDO::PARAM_NULL,
                default => PDO::PARAM_STR,
            };
        }
    }
}
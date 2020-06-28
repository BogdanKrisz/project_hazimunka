<?php

require_once "new_config.php";

class Adatbazis
{
    public $kapcsolat;

    function __construct()
    {
        $this->csatlakozas();
    }

    private function csatlakozas()
    {
        $this->kapcsolat = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

        if($this->kapcsolat->connect_errno)
        {
            die("Database connection failed: " . $this->kapcsolat->connect_error);
        }
    }

    public function query($sql)
    {
        $result = $this->kapcsolat->query($sql);

        $this->query_ellenorzes($result);

        return $result;
    }

    private function query_ellenorzes($result)
    {
        if(!$result)
        {
            die("Query failed: " . $this->kapcsolat->error);
        }
    }
}

$adatbazis = new Adatbazis();
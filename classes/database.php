<?php

class DataBase 
{
    protected $pdo;
    private $dbname = "tecmes";
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    public $msgErro = "";
    public function __construct()
    {
        try
        {
            $this->pdo = new PDO("mysql:dbname=".$this->dbname.";host=".$this->host, $this->user, $this->password);
        }catch(PDOException $e)
        {
            $msgErro = $e->getMessage();
        }
    }
}
?>
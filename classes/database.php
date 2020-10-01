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
            $this->pdo = new PDO("mysql:dbname=".$this->dbname.";host=".$this->host, $this->user, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            
        }catch(PDOException $e)
        {
            $msgErro = $e->getMessage();
        }
    }
}
?>
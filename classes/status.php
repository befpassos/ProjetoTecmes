<?php
require_once "database.php";

class Status extends DataBase
{
    public function __construct()
    {
        parent::__construct();
    }

    public function consultarStatus()
    {
        $sql = "SELECT * FROM status";
        $result = $this->pdo->query($sql);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
        
    }


}
?>
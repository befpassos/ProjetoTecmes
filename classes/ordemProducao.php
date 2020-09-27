<?php
require "database.php";

class OrdemProducao extends DataBase
{
    public function __construct()
    {
        parent::__construct();
    }

    public function cadastrarOP($codProduto, $nomeCliente, $nomeProduto, $quantidade, $usuario)
    {
        // if($this->verificarOP($codProduto)) {
        //     return false;
        // }

        $sql = $this->pdo->prepare("INSERT INTO ordem_producao (cod_produto, nome_cliente, nome_produto, quantidade,usuario)
                                            VALUES (:cp, :nc, :np, :q, :u)");
        $sql->bindValue(":cp",$codProduto);      
        $sql->bindValue(":nc",$nomeCliente);
        $sql->bindValue(":np",$nomeProduto);
        $sql->bindValue(":q",$quantidade);
        $sql->bindValue(":u",$usuario);
        if($sql->execute()) {
            return true;
        }else {
            print_r($sql->errorInfo());
            return false;
        }
        
    }

    public function editarOP($ordemProducao,$codProduto, $nomeCliente, $nomeProduto, $quantidade, $status)
    {
        $dataAlteracao = date("Y-m-d");

        $sql = $this->pdo->prepare("
            UPDATE ordem_producao SET 
            cod_produto = :cp, nome_cliente = :nc, 
            nome_produto = :np, quantidade = :q, status = :s,
            data_alteracao = :da
            WHERE 
            ordem_producao = :op"
        );
        $sql->bindValue(":cp",$codProduto);
        $sql->bindValue(":nc",$nomeCliente);
        $sql->bindValue(":np",$nomeProduto);
        $sql->bindValue(":q",$quantidade);
        $sql->bindValue(":s",$status);
        $sql->bindValue(":da",$dataAlteracao);
        $sql->bindValue(":op",$ordemProducao);
        if($sql->execute())
        {
            return true;
        }else {
            print_r($sql->errorInfo());
            return false;
        }
    
    }

    public function deletarOP($ordemProducao)
    {
        $sql = $this->pdo->prepare("DELETE FROM ordem_producao WHERE ordem_producao = :op");
        $sql->bindValue(":op",$ordemProducao);
        if($sql->execute())
        {
            return true;
        }else
        {
            return false;
        }
    }

    public function consultarOP()
    {
        $sql = "SELECT * FROM ordem_producao";
        $result = $this->pdo->query($sql);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);

        return $rows;
    }

    public function consultarById($ordemProducao)
    {
        $sql = $this->pdo->prepare("SELECT * FROM ordem_producao WHERE ordem_producao = :op");
        $sql->bindValue(":op",$ordemProducao);
        $sql->execute();
        $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

} 
    // INSERT
    // $op = new OrdemProducao();
    // var_dump($op->cadastrarOP("1","Matheus","Telha","3","ma"));

    // READ
    // $op = new OrdemProducao();
    // var_dump($op->consultarOP());

    // READ BY ID
    // $op = new OrdemProducao();
    // var_dump($op->consultarById('3'));

    //UPDATE
    // $op = new OrdemProducao();
    // var_dump($op->editarOP("3","1","MatheusOlimpio","Telha","4","1"));

    //DELETE 
    // $op = new OrdemProducao();
    // var_dump($op->deletarOP('5'));
?>
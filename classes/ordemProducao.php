<?php
require_once "database.php";

class OrdemProducao extends DataBase
{
    public function __construct()
    {
        parent::__construct();
    }

    public function cadastrarOP($ordemProducao,$codProduto, $nomeCliente, $quantidade, $usuario)
    {
        $sql = $this->pdo->prepare("INSERT INTO ordem_producao (ordem_producao,cod_produto, nome_cliente, quantidade,usuario)
                                            VALUES (:op, :cp, :nc, :q, :u)");
        $sql->bindValue(":op",$ordemProducao);
        $sql->bindValue(":cp",$codProduto);      
        $sql->bindValue(":nc",$nomeCliente);
        $sql->bindValue(":q",$quantidade);
        $sql->bindValue(":u",$usuario);
        if($sql->execute()) {
            return true;
        }else {
            print_r($sql->errorInfo());
            return false;
        }
        
    }

    public function editarOP($ordemProducao, $codProduto, $nomeCliente, $quantidade, $status)
    {
        $dataAlteracao = date("Y-m-d");

        $sql = $this->pdo->prepare("
            UPDATE ordem_producao SET 
            ordem_producao = :op, cod_produto = :cp, nome_cliente = :nc, 
            quantidade = :q, status = :s,
            data_alteracao = :da
            WHERE 
            ordem_producao = :op"
        );
        $sql->bindValue(":cp",$codProduto);
        $sql->bindValue(":nc",$nomeCliente);
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
            print_r($sql->errorInfo());
            return false;
        }
    }

    public function consultarOP()
    {
        $sql = "SELECT * , date_format(o.data_cadastro,'%d/%m/%Y') as data_cadastro, s.id as id_status
                FROM ordem_producao as o, status as s, produto as p
                WHERE o.cod_produto = p.cod_produto
                AND o.status = s.id";
        $result = $this->pdo->query($sql);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);

        return $rows;
    }

    public function consultarById($ordemProducao)
    {
        $sql = $this->pdo->prepare("SELECT * , s.id as id_status
                                    FROM ordem_producao as o, produto as p, status as s
                                    WHERE o.ordem_producao = :op
                                    AND o.cod_produto = p.cod_produto
                                    AND o.status = s.id");
        $sql->bindValue(":op",$ordemProducao);
        $sql->execute();
        $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function consultarByStatus()
    {
        $sql = "SELECT * FROM ordem_producao as o, status as s, produto as p
                WHERE o.status = s.id
                AND o.status = '3'
                AND o.cod_produto = p.cod_produto";
        $result = $this->pdo->query($sql);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function consultarStatusOP()
    {
        $sql = "SELECT *, date_format(o.data_cadastro,'%d/%m/%Y') as data_cadastro 
                FROM ordem_producao as o, status as s, produto as p
                WHERE o.status = s.id
                AND o.status = '1'
                AND o.cod_produto = p.cod_produto";
        $result = $this->pdo->query($sql);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
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
    // var_dump($op->editarOP("2","1","Matheus O","Telha Laranja","4","1"));

    //DELETE 
    // $op = new OrdemProducao();
    // var_dump($op->deletarOP('5'));
?>
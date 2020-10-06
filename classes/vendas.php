<?php
require 'database.php';

class Vendas extends DataBase
{
    public function __construct()
    {
        parent::__construct();
    }

    public function cadastrarVenda($ordemProducao,$codProduto,$nomeProduto,$nomeCliente,$quantidade)
    {
        $sql = $this->pdo->prepare("INSERT INTO venda (ordem_producao, cod_produto, nome_produto, nome_cliente, quantidade)
                                    VALUES (:op, :cp, :np, :nc, :q)");
        $sql->bindValue(":op",$ordemProducao);
        $sql->bindValue(":cp",$codProduto);
        $sql->bindValue(":np",$nomeProduto);
        $sql->bindValue(":nc",$nomeCliente);
        $sql->bindValue(":q",$quantidade);
        if($sql->execute()){
            return true;
        }else{
            print_r($sql->errorInfo());
            return false;
        }
    }

    public function consultarVenda()
    {
        $sql = "SELECT * FROM venda";
        $result = $this->pdo->query($sql);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);

        return $rows;
    }

}


    // Cadastrar
    // $vendas = new Vendas();
    // var_dump($vendas->cadastrarVenda("1","Matheus","1","5"));

    //Consultar
    // $vendas = new Vendas();
    // var_dump($vendas->consultarVenda());

?>
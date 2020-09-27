<?php
require "database.php";

class Produtos extends DataBase
{
    public function __construct()
    {
        parent::__construct();
    }

    public function verificarProduto($nomeProduto)
    {
        $sql = $this->pdo->prepare("SELECT * FROM produto
                                    WHERE nome_produto = :np");
        $sql->bindValue(":np",$nomeProduto);
        $sql->execute();
        if($sql->rowCount() > 0)
        {
            return true;
        }else
        {
            return false;
        }
    }

    public function cadastrarProduto($nomeProduto)
    {
        if($this->verificarProduto($nomeProduto)) {
            return false;
        }else
        {
            $sql = $this->pdo->prepare("INSERT INTO produto (nome_produto)
                                        VALUES (:np)");
            $sql->bindValue(":np",$nomeProduto);
            if($sql->execute()) {
                return true;
            }else {
                print_r($sql->errorInfo());
                return false;
            }
        }
    }

    public function editarProduto($codProduto,$nomeProduto)
    {
        $sql = $this->pdo->prepare("UPDATE produto SET nome_produto = :np
                                    WHERE cod_produto = :cp");
        $sql->bindValue(":np",$nomeProduto);
        $sql->bindValue(":cp",$codProduto);
        if($sql->execute())
        {
            return true;
        }else
        {
            return false;
        }
    }

    public function deletarProduto($codProduto)
    {
        $sql = $this->pdo->prepare("DELETE FROM produto WHERE cod_produto = :cp");
        $sql->bindValue(":cp",$codProduto);
        if($sql->execute())
        {
            return true;
        }else
        {
            return false;
        }
    }

    public function consultarProduto()
    {
        $sql = "SELECT * FROM produto";
        $result = $this->pdo->query($sql);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);

        print_r($rows);
    }

    public function consultaProduto($codProduto)
    {
        $sql = "SELECT * FROM produto WHERE cod_produto = :cp";
        $sql->bindValue(":cp",$codProduto);
        $result = $this->pdo->query($sql);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);

        print_r($rows);
    }
}
   /* $prod = new Produtos();
    var_dump($prod->cadastrarProduto("Ferro"));*/
?>
<?php
require_once "database.php";

class ProducaoLiberada extends database
{
    public function __construct()
    {
        parent::__construct();
    }

    public function cadastrarProducao($ordemProducao,$ordemFabricacao,$qntdRequisitada,$qntdAProduzir,$qntdProduzida,$maquinaUtilizada)
    {
        $sql = $this->pdo->prepare("INSERT INTO producao_liberada 
                                    (ordem_producao,ordem_fabricacao,qntd_requisitada, 
                                    qntd_aproduzir, qntd_produzida, maquina_utilizada)
                                    VALUES (:op,:of, :qr, :qa, :qp, :mu)");
        $sql->bindValue(":op",$ordemProducao);
        $sql->bindValue(":of",$ordemFabricacao);
        $sql->bindValue(":qr",$qntdRequisitada);
        $sql->bindValue(":qa",$qntdAProduzir);
        $sql->bindValue(":qp",$qntdProduzida);
        $sql->bindValue(":mu",$maquinaUtilizada);
        if($sql->execute()) {
            return true;
        }else {
            print_r($sql->errorInfo());
            return false;
        }
    }

    public function consultarProducao()
    {
        $sql = "SELECT * FROM producao_liberada";
        $result = $this->pdo->query($sql);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);

        return $rows;
    }

    public function consultarById($idFabricacao)
    {
        $sql = $this->pdo->prepare("SELECT * FROM producao_liberada WHERE id_fabricacao = :id");
        $sql->bindValue(":id",$idFabricacao);
        $sql->execute();
        $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function consultarOrdemProducao($ordemProducao)
    {
        $sql = $this->pdo->prepare("SELECT * FROM producao_liberada WHERE ordem_producao = :op");
        $sql->bindValue(":op",$ordemProducao);
        $sql->execute();
        $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function consultarUltimaOrdemFabricacao($ordemProducao) {
        $sql = $this->pdo->prepare("SELECT ordem_fabricacao
                                    FROM producao_liberada 
                                    WHERE ordem_producao = :op
                                    ORDER BY ordem_fabricacao desc limit 1");
        $sql->bindValue(":op",$ordemProducao);
        $sql->execute();
        $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $rows[0]['ordem_fabricacao'];

        
    }

    public function editarProducao($idFabricacao,$ordemProducao,$ordemFabricacao,$qntdRequisitada,$qntdAProduzir,$qntdProduzida,$maquinaUtilizada)
    {
        $sql = $this->pdo->prepare("UPDATE producao_liberada SET
                                    ordem_producao = :op, ordem_fabricacao = :of,
                                    qntd_requisitada = :qr, qntd_aproduzir = :qa,
                                    qntd_produzida = :qp, maquina_utilizada = :mu
                                    WHERE id_fabricacao = :id");
        $sql->bindValue(":op",$ordemProducao);
        $sql->bindValue(":of",$ordemFabricacao);
        $sql->bindValue(":qr",$qntdRequisitada);
        $sql->bindValue(":qa",$qntdAProduzir);
        $sql->bindValue(":qp",$qntdProduzida);
        $sql->bindValue(":mu",$maquinaUtilizada);
        $sql->bindValue(":id",$idFabricacao);
        if($sql->execute()){
            return true;
        }else{
            print_r($sql->errorInfo());
            return false;
        }
    }

    public function deletarProducao($ordemFabricacao)
    {
        $sql = $this->pdo->prepare("DELETE FROM producao_liberada 
                                    WHERE ordem_fabricacao = :of");
        $sql->bindValue(":of",$ordemFabricacao);
        if($sql->execute())
        {
            return true;
        }else
        {
            print_r($sql->errorInfo());
            return false;
        }
    }

}
    //Cadastro
    // $lib = new ProducaoLiberada();
    // var_dump($lib->cadastrarProducao("4","1","10","5","maquina1"));

    //Consultar
    // $lib = new ProducaoLiberada();
    // var_dump($lib->consultarProducao());

    //Consultar by Id
    // $lib = new ProducaoLiberada();
    // var_dump($lib->consultarById("1"));

    //editar
    // $lib = new ProducaoLiberada();
    // var_dump($lib->editarProducao("4","1","11","5","maquina1"));

    //deletar
    // $lib = new ProducaoLiberada();
    // var_dump($lib->deletarProducao("4"));

?>
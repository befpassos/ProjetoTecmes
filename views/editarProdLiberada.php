<?php
    require '../classes/producaoLiberada.php';

    session_start();
    if(!isset($_SESSION['id_usuario']))
    {
        header("location: index.php");
        exit;
    }
    if(isset($_GET['idFabricacao']) && !empty($_GET['idFabricacao'])) {
        $prodLiberada = new ProducaoLiberada();
        $id = $_GET['idFabricacao'];
        $consulta_id = $prodLiberada->consultarById($id);
        $ordem = $_GET['ordemProducao'];
        $consulta_op_liberada = $prodLiberada->consultarOrdemProducao($ordem);
        
        //var_dump($consulta_id);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>TECMES | Edição</title>
    <?php include('../template/header.php') ?>
    <link rel="stylesheet" type="text/css" href="../assets/css/custom.css">
</head>
<body>
<?php include('../template/navbar.php') ?> 
<div class="container">
    <h1>Editar OP em Produção</h1>
    <form method="post" >
        <div class="row">
            <div class="input-field col s12">
                <input readonly type="text" name="ordemProducao" id="ordemProducao" value="<?php echo $consulta_id[0]['ordem_producao'] ?>" maxlength="11">
                <label class="active" for="ordemProducao">Ordem de Produção</label>
            </div>
            <div class="input-field col s12">
                <input readonly type="text" name="ordemFabricacao" id="ordemFabricacao" value="<?php echo $consulta_id[0]['ordem_fabricacao']?>">
                <label class="active" for="ordemFabricacao">Ordem de Fabricação</label>
            </div>
            <div class="input-field col s12 m4 l3">
                <input readonly type="text" name="qntdRequisitada" id="qntdRequisitada" value="<?php echo $consulta_id[0]['qntd_requisitada'] ?>"maxlength="11">
                <label class="active" for="qntdRequisitada">Quantidade Requisitada</label>
            </div>
            <div class="input-field col s12 m4 l3">
                <input type="text" name="qntdProduzida" id="qntdProduzida" value="<?php echo $consulta_id[0]['qntd_produzida']?>" maxlength="11">
                <label class="active" for="qntdProduzida">Quantidade Produzida</label>
            </div>
            <div class="input-field col s12 m4 l3">
                <input type="text" name="qntdAProduzir" id="qntdAProduzir" value="<?php echo $consulta_id[0]['qntd_aproduzir']?>" placeholder="Digite a quantidade a produzir" maxlength="11">
                <label class="active" for="qntdAProduzir">Quantidade  a Produzir</label>
            </div>  
            <div class="input-field col s12 m4 l3">
                <input type="text" name="maquina" id="maquina" value="<?php echo $consulta_id[0]['maquina_utilizada']?>" maxlength="45">
                <label class="active" for="maquina">Máquina Utilizada</label>
            </div>
            <div class="row">
                <a href="producaoLiberada.php?ordemProducao=<?php echo $ordem ?>" class="btn-flat">Voltar</a>
                <button class="btn blue col s12 m6 l3 right" type="submit" value="Salvar">Salvar</button>
            </div>
        </div>
    </form>
</div>
<?php include('../template/footer.php') ?>
<?php
       if(isset($_POST['qntdRequisitada']) && !empty($_POST['qntdRequisitada'])){
        $ordemProducao    = addslashes($_POST['ordemProducao']);
        $ordemFabricacao  = addslashes($_POST['ordemFabricacao']);
        $qntdRequisitada  = addslashes($_POST['qntdRequisitada']);
        $qntdAProduzir    = addslashes($_POST['qntdAProduzir']);
        $qntdProduzida    = addslashes($_POST['qntdProduzida']);
        $maquinaUtilizada = addslashes($_POST['maquina']);

        $quantidadeAtual = $qntdAProduzir + $qntdProduzida;

        if(!empty($ordemProducao) && !empty($ordemFabricacao) && !empty($qntdRequisitada) && 
            !empty($qntdAProduzir) && !empty($qntdProduzida) && !empty($maquinaUtilizada)) {
            if($quantidadeAtual > $qntdRequisitada) {
                ?>
                <div class="msg msg-alert">
                    <h6><i class="small material-icons left ">warning</i>Quantidade à produzir é maior que a quantidade requisitada!</h6>
                </div>
                <?php
                return false;
            }
            if($prodLiberada->editarProducao($id,$ordemProducao,$ordemFabricacao,$qntdRequisitada, $qntdAProduzir,
                                    $qntdProduzida,$maquinaUtilizada)){
                ?>
                    <div class="msg msg-sucesso">
                        <h6><i class="small material-icons left ">check</i>Editado com Sucesso!</h6>
                    </div>
                <?php
                echo '<script>window.location.href = producaoLiberada.php?ordemProducao='.$ordem.'</script>';
                //header("Location: producaoLiberada.php?ordemProducao={$ordem}");
            }
        }else{
            ?>
                    <div class="msg-erro">
                        Preencha todos os campos!
                    </div>
                <?php
        }
    }
}
?>
</body>
</html>
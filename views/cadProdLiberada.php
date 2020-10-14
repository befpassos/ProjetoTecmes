<?php
    require '../classes/producaoLiberada.php';
    require '../classes/ordemProducao.php';

    $prodLiberada = new ProducaoLiberada();
    $op = new OrdemProducao();
    $ordem = $_GET['ordemProducao'];
    $consulta_op_liberada = $prodLiberada->consultarOrdemProducao($ordem);
    $consulta_op = $op->consultarById($ordem);
    $ultima_ordem_fabricacao = $prodLiberada->consultarUltimaOrdemFabricacao($ordem) + 1;


    session_start();
    if(!isset($_SESSION['id_usuario']))
    {
        header("location: index.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>TECMES | Cadastro</title>
    <?php include('../template/header.php') ?>
    <link rel="stylesheet" type="text/css" href="../assets/css/custom.css">
</head>
<body>
<?php include('../template/navbar.php') ?> 
<div class="container">
    <h1>Nova Produção</h1>
    <form method="post">
        <div class="row">
            <div class="input-field col s12">
                <input readonly type="text" name="ordemProducao" id="ordemProducao" value="<?php echo (!isset($consulta_op_liberada[0]['ordem_producao'])) ? $ordem : $consulta_op_liberada[0]['ordem_producao']?>">
                <label class="active" for="ordemProducao">Ordem de Produção</label>
            </div>
            <div class="input-field col s12">
                <input readonly type="text" name="ordemFabricacao" id="ordemFabricacao" value="<?php echo $ultima_ordem_fabricacao?>">
                <label class="active" for="ordemFabricacao">Ordem de Fabricação</label>
            </div>
            <div class="input-field col s12 m4 l3">
                <input readonly type="text" name="qntdRequisitada" id="qntdRequisitada" class="red-text" value="<?php echo $consulta_op[0]['quantidade']?>">
                <label class="active" for="qntdRequisitada">Quantidade Requisitada</label>
            </div>
            <div class="input-field col s12 m4 l3">
                <input readonly type="text" name="qntdProduzida" id="qntdProduzida" class="red-text" value="<?php echo (!isset($consulta_op_liberada[0]['qntd_produzida'])) ? 0 : $consulta_op_liberada[0]['qntd_produzida']?>" placeholder="Digite a quantidade produzida" maxlength="11">
                <label class="active" for="qntdProduzida">Quantidade Produzida</label>
            </div>
            <div class="input-field col s12 m4 l3">
                <input type="text" name="qntdAProduzir" id="qntdAProduzir" placeholder="Digite a quantidade a produzir" maxlength="11">
                <label class="active" for="qntdAProduzir">Quantidade  a Produzir</label>
            </div>            
            <div class="input-field col s12 m4 l3">
                <input type="text" name="maquina" id="maquina" placeholder="Digite a maquina utilizada" maxlength="45">
                <label class="active" for="maquina">Máquina Utilizada</label>
            </div>
        </div>
        <div class="row">
            <a href="producaoLiberada.php?ordemProducao=<?php echo $ordem?>" class="btn-flat">Voltar</a>
            <button class="btn blue col s12 m6 l3 right" type="submit" value="Cadastrar">Cadastrar</button>
        </div>
    </form>
</div>
<?php 
if(isset($_POST['ordemProducao'])) {
  
    $ordemProducao   = addslashes($_POST['ordemProducao']);
    $ordemFabricacao = addslashes($_POST['ordemFabricacao']);
    $qntdRequisitada = addslashes($_POST['qntdRequisitada']);
    $qntdAProduzir   = addslashes($_POST['qntdAProduzir']);
    $qntdProduzida   = addslashes($_POST['qntdProduzida']);
    $maquina         = addslashes($_POST['maquina']);
    $quantidadeAtual = $qntdAProduzir + $qntdProduzida;
    //var_dump(isset($qntdProduzida));
    if(!empty($ordemProducao) && !empty($ordemFabricacao) && !empty($qntdRequisitada) && 
        !empty($qntdAProduzir) && isset($qntdProduzida) && !empty($maquina)) {
        
        if($quantidadeAtual > $qntdRequisitada) {
            ?>
            <div class="msg msg-alert">
                <h6><i class="small material-icons left ">warning</i>Quantidade à produzir é maior que a quantidade requisitada!</h6>
            </div>
            <?php
            return false;
        }

        if($prodLiberada->msgErro == ""){
            if($prodLiberada->cadastrarProducao($ordemProducao,$ordemFabricacao,$qntdRequisitada,
                                                $qntdAProduzir,$quantidadeAtual,$maquina)){
                ?>
                <div class="msg msg-sucesso">
                    <h6><i class="small material-icons left ">check</i>Cadastrado com Sucesso!</h6>
                </div>
                <?php
            }else{
                ?>
                <div class="msg msg-alert">
                    <h6><i class="small material-icons left ">warning</i>Produção já cadastrada!</h6>
                </div>
                <?php
            }
        }else{
            ?>
            <div class="msg-erro">
                <?php echo "Erro: ".$user->msgErro;?>
            </div>
            <?php
        }
    }else{
        ?>
            <div class="msg-erro">
                Preencha todos os campos!
            </div>
        <?php
    }
}
?>    
<?php include('../template/footer.php') ?>       
</body>
</html>
<?php
require_once '../classes/vendas.php';
require_once "../classes/ordemProducao.php";

session_start();
if(!isset($_SESSION['id_usuario']))
{
    header("location: index.php");
    exit;
}

$op = new OrdemProducao();
$consulta = $op->consultarByStatus();
$vendas = new Vendas();


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
    <h1>Liberar Venda</h1>
    <form method="post">
        <div class="row">
            <div class="input-field col s12">
                <input type="text" name="ordemProducao" id="ordemProducao" value="<?php echo $consulta[0]['ordem_producao']?>" placeholder="Digite a ordem de produção" maxlength="11">
                <label class="active" for="ordemProducao">Ordem de Produção</label>
            </div>
            <div class="input-field col s12">
                <input type="text" name="codigo" id="codigo" value="<?php echo $consulta[0]['cod_produto']?>" placeholder="Digite o codigo do produto" maxlength="11">
                <label class="active" for="codigo">Código do Produto</label>
            </div>
            <div class="input-field col s12">
                <input type="text" name="produto" id="produto" value="<?php echo $consulta[0]['nome_produto']?>" placeholder="Digite o codigo do produto" maxlength="45">
                <label class="active" for="produto">Produto</label>
            </div>
            <div class="input-field col s12">
                <input type="text" name="nomeCliente" id="nomeCliente" value="<?php echo $consulta[0]['nome_cliente']?>" placeholder="Digite o nome do cliente" maxlength="45">
                <label class="active" for="nomeCliente">Cliente</label>
            </div>
            <div class="input-field col s12">
                <input type="text" name="quantidade" id="quantidade" value="<?php echo $consulta[0]['quantidade']?>" placeholder="Digite a quantidade" maxlength="11">
                <label class="active" for="quantidade">Quantidade</label>
            </div>
            <a href="vendas.php" class="btn-flat">Voltar</a>
            <button class="btn blue col s12 m6 l3 right" type="submit" value="executar">Executar</button>
        </div>
    </form>
</div> 
<?php
if(isset($_POST['ordemProducao'])) {
    $ordemProducao = addslashes($_POST['ordemProducao']);
    $codProduto    = addslashes($_POST['codigo']);
    $nomeProduto   = addslashes($_POST['produto']);
    $nomeCliente   = addslashes($_POST['nomeCliente']);
    $quantidade    = addslashes($_POST['quantidade']);
    if(!empty($ordemProducao) && !empty($codProduto) && !empty($nomeProduto) && !empty($nomeCliente) && !empty($quantidade)){
        if($vendas->msgErro == "") {
            if($vendas->cadastrarVenda($ordemProducao,$codProduto,$nomeProduto,$nomeCliente,$quantidade)){
                ?>
                <div class="msg msg-sucesso">
                    <h6><i class="small material-icons left ">check</i>Venda efetuada com Sucesso!</h6>
                </div>
                <?php
            }else {
                ?>
                <div class="msg msg-alert">
                    <h6><i class="small material-icons left ">warning</i>Venda já efetuada!</h6>
                </div>
                <?php
            }
        }else {
            ?>
            <div class="msg-erro">
                <?php echo "Erro: ".$user->msgErro;?>
            </div>
            <?php
        }
    }else {
        ?>
            <div class="msg-erro">
                Preencha todos os campos!
            </div>
        <?php

    }
}
?>
</body>
</html>
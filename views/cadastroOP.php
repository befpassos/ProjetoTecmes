<?php
    require_once "../classes/ordemProducao.php";
    $op = new OrdemProducao();

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
    <title>LOGIN | TECMES</title>
    <?php include('../template/header.php') ?>
    <link rel="stylesheet" type="text/css" href="../assets/css/custom.css">
</head>
<body>
<?php include('../template/navbar.php') ?> 
<div class="container">
    <h1>Nova Ordem de Produção</h1>
    <form method="post">
        <div class="row">
            <div class="input-field col s12">
                <input type="text" name="codigo" id="codigo" placeholder="Digite o codigo do produto" maxlength="11">
                <label for="codigo">Número</label>
            </div>
            <div class="input-field col s12">
                <input type="text" name="nomeCliente" id="nomeCliente" placeholder="Digite o nome do cliente" maxlength="45">
                <label for="nomeCliente">Cliente</label>
            </div>
            <div class="input-field col s12">
                <input type="text" name="nomeProduto" id="nomeProduto" placeholder="Digite o nome do produto" maxlength="45">
                <label for="nomeProduto">Produto</label>
            </div>
            <div class="input-field col s12">
                <input type="text" name="quantidade" id="quantidade" placeholder="Digite a quantidade" maxlength="11">
                <label for="quantidade">Quantidade</label>
            </div>
            <div class="input-field col s12">
                <input type="text" name="user" id="user" placeholder="Digite o seu usuario" maxlength="30">
                <label for="user">Usuário</label>
            </div>
            <button class="btn blue col s12 m6 l3 right" type="submit" value="Cadastrar">Cadastrar</button>
        </div>
    </form>
</div>
<?php
if(isset($_POST['codigo'])) {
    $codProduto  = addslashes($_POST['codigo']);
    $nomeCliente = addslashes($_POST['nomeCliente']);
    $nomeProduto = addslashes($_POST['nomeProduto']);
    $quantidade  = addslashes($_POST['quantidade']);
    $usuario     = addslashes($_POST['user']);

    if(!empty($codProduto) && !empty($nomeCliente) && !empty($nomeProduto) && !empty($quantidade) && !empty($usuario)) {
        if($op->msgErro == "") {
            if($op->cadastrarOP($codProduto,$nomeCliente,$nomeProduto,$quantidade,$usuario)) {
                ?>
                <div class="msg msg-sucesso">
                    <h6><i class="small material-icons left ">check</i>Cadastrado com Sucesso!</h6>
                </div>
                <?php
            }else {
                ?>
                <div class="msg msg-alert">
                    <h6><i class="small material-icons left ">warning</i>OP já cadastrada!</h6>
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
<?php include('../template/footer.php') ?>
</body>
</html>
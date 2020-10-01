<?php
    require_once "../classes/produtos.php";
    $produto= new Produtos();
    $consulta = $produto->consultarProduto();

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
    <h1>Novo Produto</h1>
    <form method="post">
        <div class="row">
            <div class="input-field col s12">
                <input type="text" name="nome" id="nome" placeholder="Digite o nome do produto" maxlength="45">
                <label for="nome">Produto</label>
            </div>
            <a href="produtos.php" class="btn-flat">Voltar</a>
            <button class="btn blue col s12 m6 l3 right" type="submit" value="Cadastrar">Cadastrar</button>
        </div>
    </form>
</div>
<?php
if(isset($_POST['nome'])) {
    $nomeProduto = addslashes($_POST['nome']);

    if(!empty($nomeProduto)) {
        if($produto->msgErro == "") {
            if($produto->cadastrarProduto($nomeProduto)) {
                ?>
                <div class="msg msg-sucesso">
                    <h6><i class="small material-icons left ">check</i>Cadastrado com Sucesso!</h6>
                </div>
                <?php
            }else {
                ?>
                <div class="msg msg-alert">
                    <h6><i class="small material-icons left ">warning</i>Produto já cadastrado!</h6>
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
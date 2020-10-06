<?php
require "../classes/produtos.php";

    session_start();
    if(!isset($_SESSION['id_usuario']))
    {
        header("location: index.php");
        exit;
    }
    $produto = new Produtos();
    $cod = $_GET['codigo'];
    $consulta = $produto->consultarByID($cod);

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
    <h1>Editar Produto</h1>
    <form method="post">
        <div class="row">
            <div class="input-field col s12">
            <input type="text" name="nome" id="nome" value="<?php echo $consulta[0]['nome_produto'] ?>" maxlength="45">
                <label class="active" for="nome">Produto</label>
            </div>
            <a href="produtos.php" class="btn-flat">Voltar</a>
            <button class="btn blue col s12 m6 l3 right" type="submit" value="Salvar">Salvar</button>
            
        </div>
    </form>
</div>
<?php include('../template/footer.php') ?>
<?php 
if(isset($_GET['codigo']) && !empty($_GET['codigo'])) {

    if(isset($_POST['nome']) && !empty($_POST['nome'])) {
        $nomeProduto = addslashes($_POST['nome']);
        if(!empty($nomeProduto)) {
            if($produto->editarProduto($cod,$nomeProduto)) {
                ?>
                <div class="msg msg-sucesso">
                    <h6><i class="small material-icons left ">check</i>Editado com Sucesso!</h6>
                </div>
                <?php
                echo '<script>window.location.href = produtos.php</script>';
                //header("Location: editarProduto.php?codigo={$cod}");
                
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
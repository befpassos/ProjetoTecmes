<?php
require_once "../classes/produtos.php";

session_start();
if(!isset($_SESSION['id_usuario'])) {
    header("location: index.php");
    exit;
}

$produto= new Produtos();
$consulta = $produto->consultarProduto();
if(isset($_GET['codProduto'])) {
    $codigo = addslashes($_GET['codProduto']);
    $produto->deletarProduto($codigo);

    header("Location: produtos.php");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--<meta http-equiv="refresh" content="0.5; url='produtos.php'">!-->
    <title>TECMES | Produtos</title>
    <?php include('../template/header.php') ?>
</head>
<body>
<?php include('../template/navbar.php') ?>    
    <div class="container">
        <h3>Listagem de Produtos</h3>
        <div class="row colspan 3">
            <a href="/ProjetoTecmes/views/cadProdutos.php"><button class="btn blue right">Cadastrar Produto</button></a>
        </div>
        <table class="responsive-table highlight centered">
        <thead>
                <tr>
                    <th>Cód. Produto</th>
                    <th>Produto</th>
                    <th>Opção</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($consulta as $row) {?>
                    <tr>
                        <td><?php echo $row['cod_produto']?></td>
                        <td><?php echo $row['nome_produto']?></td>
                        <td>
                            <a href="editarProduto.php?codigo=<?php echo $row['cod_produto'] ?>"><i class="small material-icons center ">edit</i></a>
                            <a onclick="return confirm('Você realmente deseja excluir este produto?')" href="produtos.php?codProduto=<?php echo $row['cod_produto'] ?>"><i class="small material-icons center ">delete</i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php include('../template/footer.php') ?>
<?php

?>
</body>
</html>

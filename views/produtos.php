<?php
    require_once "../classes/produtos.php";
    $produto= new Produtos();

    session_start();
    if(!isset($_SESSION['id_usuario']))
    {
        header("location: index.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
                    <th>Número</th>
                    <th>Produto</th>
                    <th>Opção</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <i class="small material-icons left ">edit</i>
                        <i class="small material-icons left ">delete</i>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php include('../template/footer.php') ?>
</body>
</html>
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TECMES | Pedidos</title>
    <?php include('../template/header.php') ?>
</head>
<body>
<?php include('../template/navbar.php') ?>    
    <div class="container">
        <h3>Listagem de Pedidos</h3>
        <div class="row">
            <a href="/ProjetoTecmes/views/cadastroOP.php"><button class="btn blue right">Cadastrar OP</button></a>
        </div>
        <table class="responsive-table highlight">
            <thead>
                <tr>
                    <th>Ordem de Produção</th>
                    <th>Número</th>
                    <th>Cliente</th>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Data</th>
                    <th>Responsável</th>
                    <th>Status</th>
                    <th>Opção</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="centered">
                        <i class="small material-icons left ">edit</i>
                        <i class="small material-icons left ">delete</i>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
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
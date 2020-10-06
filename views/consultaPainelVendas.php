<?php
require_once "../classes/vendas.php";

session_start();
if(!isset($_SESSION['id_usuario']))
{
    header("location: index.php");
    exit;
}

$vendas = new Vendas();
$consulta = $vendas->consultarVenda();



?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8"/>
<title>TECMES | Vendas</title>
<?php include('../template/header.php') ?>
</head>
<body>
<?php include('../template/navbar.php') ?>    
<div class="container">
    <h3>Listagem de OPs Finalizadas</h3>
    <div class="row">

    </div>
    <table class="responsive-table highlight centered">
        <thead>
            <tr>
                <th>Cód.Venda</th>
                <th>Ordem de Produção</th>
                <th>Cód.Produto</th>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Cliente</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($consulta as $row) { ?>
            <tr>
                <td><?php echo $row['cod_venda']?></td>
                <td><?php echo $row['ordem_producao']?></td>
                <td><?php echo $row['cod_produto']?></td>
                <td><?php echo $row['nome_produto']?></td>
                <td><?php echo $row['quantidade']?></td>
                <td><?php echo $row['nome_cliente']?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<?php include('../template/footer.php') ?>
</body>
</html>

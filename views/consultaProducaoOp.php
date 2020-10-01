<?php
    require_once '../classes/ordemProducao.php';

    session_start();
    if(!isset($_SESSION['id_usuario']))
    {
        header("location: index.php");
        exit;
    }
    $op = new OrdemProducao();
    $consulta = $op->consultarStatusOP();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"/>
    <title>TECMES | Consulta</title>
    <?php include('../template/header.php') ?>
</head>
<body>
<?php include('../template/navbar.php') ?>    
    <div class="container">
        <h3>Listagem de Ordens de Produção</h3>
        <div class="row">
            
        </div>
        <table class="responsive-table highlight centered">
            <thead>
                <tr>
                    <th>Ordem de Produção</th>
                    <th>Cód. do Produto</th>
                    <th>Cliente</th>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Data</th>
                    <th>Status</th>
                    <th>Registrar</th>
                </tr>
            </thead>
            <?php foreach($consulta as $row) { ?>
                <tr>
                    <td><?php echo $row['ordem_producao']?></td>
                    <td><?php echo $row['cod_produto']?></td>
                    <td><?php echo $row['nome_cliente']?></td>
                    <td><?php echo $row['nome_produto']?></td>
                    <td><?php echo $row['quantidade']?></td>
                    <td><?php echo $row['data_cadastro']?></td>
                    <td><?php echo $row['status']?></td>
                    <td>
                    <a href="producaoLiberada.php?ordemProducao=<?php echo $row['ordem_producao'] ?>"><i class="small material-icons center ">send</i></a>
                    </td>
                    
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
<?php include('../template/footer.php') ?>
</body>
</html>

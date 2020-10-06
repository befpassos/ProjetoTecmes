<?php
    require_once "../classes/ordemProducao.php";
    session_start();
    if(!isset($_SESSION['id_usuario']))
    {
        header("location: index.php");
        exit;
    }

    $op = new OrdemProducao();
    $consulta = $op->consultarOP();
    if(isset($_GET['ordem_prod'])) {
        $identificador = addslashes($_GET['ordem_prod']);
        $op->deletarOP($identificador);
        header("Location: ordemProducao.php");
    }


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"/>
    <title>TECMES | Ordens</title>
    <?php include('../template/header.php') ?>
</head>
<body>
<?php include('../template/navbar.php') ?>    
    <div class="container">
        <h3>Listagem de Ordens de Produção</h3>
        <div class="row">
            <a href="/ProjetoTecmes/views/cadastroOP.php"><button class="btn blue right">Cadastrar OP</button></a>
        </div>
        <table class="responsive-table highlight centered">
            <thead>
                <tr>
                    <th>Ordem Produção</th>
                    <th>Cód.Produto</th>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Cliente</th>
                    <th>Responsável</th>
                    <th>Data</th>
                    <th>Status</th>
                    <th>Opção</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($consulta as $row) { ?>
                <tr>
                    <td><?php echo $row['ordem_producao']?></td>
                    <td><?php echo $row['cod_produto']?></td>
                    <td><?php echo $row['nome_produto']?></td>
                    <td><?php echo $row['quantidade']?></td>
                    <td><?php echo $row['nome_cliente']?></td>
                    <td><?php echo $row['usuario']?></td>
                    <td><?php echo $row['data_cadastro']?></td>
                    <td><?php echo $row['status']?></td>
                    <td>
                    <a href="editarOP.php?ordem=<?php echo $row['ordem_producao'] ?>"><i class="small material-icons center ">edit</i></a>
                    <a onclick="return confirm('Você realmente deseja excluir esta ordem de produção?')" href="ordemProducao.php?ordem_prod=<?php echo $row['ordem_producao']?>"><i class="small material-icons center ">delete</i></a>
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


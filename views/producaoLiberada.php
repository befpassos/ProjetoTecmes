<?php
    require_once '../classes/producaoLiberada.php';


    session_start();
    if(!isset($_SESSION['id_usuario'])) {
        header("location: index.php");
        exit;
    }
    $ordem = $_GET['ordemProducao'];
    //$ordemFabricacao = $_GET['ordemFabricacao'];
    $prodLiberada = new ProducaoLiberada();
    $consulta = $prodLiberada->consultarOrdemProducao($ordem);
    if(isset($_GET['ordemFabricacao'])){
        $ordemFabricacao  = addslashes($_GET['ordemFabricacao']);
        $prodLiberada->deletarProducao($ordemFabricacao);
        header("Location: producaoLiberada.php?ordemProducao={$ordem}");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TECMES | Produção</title>
    <?php include('../template/header.php') ?>
</head>
<body>
<?php include('../template/navbar.php') ?>    
    <div class="container">
        <h3>Listagem de OPs em Produção</h3>
        <div class="row colspan 3">
            <a href="/ProjetoTecmes/views/cadProdLiberada.php?ordemProducao=<?php echo $consulta[0]['ordem_producao']?>"><button class="btn blue right">Cadastrar Nova Produção</button></a>
        </div>
        <table class="responsive-table highlight centered">
            <thead>
                <tr>
                    <th>Ordem de Produção</th>
                    <th>Ordem de Fabricação</th>
                    <th>Qntd. Requisitada</th>
                    <th>Qntd. Produzida</th>
                    <th>Qntd. A Produzir</th>
                    <th>Máquina Utilizada</th>
                    <th>Opção</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($consulta as $row){?>
                    <tr>
                        <td><?php echo $row['ordem_producao']?></td>
                        <td><?php echo $row['ordem_fabricacao']?></td>
                        <td><?php echo $row['qntd_requisitada']?></td>
                        <td><?php echo $row['qntd_produzida']?></td>
                        <td><?php echo $row['qntd_aproduzir']?></td>
                        <td><?php echo $row['maquina_utilizada'] ?></td>
                        <td>
                            <a href="editarProdLiberada.php?idFabricacao=<?php echo $row['id_fabricacao']?>&ordemProducao=<?php echo $ordem ?>"><i class="small material-icons center ">edit</i></a>
                            <a onclick="return confirm('Você realmente deseja excluir?')" href="producaoLiberada.php?ordemProducao=<?php echo $ordem?>&ordemFabricacao=<?php echo $row['ordem_fabricacao']?>"><i class="small material-icons center ">delete</i></a>
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
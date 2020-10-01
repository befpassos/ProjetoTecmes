<?php
    require "../classes/ordemProducao.php";
    require "../classes/produtos.php";
    require "../classes/status.php";

    session_start();
    if(!isset($_SESSION['id_usuario']))
    {
        header("location: index.php");
        exit;
    }


    if(isset($_GET['ordem']) && !empty($_GET['ordem'])) {
        $op = new OrdemProducao();
        $produtos = new Produtos();
        $status = new Status();
        $ordem = $_GET['ordem'];
        $consulta = $op->consultarById($ordem);
        $prod = $produtos->consultarProduto();
        $status_consulta = $status->consultarStatus();
        
        if(isset($_POST['cod_produto']) && !empty($_POST['cod_produto'])){
        
            $codProduto  = addslashes($_POST['cod_produto']);
            $nomeCliente = addslashes($_POST['nomeCliente']);
            $quantidade  = addslashes($_POST['quantidade']);
            $status      = addslashes($_POST['status']);
            if(!empty($codProduto) && !empty($nomeCliente) && !empty($quantidade) && !empty($status)) {
                if($op->editarOP($ordem, $codProduto, $nomeCliente, $quantidade, $status)) {
                    ?>
                    <div class="msg msg-sucesso">
                        <h6><i class="small material-icons left ">check</i>Editado com Sucesso!</h6>
                    </div>
                    <?php
                    header("Location: editarOP.php?ordem={$ordem}");
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
    <h1>Editar OP</h1>
    <form method="post" >
        <div class="row">
            <div class="input-field col s12">
                <input type="text" name="ordem_producao" id="ordem_producao" value="<?php echo $consulta[0]['ordem_producao'] ?>">
                <label class="active" for="ordem_producao">Ordem de Produção</label>
            </div>
            <div class="input-field col s12">
                <input type="text" name="codigo" id="codigo" value="<?php echo $consulta[0]['cod_produto'] ?>">
                <label class="active" for="codigo">Código do Produto</label>
            </div>
            <div class="input-field col s12">
                <input type="text" name="nomeCliente" id="nomeCliente" value="<?php echo $consulta[0]['nome_cliente']?>">
                <label class="active" for="nomeCliente">Cliente</label>
            </div>
            <div class=" col s12">
            <label for="nomeProduto">Produto</label>
                <select class="browser-default" id="cod_produto" name="cod_produto">
                    <?php for($i = 0; $i < count($prod); $i++){ ?>
                        <?php if($consulta[0]['cod_produto'] == $prod[$i]['cod_produto']){?>
                            <option selected="true" value="<?php echo $consulta[0]['cod_produto']?>"><?php echo $consulta[0]['nome_produto']?></option>
                        <?php }else{?>
                                <option value="<?php echo $prod[$i]['cod_produto']?>"><?php echo $prod[$i]['nome_produto']?></option>
                        <?php }?>
                    <?php }?>
                </select>
            </div>
            <div class="input-field col s12">
                <input type="text" name="quantidade" id="quantidade" value="<?php echo $consulta[0]['quantidade']?>">
                <label class="active" for="quantidade">Quantidade</label>
            </div>
            <div class=" col s12">
            <label class="active" for="status">Status</label>
                    <select  class="browser-default" id="status" name="status">
                        <?php for($i = 0; $i < count($status_consulta); $i++){?>
                            <?php if($consulta[0]['id'] == $status_consulta[$i]['id']) {?>
                                <option  selected="true" value="<?php echo $consulta[0]['id']?>"><?php echo $consulta[0]['status'] ?></option>
                            <?php }else{?>
                                <option value="<?php echo $status_consulta[$i]['id']?>"><?php echo $status_consulta[$i]['status'] ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
            </div>
            <a href="ordemProducao.php" class="btn-flat">Voltar</a>
            <button class="btn blue col s12 m6 l3 right" type="submit" value="Salvar">Salvar</button>
        </div>
    </form>
</div>
<?php include('../template/footer.php') ?>
</body>
</html>
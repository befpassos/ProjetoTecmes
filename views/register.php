<?php
    require_once "../classes/usuarios.php";
    $user = new User();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>TECMES | Login</title>
    <?php include('../template/header.php') ?>
    <link rel="stylesheet" type="text/css" href="../assets/css/custom.css">
    <style>
                body{
            background: #2193b0;
            background: -webkit-linear-gradient(to right, #6dd5ed, #2193b0); 
            background: linear-gradient(to right, #6dd5ed, #2193b0);
            background-repeat: no-repeat;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>
<body>
<div id="corpo-form-cad">
    <h1>Cadastrar</h1>
    <form method="post">
        <div class="row">
            <div class="input-field col s12">
                <input type="text" name="nome" id="nome" placeholder="Digite seu nome" maxlength="45">
                <label for="nome">Nome</label>
            </div>

            <div class="input-field col s12">
            <input type="email" name="email" id="email" placeholder="Digite seu email" maxlength="40">
                <label for="email">Email</label>
            </div>
            
            <div class="input-field col s12">
                <input type="password" id="password" name="senha" placeholder="Digite sua senha" maxlength="15">
                <label for="password">Senha</label>
            </div>
            
            <div class="input-field col s12">
                <input type="password" id="password" name="confSenha" placeholder="Confirme sua senha">
                <label for="password">Confirmação de Senha</label>
            </div>
            <a href="/ProjetoTecmes/" class="btn-flat left">Voltar</a>
            <button class="btn blue col s12 m6 l3 right" type="submit" value="Cadastrar">Cadastrar</button>
        </div>
    </form>
</div>
<?php

//verificar se clicou no botão
if(isset($_POST['nome']))
{
    $name        = addslashes($_POST['nome']);
    $email        = addslashes($_POST['email']);
    $password     = addslashes($_POST['senha']);
    $confPassword = addslashes($_POST['confSenha']);
    //verificar se esta preenchido
    if(!empty($name) && !empty($email) && !empty($password) &&
        !empty($confPassword))
    {
        
        if($user->msgErro == "")
        {
            if($password == $confPassword)
            {
                if($user->cadastrar($name,$email,$password))
                {
                    ?>
                    <div class="msg msg-sucesso">
                        <h6><i class="small material-icons left ">check</i>Cadastrado com Sucesso!</h6>
                    </div>
                    <?php
                }else
                {
                    ?>
                    <div class="msg msg-alert">
                        <h6><i class="small material-icons left ">warning</i>E-mail já cadastrado!</h6>
                    </div>
                    <?php

                }
            }else
            {
                ?>
                    <div class="msg msg-alert">
                        <h6><i class="small material-icons left ">warning</i>Senha e Confirmação de Senha não correspondem!</h6>
                    </div>
                <?php
            
            }
            
        }else
        {
            ?>
            <div class="msg-erro">
                <?php echo "Erro: ".$user->msgErro;?>
            </div>
            <?php
        }
    }else{
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
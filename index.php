<?php
    require_once "classes/usuarios.php";
    $user = new User();

    
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>TECMES | Login</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="assets/css/custom.css">
    <style>
        body{
            background: #2193b0;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #6dd5ed, #2193b0);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #6dd5ed, #2193b0); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */    
            /*background-position: 30% 60%;*/
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
    <div id="corpo-form">
        <h1>Acesso ao Sistema</h1>
        <form method="post">
            <div class="row"> 
                <div class="input-field col s12">
                    <input type="email" id="email" name="email" placeholder="Digite aqui o seu email">
                    <label for="email">Email</label>
                </div>

                <div class="input-field col s12">
                    <input type="password" id="senha" name="senha" placeholder="Digite aqui a sua senha">
                    <label for="senha">Senha</label>
                </div>
                
                <button class="btn btn-primary blue col s12" type="submit" value="Acessar">Entrar</button>
            </div>
        </form>
        <a href="views/register.php">Ainda não tem cadastro?<strong> Cadastre-se aqui!</strong></a>
    </div>
    <?php
if(isset($_POST['email']))
{
    $email    = addslashes($_POST['email']);
    $password = addslashes($_POST['senha']);
    if(!empty($email) && !empty($password))
    {
        
        if($user->msgErro == "")
        {
            if($user->logar($email, $password))
            {
                
                header("location: views/home.php");
            }else
            {
                ?>
    <div class="msg msg-erro">
        <h6><i class="small material-icons left ">error</i>E-mail e/ou senha estão incorretos!</h6>
    </div>
    <?php
            }
        }else
        {
            ?>
    <div class="msg msg-erro">
        <h6><i class="small material-icons left ">error</i><?php echo "Erro: ".$user->msgErro;?></h6>
    </div>
    <?php
        }
        
    }else
    {
        ?>
    <div class="msg msg-alert">
        <h6><i class="small material-icons left ">warning</i>Preencha todos os campos!</h6>
    </div>
    <?php
    }
}

?>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>
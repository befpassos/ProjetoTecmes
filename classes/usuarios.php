<?php
require "database.php";

class User extends DataBase
{

    public function __construct()
    {
        parent::__construct();
    }

    public function cadastrar($name, $email, $password)
    {
        
        //verificar se já existe o email cadastrado
        $sql = $this->pdo->prepare("SELECT id_usuario FROM usuarios
                                    WHERE email= :e");
        $sql->bindValue(":e",$email);
        $sql->execute();
        if($sql->rowCount() > 0)
        {
            return false; //já esta cadastrada
        }else
        {
            //caso nao, cadastrar
            $sql = $this->pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:n, :e, :p)");
            $sql->bindValue(":n",$name);
            $sql->bindValue(":e",$email);
            $sql->bindValue(":p",md5($password));
            $sql->execute();
            return true;
        }
    }

    public function logar($email, $password)
    {
        
        
        //verificar se o email e senha estão cadastrados, se sim
        $sql = $this->pdo->prepare("SELECT id_usuario, email, nome FROM usuarios WHERE email = :e AND senha = :p");
        $sql->bindValue(":e",$email);
        $sql->bindValue(":p",md5($password));
        $sql->execute();
        if($sql->rowCount() > 0)
        {
            //entrar no sistema (sessão)
            $dados = $sql->fetch();
            session_start();
            $_SESSION['id_usuario'] = $dados['id_usuario'];
            $_SESSION['nome'] = $dados['nome'];
            $_SESSION['email'] = $dados['email'];

            return true; //logado com sucesso
        }else
        {
            return false; //nao foi possivel logar
        }
        
    }
}

?>
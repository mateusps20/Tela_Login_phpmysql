<?php

Class Usuario
{
    private $pdo;
    public $msgErro = "";

    public function conectar($nome, $host, $usuario, $senha)
    {
        global $pdo;
        global $msgErro;
        try
        {
            $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
        } 
        catch (PDOException $e)
        {
            $msgErro = $e->getMessage();
        }
        
    }

    public function cadastrar($nome, $email, $senha)
    {
        global $pdo;

        //verificar se o email ja está cadastrado
        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
        $sql->bindValue(":e", $email);
        $sql->execute();
        if($sql->rowCount() > 0)
        {
            return false; // verificou que retornou alguma linha(id_usuario) do banco
        }
        else
        {
            // se não retornar nenhuma linha do banco, cadastrar novo usuario
            $sql = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:n, :e, :s)");
            $sql->bindValue(":n", $nome);
            $sql->bindValue(":e", $email);
            $sql->bindValue(":s", md5($senha));
            $sql->execute();
            return true;
        }
    }

    public function cadastrarProduto($codprod, $nomeprod, $preco, $qte)
    {
        global $pdo;

        //verificar se o email ja está cadastrado
        $sql = $pdo->prepare("SELECT id_produto FROM produtos WHERE codprod = :c");
        $sql->bindValue(":c", $codprod);
        $sql->execute();
        if($sql->rowCount() > 0)
        {
            return false; // verificou que retornou alguma linha(id_produto) do banco
        }
        else
        {
            // se não retornar nenhuma linha do banco, cadastrar novo produto
            $sql = $pdo->prepare("INSERT INTO produtos (codprod, nomeprod, preco, qte) VALUES (:c, :n, :p, :q)");
            $sql->bindValue(":c", $codprod);
            $sql->bindValue(":n", $nomeprod);
            $sql->bindValue(":p", $preco);
            $sql->bindValue(":q", $qte);
            $sql->execute();
            return true;
        }
    }

    public function logar($email, $senha)
    {
        global $pdo;
        // verificar se email e senha estão cadastrados no banco
        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha = :s");
        $sql->bindValue(":e", $email);
        $sql->bindValue(":s", md5($senha));
        $sql->execute();
        if($sql->rowCount() > 0)
        {
            // entro na tela de cadastro de produtos
            $dado = $sql->fetch();
            session_start();
            $_SESSION['id_usuario'] = $dado['id_usuario'];
            return true; // logado com sucesso
        }
        else
        {
            return false; // não conseguiu logar
        }
    }

}

?>
<?php
    require_once 'CLASSES/usuarios.php';
    $u = new Usuario;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b066c31a85.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS\estilo.css">
    <title>Tela de Login</title>
</head>
<body>
    
    <!--Inicio tela de cadastro centralizada-->
   <div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <h3>Cadastrar</h3>
                <div class="card-body">
                    <form method="POST">
                        <div class="input-group form-group">
                            <input type="text" name="nome" class="form-control" placeholder="Nome Completo" maxlength="30">
                        </div>

                        <div class="input-group form-group">
                            <input type="text" name="email" class="form-control" placeholder="Email" maxlength="40">
                        </div>

                        <div class="input-group form-group">
                            <input type="password" name="senha" class="form-control" placeholder="Senha" maxlength="15">
                        </div>

                        <div class="input-group form-group">
                            <input type="password" name="confsenha" class="form-control" placeholder="Confirmar Senha" maxlength="15">
                        </div>

                        <div class="form-group">
                            <input type="submit" value="Cadastrar" class="btn float-right login_btn">
                        </div>
                    </form>
                </div>
            </div>
        </div>
   </div> <!--Fechamento tela de cadastro centralizada-->

   <?php
        //verifica se clicou no botão
        if(isset($_POST['nome']))
        {
            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);
            $confSenha = addslashes($_POST['confsenha']);
            
            //verificar se tem algum campo vazio
            if(!empty($nome) && !empty($email) && !empty($senha) && !empty($confSenha))
            {
                $u->conectar("projeto_login", "localhost", "root", "");
                if($u->msgErro == "")
                {
                    if($senha == $confSenha)
                    {
                        // tudo ok
                        if($u->cadastrar($nome, $email, $senha))
                        {
                            ?>
                                <div class="alert alert-success sucesso">
                                    Cadastro realizado com <strong>sucesso!</strong> Faça login para acessar!
                                </div>
                            <?php
                        }
                        else
                        {
                            ?>
                                <div class="alert alert-danger">
                                    Email já <strong>cadastrado!</strong>
                                </div>
                                
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                            <div class="alert alert-warning">
                                <strong>Senhas não correspondem</strong>, por favor verificar!
                            </div>
                            
                        <?php
                    }
                }
                else
                {
                    echo "Erro: ".$u->msgErro;
                } 
            }
            else
            {
                ?>
                    <div class="alert alert-warning">
                        <strong>Existem campos vazios</strong> que precisam ser preenchidos!
                    </div>
                    
                <?php                    
            }
        }
   ?>

</body>
</html>
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
    
    <!--Inicio tela de login centralizada-->
   <div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <h3>Login</h3>
                <div class="card-body">
                    <form method="POST">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="email" class="form-control" placeholder="Email">
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="senha" class="form-control" placeholder="Senha">
                        </div>

                        <div class="row align-items-center remember">
                            <input type="checkbox">Lembrar-me
                        </div>

                        <div class="form-group">
                            <input type="submit" value="Login" class="btn float-right login_btn">
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center links">
                        Não possui conta?<a href="cadastrar.php">Cadastre-se</a>
                    </div>

                    <div class="d-flex justify-content-center">
                        <a href="#">Esqueceu sua senha?</a>
                    </div>
                </div>
            </div>
        </div>
   </div> <!--Fechamento tela de login centralizada-->

   <?php
        //verifica se clicou no botão
        if(isset($_POST['email']))
        {
            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);
         
            //verificar se tem algum campo vazio
            if(!empty($email) && !empty($senha))
            {
                $u->conectar("projeto_login", "localhost", "root", "");
                if($u->msgErro == "")
                { 
                    if($u->logar($email, $senha))
                    {
                        header("location: listagem.php");
                    }
                    else
                    {
                        ?>
                            <div class="alert alert-danger">
                                <strong>Email e/ou senha</strong> estão incorretos!
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
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
    <title>Cadastrar Produto</title>
</head>
<body>
    
<div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <h3>Cadastrar Novo Produto</h3>
                <div class="card-body">
                    <form method="POST">
                        <div class="input-group form-group">
                            <input type="text" name="codprod" class="form-control" placeholder="Código do Produto">
                        </div>

                        <div class="input-group form-group">
                            <input type="text" name="nomeprod" class="form-control" placeholder="Nome do Produto">
                        </div>

                        <div class="input-group form-group">
                            <input type="text" name="preco" class="form-control" placeholder="Preço">
                        </div>

                        <div class="input-group form-group">
                            <input type="text" name="qte" class="form-control" placeholder="Quantidade">
                        </div>

                        <div class="form-group">
                            <input type="submit" value="Novo Produto" class="btn float-right login_btn">
                        </div>

                        <div class="form-group">
                            <a href="listagem.php">
                                <button type="button" class="btn float-left voltar_btn">Voltar</button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
   </div>

   <?php
        //verifica se clicou no botão
        if(isset($_POST['codprod']))
        {
            $codprod = addslashes($_POST['codprod']);
            $nomeprod = addslashes($_POST['nomeprod']);
            $preco = addslashes($_POST['preco']);
            $qte = addslashes($_POST['qte']);
            
            //verificar se tem algum campo vazio
            if(!empty($codprod) && !empty($nomeprod) && !empty($preco) && !empty($qte))
            {
                $u->conectar("projeto_login", "localhost", "root", "");
                if($u->msgErro == "")
                {
                    // tudo ok
                    if($u->cadastrarProduto($codprod, $nomeprod, $preco, $qte))
                    {
                        ?>
                            <div class="alert alert-success sucesso">
                                Produto cadastrado com <strong>sucesso!</strong>
                            </div>
                        <?php
                    }
                    else
                    {
                        ?>
                            <div class="alert alert-danger">
                                Código do produto já <strong>cadastrado!</strong>
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
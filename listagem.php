<?php
    require_once 'CLASSES/usuarios.php';
    $u = new Usuario;

    $servername = "localhost";     
    $database="projeto_login";     
    $username="root";     
    $password="";

    $link = mysqli_connect($servername, $username, $password,$database);



?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b066c31a85.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS\estilo.css">
    <title>Listagem de Produtos</title>
    
</head>
<body>
<div class="container pt-5">
    <div class="row">
        <div class="col-12">
            <table class="table table-dark tabela">
                <a href="cadastrarproduto.php">
                    <button type="button" class="btn btn-dark">Novo Produto</button>
                </a>
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Código</th>
                        <th scope="col">Nome do Produto</th>
                        <th scope="col">Preço</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Ações</th>
                    </tr>
                    <?php

                        $query = 'SELECT * FROM produtos';
                        
                        $valor = mysqli_query($link,$query);

                        $linha = mysqli_num_rows($valor);

                        if ($linha > 0) 
                        {
                            
                            foreach ($valor as $key) 
                            {
                                echo "<tr>";
                                echo" <th scope=\"col\">" . $key['id_produto'] . "</th>";
                                echo" <th scope=\"col\">" . $key['codprod'] . "</th>";
                                echo" <th scope=\"col\">" . $key['nomeprod'] . "</th>";
                                echo" <th scope=\"col\">" . $key['preco'] . "</th>";
                                echo" <th scope=\"col\">" . $key['qte'] . "</th>";
                                echo" </tr>";
                            }
                        }



                    ?>
                </thead>
            </table>
        </div>
    </div>
</div>
</body>
</html>

<?php
    session_start();
    if(!isset($_SESSION['id_usuario']))
    {
        header("location: login.php");
        exit;
    }
?>
<?php

    if (isset($_GET['CarregaArquivo']) && !empty($_GET['CarregaArquivo'])) {
        include_once $_GET['CarregaArquivo'];
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PixPay - Desafio</title>

    <!-- Custom fonts for this template-->
    <link href="fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                
            <?php
        
        require_once("../banco.php");

        // Conectando ao banco de dados
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificando a conexão
        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }

        // Verificando se o formulário foi submetido
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['email'])) {
            $email = $_GET["email"];
            
            // 
            $sql = "SELECT * FROM convidado WHERE email = '$email'";
            $resultado = mysqli_query($conn, $sql);

            // Verifica se houve erro na consulta
            if (!$resultado) {
                die('Erro ao executar a consulta: ' . mysqli_error($conn));
            }

            if (mysqli_num_rows($resultado) > 0) {

                /////////////// FLAG:: SQL-INJECTION ///////////////
                echo '<div class="alert alert-success" role="alert">
                    <h3>Sucesso! O email está na lista de convidados <br /><br /> FL4G: <i>Pixpay{Inj3ctM3Plz}</i></h3>
                </div>';

                

            } else {
                echo '<div class="alert alert-danger" role="alert">
                Erro! O email <i>'.$email.'</i> não está na lista de convidados.
                </div>';

                $padraoScript = '/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/i';
                // $padraoAlert = '/alert\s*\(/i';

                /////////////// FLAG:: XSS ///////////////
                if (preg_match($padraoScript, $email) ) {
                    echo '<div class="alert alert-success" role="alert">
                            <h3>Sucesso! O email está na lista de convidados <br /><br /> FL4G: <i>Pixpay{3xpl0r3_XsS}</i></h3>
                        </div>';
                }
            }
        }

        // Fechando a conexão com o banco de dados
        $conn->close();
        ?>

                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Você foi convidado para o DESAFIO! <span style="font-size: 15px !important;"><br /> Insira seu e-mail para validarmos:</span> </h1>
                                
                            </div>
                            <form action="index.php" method="GET" class="user">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email" id="email" name="email">
                                </div>
                              
                                <button type="submit"  class="btn btn-primary btn-user btn-block">
                                    Verificar meu convite
                                </button>

                                <a href="./index.php?CarregaArquivo=convite.php"  class="btn btn-secondary btn-user btn-block">
                                    Ver Exemplo de Convite
                                </a>
                               
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="jquery/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
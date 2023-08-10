<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PixPay - Digital 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
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
        // Dados de conexão com o banco de dados
        $servername = "149.100.155.1";
        $username = "u666788042_pixpay";
        $password = "PixPay2023";
        $dbname = "u666788042_pixpay";

        // Conectando ao banco de dados
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificando a conexão
        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }

        // Verificando se o formulário foi submetido
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nome = $_POST["nome"];
            $email = $_POST["email"];
            $cpf = $_POST["cpf"];
            $senha = $_POST["senha"];

            // Preparando a instrução SQL
            $sql = "INSERT INTO contas (nome, email, cpf, senha) VALUES ('$nome', '$email', '$cpf', '$senha')";

            if ($conn->query($sql) === TRUE) {
                echo '<div class="alert alert-success" role="alert">
                    <h3>Oba! Cadastro realizado com sucesso '.$nome.'</h3>
                </div>';

            } else {
                echo "<h3>ERRO NO BANCO:</h3>";
                echo '<div class="alert alert-danger" role="alert">
                    '.$conn->error.'
                </div>'; exit;
                
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
                                <h1 class="h4 text-gray-900 mb-4">Abrir conta Digital PixPay!</h1>
                            </div>
                            <form action="criar_conta.php" method="POST" class="user">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="Nome" id="nome" name="nome">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="exampleLastName"
                                            placeholder="CPF" id="cpf" name="cpf">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email" id="email" name="email">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Escolha uma boa senha!" id="senha" name="senha">
                                    </div>
                                
                                </div>
                                <button type="submit"  class="btn btn-primary btn-user btn-block">
                                    Abrir minha conta agora!
                                </button>
                               
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="login.php">Já possui uma conta? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PixPay - Digital 2 - Login</title>

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

        <!-- Outer Row -->
        <div class="row justify-content-center">

        <?php

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

        // Dados de conexão com o banco de dados
        require_once("../banco.php");

        // Conectando ao banco de dados
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificando a conexão
        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }

        // Verificando se o formulário foi submetido
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email_cpf = $_POST["email_cpf"];
            $senha = $_POST["senha"];


             // Verificar se o usuário existe no banco de dados
            $checkUserQuery = "SELECT * FROM contas WHERE email = '$email_cpf' OR cpf = '$email_cpf'";
            $checkUserResult = $conn->query($checkUserQuery);

            if ($checkUserResult->num_rows > 0) {
                
                $sql = "SELECT * FROM contas WHERE (email = '$email_cpf' OR cpf = '$email_cpf') AND senha = '$senha'";
                $query = $conn->query($sql);

                if ($query->num_rows > 0) {

                    $row = $query->fetch_assoc();


                    $_SESSION['usuario']['id']     = $row['id'];
                    $_SESSION['usuario']['cpf']    = $row['cpf'];
                    $_SESSION['usuario']['nome']   = $row['nome'];
                    $_SESSION['usuario']['foto']   = $row['foto'];
                    $_SESSION['usuario']['email']  = $row['email'];
                    $_SESSION['usuario']['admin']  = $row['admin'];
                    $_SESSION['usuario']['saldo']  = $row['saldo'];
                    
                    echo '<div class="alert alert-success" role="alert">
                        <h3>Oba! Login realizado com sucesso: <i> '.$row["nome"].'</i> </h3>
                    </div>';
                    echo "<script>window.location.href='index.php';</script>";
                    exit;
    
                } else {

                    
                    echo '<div class="alert alert-danger" role="alert">
                       A senha deste usuário está incorreta!
                    </div>'; 
                    
                }

            } else {
                
                echo '<div class="alert alert-danger" role="alert">
                   Nenhum Usuário com este CPF ou E-mail foi encontrado!
                </div>'; 

            }            
            
        }

        // Fechando a conexão com o banco de dados
        $conn->close();
        ?>

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Internet Banking</h1>
                                    </div>
                                    <form action="login.php" method="POST" class="user">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                id="email_cpf" name="email_cpf" placeholder="Digite seu email ou CPF" >
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" id="senha" name="senha" placeholder="******">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Lembrar-me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Entrar
                                        </button>
                                        
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="criar_conta.php">Abrir conta digital PixPay</a>
                                    </div>
                                </div>
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
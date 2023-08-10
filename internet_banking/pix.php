<?php require_once "cabecalho.php"; ?>


<div class="container-fluid">

<div class="row">

<!-- Area Chart -->
<div class="col-xl-12 col-lg-12">

  
<?php
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
        $chavePix = $_POST["chave"];
        $valor = $_POST["valor"];
        $descricao = $_POST["descricao"];
        


         // Verificar se a chave PIX existe no banco de dados
        $checkChaveQuery = "SELECT * FROM contas WHERE id = '".$_SESSION['usuario']['id']."'";
        $checkChaveResult = $conn->query($checkChaveQuery);
 
        if ($checkChaveResult->num_rows > 0) {
                 
            $row       = $checkChaveResult->fetch_assoc();
            $meuSaldo  = $row["saldo"];

            
            // Verificar se a chave PIX existe no banco de dados
            $checkChaveQuery = "SELECT * FROM contas WHERE chave_pix = '$chavePix'";
            $checkChaveResult = $conn->query($checkChaveQuery);

            if ($checkChaveResult->num_rows > 0) {
                
                // Chave PIX encontrada, verificar saldo do usuário
                $row       = $checkChaveResult->fetch_assoc();
                $destinatarioId = $row["id"];
                $saldo     = $row["saldo"];

                if ($meuSaldo >= $valor) {


                    // Realizar a transferência
                    $novaSaldo = $meuSaldo - $valor;



                    // Atualizar saldo do usuário remetente
                    $updateSaldoQuery = "UPDATE contas SET saldo = '$novaSaldo' WHERE id = '".$_SESSION['usuario']['id']."'"; 

                    // Obter informações do usuário destinatário
                    $infoDestinatarioQuery = "SELECT * FROM contas WHERE id = '$destinatarioId'";
                    $infoDestinatarioResult = $conn->query($infoDestinatarioQuery);
                    $rowDestinatario = $infoDestinatarioResult->fetch_assoc();

                    $saldoDestinatario = $rowDestinatario["saldo"];
                    $novoSaldoDestinatario = $saldoDestinatario + $valor;
                    $destinatarioId = $rowDestinatario["id"];

                    // Atualizar saldo do usuário destinatário
                    $updateSaldoDestinatarioQuery = "UPDATE contas SET saldo = '$novoSaldoDestinatario' WHERE id = '$destinatarioId'";


                    $sqlTrabsacai = "INSERT INTO transacoes(usuario_origem, usuario_destino, chave_pix, descricao, valor) VALUES ('".$_SESSION['usuario']['id']."', '$destinatarioId', '$chavePix', '$descricao', '$valor')";

                    $_SESSION['usuario']['saldo']   = $novaSaldo;

                    if ($conn->query($updateSaldoQuery) === TRUE && $conn->query($updateSaldoDestinatarioQuery) === TRUE && $conn->query($sqlTrabsacai) === TRUE) {
                        echo '<div class="alert alert-success mb-4" role="alert">
                            <h3>Oba! transferência realizada com sucesso!</h3>
                        </div>';
                        
                    }    else {
        
                        echo '<div class="alert alert-danger mb-4" role="alert">
                            <h3>'.$conn->error.'</h3>
                        </div>';
                    }
            

                  

                    $conn->close();

                } else {
                    echo '<div class="alert alert-danger mb-4" role="alert">
                        <h3>Saldo insuficiente. Transação não autorizada</h3>
                    </div>';
                }
            } else {
                echo '<div class="alert alert-danger mb-4" role="alert">
                        <h3>Chave PIX inválida. Verifique novamente.</h3>
                    </div>';
            }
        }

        
    }

    ?>

    <div class="card shadow mb-4">
        
  

        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Trasnferência via Pix</h6>
           
        </div>
        <!-- Card Body -->
        <div class="card-body">
        <form action="pix.php" method="POST">
            <div class="form-group">
                <label for="chavePix">Chave PIX:</label>
                <input type="text" class="form-control" id="chavePix" name="chave" placeholder="Digite a chave PIX">
            </div>
            <div class="form-group">
                <label for="valor">Valor:</label>
                <input type="text" class="form-control" id="valor" name="valor" placeholder="Digite o valor da transferência">
            </div>
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="3" placeholder="Digite uma descrição"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Transferir</button>
        </form>
        </div>
    </div>
</div>

</div>

<?php require_once "rodape.php"; ?>
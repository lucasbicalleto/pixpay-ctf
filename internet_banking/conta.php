<?php require_once "cabecalho.php"; ?>


<div class="container-fluid">

<div class="row">

<!-- Area Chart -->
<div class="col-xl-12 col-lg-12">

  
<?php
 
    // Verifica se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obter os dados do formulário
        $nome  = $_POST["nome"];
        $email = $_POST["email"];
        $foto  = $_FILES["foto"];
        $pix   = $_POST["pix"];

        // Processar o upload da imagem
        if ($foto["error"] == UPLOAD_ERR_OK) {
            $nomeFoto = $foto["name"];
            $caminhoFoto = "imagens/" . $nomeFoto;
            move_uploaded_file($foto["tmp_name"], $caminhoFoto);
        }

        // Dados de conexão com o banco de dados
        require_once("../banco.php");

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }

        $uploadFoto  = (isset($caminhoFoto) && !empty($caminhoFoto)) ? ", foto = '$caminhoFoto'" : "";
        $updatePix   = (isset($pix)         && !empty($pix))         ? ", chave_pix = '$pix'"    : "";

        // Atualizar os dados do usuário no banco de dados
        $sql = "UPDATE contas SET nome = '$nome', email = '$email' $uploadFoto $updatePix WHERE id = ".$_SESSION['usuario']['id'].""; // Substitua 1 pelo ID do usuário desejado

        $_SESSION['usuario']['nome']   = $nome;
        $_SESSION['usuario']['email']  = $email;

        if (isset($updatePix) && !empty($updatePix)) {
            $_SESSION['usuario']['chave_pix'] = $pix;
        }

        if (isset($caminhoFoto)) {
            $_SESSION['usuario']['foto'] = $caminhoFoto;
        }
        

        if ($conn->query($sql) === TRUE) {
            echo '<div class="alert alert-success mb-4" role="alert">
                <h3>Oba! Dados atualizados com sucesso!!</h3>
            </div>';
        } else {
        
            echo '<div class="alert alert-danger mb-4" role="alert">
                <h3>'.$conn->error.'</h3>
            </div>';
        }

        // Fechar a conexão com o banco de dados
        $conn->close();
    }
    ?>


    <div class="card shadow mb-4">
    
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Dados da Conta</h6>
        </div>

        <div class="card-body">
        <form action="conta.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?= (isset($_SESSION['usuario']['nome'])) ? $_SESSION['usuario']['nome'] : "";  ?>">
            </div>
            <div class="form-group">
                <label for="chave_pix">Chave Pix:</label>
                <input type="text" class="form-control" id="chave_pix" name="pix" value="<?= (isset($_SESSION['usuario']['chave_pix'])) ? $_SESSION['usuario']['chave_pix'] : "";  ?>">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" readonly="readonly" value="<?= (isset($_SESSION['usuario']['email'])) ? $_SESSION['usuario']['email'] : "";  ?>">
            </div>
            <div class="form-group">
                <label for="foto">Foto de Perfil:</label>
                <input type="file" class="form-control-file" id="foto" name="foto">
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
        </div>
    </div>
</div>

</div>

<?php require_once "rodape.php"; ?>
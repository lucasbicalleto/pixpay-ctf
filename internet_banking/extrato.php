<?php require_once "cabecalho.php"; ?>


<div class="container-fluid">

<div class="row">

<!-- Area Chart -->
<div class="col-xl-12 col-lg-12">

  


    <div class="card shadow mb-4">
        
  

        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Trasnferência via Pix</h6>
           
        </div>
        <!-- Card Body -->
        <div class="card-body">


        <table class="table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Chave PIX</th>
              <th>Descrição</th>
              <th>Valor</th>
              <th>Data</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Realize a conexão com o banco de dados
            require_once("../banco.php");

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Falha na conexão com o banco de dados: " . $conn->connect_error);
            }

            // Consulta para obter todas as transações
            $query = "SELECT * FROM transacoes ";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                // Loop através das transações
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['chave_pix'] . "</td>";
                    echo "<td>" . $row['descricao'] . "</td>";
                    echo "<td>R$ " . number_format($row['valor'],2,',','.') . "</td>";
                    echo "<td>" . $row['data'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Nenhuma transação encontrada.</td></tr>";
            }

            $conn->close();
            ?>
          </tbody>
        </table>

        </div>
    </div>
</div>

</div>

<?php require_once "rodape.php"; ?>
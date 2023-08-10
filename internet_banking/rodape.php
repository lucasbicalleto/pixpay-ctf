</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2021</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
    <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="login.php">Logout</a>
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

<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>
<script>
    // Função para popular os dados na tela
    function popularDadosUsuario(usuario) {
      // Popula o ID do usuário
      if ($("#countTransacao")) {
        $("#countTransacao").html(usuario.total_transacoes);
      }
      

      // Popula o saldo do usuário
      if ($("#sanldoAtual")) {
        $("#sanldoAtual").html(usuario.saldo_total);
        }
      

      // Popula as transações do usuário
      var transacoesHtml = "";
      for (var i = 0; i < usuario.transacoes.length; i++) {
        var transacao = usuario.transacoes[i];
        transacoesHtml += "<li>" + transacao.descricao + " - Valor: " + transacao.valor + "</li>";
      }
      $("#usuario-transacoes").html(transacoesHtml);
    }

    // Obtém o ID do usuário
    var usuarioId = <?= (isset($_SESSION['usuario']['id'])) ? $_SESSION['usuario']['id'] : 0; ?> // Substitua pelo ID do usuário desejado

    // URL do script PHP que retorna os dados do usuário
    var url = "http://localhost/projetos/pixpay/data.php?id=" + usuarioId;

    // Faz a requisição AJAX
    $.ajax({
      url: url,
      method: "GET",
      dataType: "json",
      success: function(response) {
        // Popula os dados na tela
        popularDadosUsuario(response);
      },
      error: function() {
        console.log("Erro ao obter os dados do usuário.");
      }
    });
  </script>
</body>

</html>
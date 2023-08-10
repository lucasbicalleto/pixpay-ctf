<?php 
    $arquivoAtual = basename($_SERVER['PHP_SELF']);

    if ($arquivoAtual == 'fl4g.php') {
        exit;
    }

    echo "FLAG: Pixpay{P@th_PW3d}";
    exit;
?>
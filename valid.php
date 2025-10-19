<?php
if(isset($_GET['k'])) {
    require_once('./admin/inc/inc.configdb.php');

    $sqlResultado   = "SELECT 
        md5(id)
    FROM cn_busca_testamentos
    WHERE md5(id) = '".$_GET['k']."';";

    $queryResultado = $dba->query($sqlResultado);
    $qntdResultado  = $dba->rows($queryResultado);

    if($qntdResultado > 0) {
        echo '<br><br><br>';
        echo '<div style="text-align:center;"><h1>Código válido, emitido pelo COLÉGIO NOTARIAL DO BRASIL - SEÇÃO RS</h1></div>';
    } else {
        echo '<br><br><br>';
        echo '<div style="text-align:center;"><h1>Código inválido</h1></div>';
    }

} else {
    echo '<br><br><br>';
    echo '<div style="text-align:center;"><h1>Código inválido</h1></div>';
}
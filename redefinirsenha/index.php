<?php
include('../admin/inc/inc.configdb.php');
include('../admin/inc/class.TemplatePower.php');
include('../admin/inc/inc.lib.php');

$tpl = new TemplatePower('../admin/tpl/redefinir-senha.html');
$tpl->prepare();

// include('./menu.php'); //monta o menu de acordo com o usuário
include('../admin/inc/inc.mensagens.php'); //mensagens e alertas

$tpl->gotoBlock('_ROOT');

// $tpl->assign('title', 'Redefinir Senha | Feito - Programa de Benefícios'); 
// $tpl->assign('description', '.');   
// $tpl->assign('image', 'https://'.$_SERVER['SERVER_NAME'].'/img/icon-feito.jpg');
// $tpl->assign('url', 'https://'.$_SERVER['SERVER_NAME'].''.$_SERVER ['REQUEST_URI'].'');

if (isset($_GET['aut']) && !empty($_GET['aut'])) {
    $aut = addslashes(trim($_GET['aut']));

    $sql = "SELECT data_hora_registro, status FROM cn_recuperar_senha WHERE aut='$aut'";
    $query = $dba->query($sql);
    $qntd = $dba->rows($query);
    if ($qntd > 0) {
        $vet = $dba->fetch($query);
        $data_hora_registro = $vet[0];
        $status = $vet[1];

        if ($status == 1) { // Verifica se link está válido

            $datatime1 = new DateTime($data_hora_registro);
            $datatime2 = new DateTime(date('Y-m-d H:i:s'));

            $data1  = $datatime1->format('Y-m-d H:i:s');
            $data2  = $datatime2->format('Y-m-d H:i:s');

            $diff = $datatime1->diff($datatime2);
            $horas = $diff->h + ($diff->days * 24);

            if ($horas >= 24) { // verifica se prazo está expirado

                $sql2 = "UPDATE cn_recuperar_senha SET status=2 WHERE aut='$aut'"; // Atualiza status para inválido
                $dba->query($sql2);
                // header('Location: ./recuperarsenha/?msg=pwd05');
            }

            $tpl->newBlock('redefinir-senha');
            $tpl->assign('aut', $aut);

        } else {
            $tpl->newBlock('link-invalido');
        }

    } else {
        $tpl->newBlock('link-invalido');
    }

} else {
    // $tpl->newBlock('link-invalido');
    header('Location: https://pokeresporteclube.com.br/');
}

$tpl->printToScreen();
?>
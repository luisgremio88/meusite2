<?php
require_once('./admin/inc/class.TemplatePower.php');
require_once('./admin/inc/inc.lib.php');

$tpl = new TemplatePower('integracao-unicred.html');
$tpl->prepare();

//--------------------------

    session_start();
    if (isset($_SESSION['codtit']) && !empty($_SESSION['codtit'])) {
        $codtit = $_SESSION['codtit'];
        
        $tpl->newBlock('result');
        $tpl->assign('codtit', $codtit);
    }

//--------------------------

$tpl->printToScreen();
?>
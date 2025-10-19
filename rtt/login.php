<?php
require_once('../inc/inc.autoload.php');
require_once('../inc/inc.globals.php');
require_once('./config/inc.functions.php');

//layout "mestre"
$basedir = './static/';
$tpl = new TemplatePower($basedir.'_login.html'); 
$tpl->prepare();

// ---------- INI PROCESSAMENTO ------------

$act = base64_encode('login');
$tpl->assign('act', $act);

include_once('./config/inc.messages.php');

// ---------- FIM PROCESSAMENTO ------------

$tpl->printToScreen();
?>
<?php
require_once('../_configs/inc.autoload.php');
require_once('../_configs/inc.functions.php');

//layout "mestre"
$tpl = new TemplatePower('_master.htm'); 
$tpl->assignInclude('content', 'selecionar.htm');
$tpl->prepare();

// ---------- PROCESSAMENTO ------------

if ( isset($_REQUEST['sub1']) && !empty($_REQUEST['sub1']) ) 
{
	//pega os dados enviados do form
	$host = $_REQUEST['host'];
	$user = $_REQUEST['user'];
	$pass = $_REQUEST['pass'];
	$base = $_REQUEST['base'];
	$tipo = $_REQUEST['tipo'];
	
	if ($tipo === 'mysql') {
		$link = "mysql:host=$host;dbname=$base";
		$selmys = 'selected="selected"';
		$selora = '';
		$sqlbas = "SHOW DATABASES";
		$sqltab = "SHOW TABLES"; 
		$indtab = 0;
		$sqlviw = "SELECT * FROM information_schema.views"; 
		$indviw = 0;
	}
	if ($tipo === 'oracle') {
		$link = "oci:dbname=$base;charset=UTF8";
		$selora = 'selected="selected"';
		$selmys = '';
		$sqlbas = "Select username as database From sys.All_Users order by username";
		$owner = strtoupper($user);
		$sqltab = "Select TABLE_NAME From All_Tables Where Owner = '$owner' order by TABLE_NAME"; 
		$indtab = 'TABLE_NAME';
		$sqlviw = "Select VIEW_NAME From All_Views Where Owner = '$owner' order by VIEW_NAME"; 
		$indviw = 'VIEW_NAME';
	}
	if ($tipo === 'mssql') {
		//$link = "sqlsrv:Server=$host;Database=$base;";
		$link = "sqlsrv:Server=$host,1433;Database=$base;Encrypt=0;TrustServerCertificate=1";
		$selmys = 'selected="selected"';
		$selora = '';
		$sqlbas = "SELECT * FROM sys.sysdatabases";
		$sqltab = "SELECT * FROM sys.tables"; 
		$indtab = 0;
		$sqlviw = "SELECT * FROM sys.views"; 
		$indviw = 0;
	}

	//mostra na tela
	$tpl->assign('host', $host);
	$tpl->assign('user', $user);
	$tpl->assign('pass', $pass);
	$tpl->assign('base', $base);
	$tpl->assign('tipo', $tipo);
	$tpl->assign('selmys', $selmys);
	$tpl->assign('selora', $selora);
	$tpl->assign('selsql', $selsql);

	//conexao
	try
	{
		//$opts = array(PDO::ATTR_AUTOCOMMIT=>TRUE);
		$cnx = new PDO($link, $user, $pass/*, $opts*/);
		$cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
		//lista as bases disponiveis
		$res = $cnx->query($sqlbas);
		foreach ($res as $vet) {
			$bas = $vet[0]; //ou $vet['DATABASE'];
			$tpl->newBlock('bases');
			$tpl->assign('bas', $bas);
			if ($bas == $base) {
				$tpl->assign('sel', 'selected="selected"');
			} else {
				$tpl->assign('sel', '');
			}
		}

		//para exibir as tabelas da base selecionada
		$tpl->newBlock('selecionar-table');
		//seleciona as tabelas para exibir no select
		//obter os nomes das tabelas
		$res = $cnx->query($sqltab);
		foreach ($res as $vet) {
			$tab = $vet[$indtab];

			$tpl->newBlock('tabelas1');
			$tpl->assign('tab', $tab);
			
			$tpl->newBlock('tabelas2');
			$tpl->assign('tab', $tab);
		}
		//para mostrar nos campos ocultos que vao enviar ao exec.php
		$tpl->gotoBlock('selecionar-table');
		$tpl->assign('host', $host);
		$tpl->assign('user', $user);
		$tpl->assign('pass', $pass);
		$tpl->assign('base', $base);
		$tpl->assign('tipo', $tipo);

		//---------------------------------------------------------------

		//para exibir as views da base selecionada
		$tpl->newBlock('selecionar-view');
		//seleciona as views para exibir no select
		//obter os nomes das views
		$res = $cnx->query($sqlviw);
		foreach ($res as $vet) {
			$viw = $vet[$indviw];

			$tpl->newBlock('views1');
			$tpl->assign('viw', $viw);
			
			$tpl->newBlock('views2');
			$tpl->assign('viw', $viw);
		}
		//para mostrar nos campos ocultos que vao enviar ao exec.php
		$tpl->gotoBlock('selecionar-view');
		$tpl->assign('host', $host);
		$tpl->assign('user', $user);
		$tpl->assign('pass', $pass);
		$tpl->assign('base', $base);
		$tpl->assign('tipo', $tipo);
	}
	catch(PDOException $e) 
	{
		die('ERROR: '.$e->getMessage());
		echo '<pre>'; print_r($e); exit;
	}
}
else 
{
	//mostrar na 1ra vez - tirar esse else depois
	$host = 'mysql02-farm2.uni5.net';
	$base = 'colnotrs';
	$user = 'colnotrs';
	$pass = 'c01n0t2022';
	$tipo = 'mysql';
	
	$tpl->assign('host', $host);
	$tpl->assign('user', $user);
	$tpl->assign('pass', $pass);
	$tpl->assign('base', $base);
	$tpl->assign('tipo', $tipo);
}

// ---------- PROCESSAMENTO ------------

$tpl->printToScreen();
?>
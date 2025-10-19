<?php
require_once('../_configs/inc.autoload.php');
require_once('../_configs/inc.functions.php');


// ---------- PROCESSAMENTO ------------
if ( isset($_REQUEST['sub']) && !empty($_REQUEST['sub']) ) 
{
	$host = $_REQUEST['host'];
	$user = $_REQUEST['user'];
	$pass = $_REQUEST['pass'];
	$base = $_REQUEST['base'];
	$tipo = $_REQUEST['tipo'];

	if ($tipo === 'mysql') {
		$link = "mysql:host=$host;dbname=$base";
		$sqlbas = "SHOW DATABASES";
		$sqlviw = "SHOW VIEWS"; 
		$indviw = 0;
	}
	if ($tipo === 'oracle') {
		$link = "oci:dbname=$base;charset=UTF8";
		$sqlbas = "Select username as database From sys.All_Users order by username";
		$owner = strtoupper($user);
		$sqlviw = "Select VIEW_NAME From All_Views Where Owner = '$owner'"; 
		$indviw = 'VIEW_NAME';
	}
	if ($tipo === 'mssql') {
		$link = "sqlsrv:Server=$host,1433;Database=$base;Encrypt=0;TrustServerCertificate=1";
		$sqlbas = "SELECT * FROM sys.sysdatabases";
		$sqltab = "SELECT * FROM sys.tables"; 
		$indtab = 0;
		$sqlviw = "SELECT * FROM sys.views"; 
		$indviw = 0;
	}
	
	//conexao
	try
	{
		//$opts = array(PDO::ATTR_AUTOCOMMIT=>TRUE);
		$cnx = new PDO($link, $user, $pass/*, $opts*/);
		$cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// ----------- tabelas ------------
		if (isset($_REQUEST['tab']) && !empty($_REQUEST['tab'])) 
		{	
			$tab = $_REQUEST['tab'];
			if ($tab == '%') {
				if ($tipo === 'mysql') {
					$sqltab = "SHOW TABLES"; 
					$indtab = 0;
				}
				if ($tipo === 'oracle') {
					$owner = strtoupper($user);
					$sqltab = "Select TABLE_NAME From All_Tables Where Owner = '$owner'"; 
					$indtab = 'TABLE_NAME';
				}
				if ($tipo === 'mssql') {
					$sqltab = "select ta.name from sys.tables ta"; 
					$indtab = 'name';
				}
			} 
			else {
				if ($tipo === 'mysql') {
					$sqltab = "SHOW TABLES WHERE Tables_in_$base LIKE '$tab'";
					$indtab = 0;
				}
				if ($tipo === 'oracle') {
					$owner = strtoupper($user);
					$tab = strtoupper($tab);
					$sqltab = "Select TABLE_NAME From All_Tables Where Owner = '$owner' and TABLE_NAME = '$tab'"; 
					$indtab = 'TABLE_NAME';
				}
				if ($tipo === 'mssql') {
					$sqltab = "select ta.name from sys.tables ta where ta.name = '$tab'"; 
					$indtab = 'name';
				}
			}

			$restab = $cnx->query($sqltab);
			foreach ($restab as $rowtab) 
			{
				$txt = '';
				//layout "mestre"
				$tpl = new TemplatePower('classe-modelo.tpl'); 
				$tpl->prepare();
				
				$tabela = $rowtab[$indtab];
				$tpl->assign('tab', ucfirst(strtolower($tabela)));

				//ini - pegar os nomes das colunas da tabela
				if ($tipo === 'mysql') {
					$res = $cnx->query("SHOW COLUMNS FROM $tabela");
					$indcol = 'Field';
				}
				if ($tipo === 'oracle') {
					$tabela = strtoupper($tabela);
					$res = $cnx->query("select * from all_tab_columns where owner = '$owner' and table_name = '$tabela'");
					$indcol = 'COLUMN_NAME';
				}
				if ($tipo === 'mssql') {
					$res = $cnx->query("select * from sys.columns WHERE object_id = object_id('$tabela')");
					$indcol = 'name';
				}
				foreach ($res as $row) {
					$col = $row[$indcol];
					$col = strtolower($col);
					$col2 = ucfirst($col); //primeira letra Maiuscula
					
					$tpl->newBlock('atributos');
					$tpl->assign('col', $col);
					$tpl->assign('col2', $col2);
					
					$tpl->newBlock('metodos');
					$tpl->assign('col', $col);
					$tpl->assign('col2', $col2);
				}
				//fim - mesclar com o template para gerar 1 classe

				$txt = $tpl->getOutputContent();
				//cria um arquivo e envia ao solicitante
				$tabela = strtolower($tabela);
				$tabela = ucfirst($tabela);
				$dir = '../orm/'.$user.'-'.$base.'/';
				if (is_dir($dir)) {
					$okd = true;
				} else {
					$okd = mkdir($dir, 0777); 
				}
				if ($okd) {
					$arq = 'class.'.$tabela.'.php';
					$ref = fopen($dir.$arq, 'w');
					$codigo = 
	"<?php
		$txt 
	?>";
					fwrite($ref, $codigo);
					fclose($ref);
				}
			}
			//fim do loop das tabelas
		}
		// ----------- tabelas ------------


		
		// ----------- views ------------
		if (isset($_REQUEST['viw']) && !empty($_REQUEST['viw'])) 
		{	
			$viw = $_REQUEST['viw'];
			if ($viw == '%') {
				if ($tipo === 'mysql') {
					$sqlviw = "SHOW VIEWS"; 
					$indviw = 0;
				}
				if ($tipo === 'oracle') {
					$owner = strtoupper($user);
					$sqlviw = "Select VIEW_NAME From All_Views Where Owner = '$owner'"; 
					$indviw = 'VIEW_NAME';
				}
				if ($tipo === 'mssql') {
					$sqltab = "select ta.name from sys.views ta"; 
					$indtab = 'name';
				}
			} 
			else {
				if ($tipo === 'mysql') {
					$sqlviw = "SHOW VIEWS WHERE Views_in_$base LIKE '$viw'";
				}
				if ($tipo === 'oracle') {
					$owner = strtoupper($user);
					$viw = strtoupper($viw);
					$sqlviw = "Select VIEW_NAME From All_Views Where Owner = '$owner' and VIEW_NAME = '$viw'"; 
					$indviw = 'VIEW_NAME';
				}
				if ($tipo === 'mssql') {
					$sqltab = "select ta.name from sys.views ta where ta.name = '$tab'"; 
					$indtab = 'name';
				}
			}
			$resviw = $cnx->query($sqlviw);
			foreach ($resviw as $rowviw) 
			{
				$txt = '';
				//layout "mestre"
				$tpl = new TemplatePower('classe-modelo.tpl'); 
				$tpl->prepare();
				
				$tabela = $rowviw[$indviw];
				$tpl->assign('tab', ucfirst(strtolower($tabela)));

				//ini - pegar os nomes das colunas da view
				if ($tipo === 'mysql') {
					$res = $cnx->query("SHOW COLUMNS FROM $tabela");
					$indcol = 'Field';
				}
				if ($tipo === 'oracle') {
					$tabela = strtoupper($tabela);
					$res = $cnx->query("select * from all_tab_columns where owner = '$owner' and table_name = '$tabela'");
					$indcol = 'COLUMN_NAME';
				}
				if ($tipo === 'mssql') {
					$res = $cnx->query("select * from sys.columns WHERE object_id = object_id('$tabela')");
					$indcol = 'name';
				}
				foreach ($res as $row) {
					$col = $row[$indcol];
					$col = strtolower($col);
					$col2 = ucfirst($col); //primeira letra Maiuscula
					
					$tpl->newBlock('atributos');
					$tpl->assign('col', $col);
					$tpl->assign('col2', $col2);
					
					$tpl->newBlock('metodos');
					$tpl->assign('col', $col);
					$tpl->assign('col2', $col2);
				}
				//fim - mesclar com o template para gerar 1 classe

				$txt = $tpl->getOutputContent();
				//cria um arquivo e envia ao solicitante
				$tabela = strtolower($tabela);
				$tabela = ucfirst($tabela);
				$dir = '../orm/'.$user.'-'.$base.'/';
				if (is_dir($dir)) {
					$okd = true;
				} else {
					$okd = mkdir($dir, 0777); 
				}
				if ($okd) {
					$arq = 'class.'.$tabela.'.php';
					$ref = fopen($dir.$arq, 'w');
					$codigo = 
	"<?php
		$txt 
	?>";
					fwrite($ref, $codigo);
					fclose($ref);
				}
			}
			//fim loop views
		}
		// ----------- views ------------
	
	}
	catch(PDOException $e) 
	{
		die('ERROR: '.$e->getMessage());
		echo '<pre>'; print_r($e); exit;
	}
}
else 
{
	header('location: ../web/selecionar.php');
	exit;
}
// ---------- PROCESSAMENTO ------------



if (isset($_REQUEST['exp']) && $_REQUEST['exp'] == 'sim')
{
	//se for todos, pega do diret�rio e compacta
	if ($tab == '%' or $viw == '%') {
		$arquivo = 'ClassesMOR.zip';
		$zip = new ZipArchive();
		$zip->open($arquivo, ZIPARCHIVE::CREATE);
		$diretorio = dir('../orm/'.$host.'-'.$user.'-'.$base.'/');
		while($arqdir = $diretorio->read()) {
			$zip->addFile('../orm/'.$host.'-'.$user.'-'.$base.'/'.$arqdir);
		}
		$diretorio->close();
		$zip->close();
		header("Content-Type: application/zip"); // informa o tipo do arquivo ao navegador
		header("Content-Transfer-Encoding: Binary");
	}
	else {
	//se for apenas 1
		$arquivo = $dir.$arq;
		header("Content-Type: PHP"); // informa o tipo do arquivo ao navegador
	}

	header("Content-Length: ".filesize($arquivo)); //informa o tamanho do arquivo ao navegador
	header("Content-Disposition: attachment; filename=".basename($arquivo)); //informa ao navegador que � tipo anexo e faz abrir a janela de download, tambem informa o nome do arquivo
	readfile($arquivo); // le o arquivo
	exit; // aborta pos-acoes
}
else 
{
	//aviso na tela e link de retorno
	echo '<a href="javascript:history.go(-1);">&laquo; Voltar</a>';
	echo '<br />';
	echo '<hr />';
	echo '<br />';

	if ((isset($tab) && $tab!='%') or (isset($viw) && $viw!='%')) {
		//mostra na tela
		echo '<pre>';
		echo $txt;
		echo '</pre>';
	}
	else {
		//mostra aviso para pegar no FTP
		echo 'Classes ORM geradas com sucesso. Baixe-as do sFTP.';
	}
}
?>
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
		// $opts = array(PDO::ATTR_AUTOCOMMIT=>TRUE);
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
				$tpl = new TemplatePower('classe-modelo-dao.tpl'); 
				$tpl->prepare();
				
				$tabela = $rowtab[$indtab];
				$tpl->assign('tab', ucfirst(strtolower($tabela)));
				$tpl->assign('tab2', $tabela); 
				
				//$dba->connect($host, $user, $pass, $base);
				//new PDO($link, $user, $pass, $opts);
				
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
				$rows = $res->fetchAll();
				$num = count($rows);

				//loop das colunas
				$i = 0;
				foreach ($rows as $row) {
					$col = $row[$indcol];
					$col2 = ucfirst(strtolower($col)); //primeira letra Maiuscula
					$colid = '';
					if ($tipo === 'mysql') {
						if ($row['Key'] == 'PRI') 
							$colid = $col;
					}
					if ($tipo === 'oracle') {
						$sqlcon = "select CONSTRAINT_NAME from all_constraints ac where ac.table_name = '$tabela' and ac.constraint_type = 'P'";
						$rescon = $cnx->query($sqlcon);
						$vetcon = $rescon->fetchAll();
						if (count($vetcon) > 0) {
							$connam = $vetcon[0]['CONSTRAINT_NAME'];
							$sqlcol = "select COLUMN_NAME from all_cons_columns acc where acc.CONSTRAINT_NAME = '$connam' and acc.TABLE_NAME = '$tabela'";
							$rescol = $cnx->query($sqlcol);
							$vetcol = $rescol->fetchAll();
							$colnam = $vetcol[0]['COLUMN_NAME'];
							if (!empty($colnam))
								$colid = $colnam;
						} else {
							$colid = 'ID'; // !!rever isso!!
						}
					}
					if ($tipo === 'mssql') {
						$sqlcon = "SELECT * FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE TABLE_NAME = '$tabela' ";
						$rescon = $cnx->query($sqlcon);
						$vetcon = $rescon->fetchAll();
						if (count($vetcon) > 0) {
							$connam = $vetcon[0]['CONSTRAINT_NAME'];
							$sqlcol = "SELECT COLUMN_NAME from INFORMATION_SCHEMA.KEY_COLUMN_USAGE kcu where kcu.CONSTRAINT_NAME = '$connam' and kcu.TABLE_NAME = '$tabela'";
							$rescol = $cnx->query($sqlcol);
							$vetcol = $rescol->fetchAll();
							$colnam = $vetcol[0]['COLUMN_NAME'];
							if (!empty($colnam))
								$colid = $colnam;
						} else {
							$colid = 'ID'; // !!rever isso!!
						}
					}
					
					//para insert
					if ($col != $colid) {
						$tpl->newBlock('dados_ins');
						$tpl->assign('col', $col);
						$tpl->assign('col2', $col2);
					}
					
					if ($col != $colid) {
						$tpl->newBlock('colunas1_ins');
						$tpl->assign('col', $col);
						$tpl->assign('col2', $col2);
						if ($i+1 < $num)
							$tpl->assign('vir', ',');
					}
					
					if ($col != $colid) {
						$tpl->newBlock('colunas2_ins');
						$tpl->assign('col', $col);
						$tpl->assign('col2', $col2);
						if ($i+1 < $num)
							$tpl->assign('vir', ',');
					}
					//-----------
					
					//para update
					$tpl->newBlock('dados_upd');
					$tpl->assign('col', $col);
					$tpl->assign('col2', $col2);
					
					if ($col != $colid) {
						$tpl->newBlock('colunas1_upd');
						$tpl->assign('col', $col);
						$tpl->assign('col2', $col2);
						if ($i+1 < $num)
							$tpl->assign('vir', ',');
					} else {
						$tpl->gotoBlock('_ROOT');
						$tpl->assign('colid', $colid);
					}
					//-----------
					
					//para delete
					//$tpl->newBlock('dados_del');
					$tpl->assign('col', $col);
					$tpl->assign('col2', $col2);
					
					if ($col != $colid) {
						//$tpl->gotoBlock('_ROOT');
						//$tpl->assign('colid', $colid);
					} else {
						$tpl->gotoBlock('_ROOT');
						$tpl->assign('colid', $colid);
					}
					//-----------
					
					//para selecionar todos
					// $tpl->newBlock('colunas1_selAll');
					// $tpl->assign('col', strtolower($col));
					//$tpl->assign('col2', $col2);
					//-----------
					
					//para selecionar coforme filtro
					//$tpl->newBlock('colunas1_selFil');
					//$tpl->assign('col', $col);
					//$tpl->assign('col2', $col2);
					//-----------

					$i++;
				}
				//foreach das colunas
				

				//FKs
				if ($tipo === 'mysql') 
				{
					//PARA GERAR OS METODOS COM OS INNER JOIN
					$base2 = 'information_schema';
					$link2 = "mysql:host=$host;dbname=$base2";
					$cnx1 = new PDO($link2, $user, $pass);
					$sql1 = "SELECT TABLE_NAME, COLUMN_NAME FROM $base2.KEY_COLUMN_USAGE 
							WHERE REFERENCED_TABLE_NAME = '$tabela' 
							AND REFERENCED_COLUMN_NAME = '$colid' AND TABLE_SCHEMA = '$base';";
					$res1 = $cnx1->query($sql1);
					$rows1 = $res1->fetchAll();
					$num1 = count($rows1);
					
					if ($num1 > 0) {
						$tpl->newBlock('temFK');
						$tpl->assign('tab2', strtolower($tabela));
						
						$vet = array();
						foreach ($rows1 as $linha) {
							$tabFK = $linha['TABLE_NAME'];
							$colFK = $linha['COLUMN_NAME'];
							
							//criar um array para gravar os nomes dos metodos
							//se ja tem o metodo criado nao cria novamente
							if (!in_array($tabFK, $vet)) 
							{
								$tpl->newBlock('fks');
								$tpl->assign('tab', ucfirst(strtolower($tabela)));
								$tpl->assign('tabFK', ucfirst(strtolower($tabFK)));
								$tpl->assign('tab2', strtolower($tabela));
								$tpl->assign('tab2FK', strtolower($tabFK));
								$tpl->assign('colpk', $colid);
								$tpl->assign('colfk', $colFK);
								
								//$cnx2 = $dba->connect($host, $user, $pass, $base);
								$cnx2 = new PDO($link, $user, $pass);
								$sql2 = "SHOW COLUMNS FROM $tabFK;";
								$res2 = $cnx2->query($sql2);
								$rows2 = $res2->fetchAll();
								$num2 = count($rows2);
								//$num2 = $cnx2->num_rows;
								foreach ($res2 as $linha2) {
									$col = $linha2['Field'];
									$tpl->newBlock('colunas1_selFks');
									$tpl->assign('col', $col);
								}

								array_push($vet, $tabFK);
							}
							
						}
					}

					//PARA GERAR OS METODOS COM OS INNER JOIN - 2 ("baixo pra cima")
					$base2 = 'information_schema';
					$link2 = "mysql:host=$host;dbname=$base2";
					$cnx1 = new PDO($link2, $user, $pass);
					$sql1 = "SELECT * FROM $base2.KEY_COLUMN_USAGE 
								WHERE TABLE_NAME = '$tabela' 
								AND CONSTRAINT_NAME <> 'PRIMARY' 
								AND REFERENCED_COLUMN_NAME <> '' AND REFERENCED_TABLE_NAME <> ''
								AND TABLE_SCHEMA = '$base';"; //echo $sql1 .'<br>';
					$res1 = $cnx1->query($sql1);
					$rows1 = $res1->fetchAll();
					$num1 = count($rows1);
					
					if ($num1 > 0) {
						$tpl->newBlock('temFK2');
						$tpl->assign('tab2', strtolower($tabela));
						
						$vet = array();
						foreach ($rows1 as $linha) {
							$tabPK = $linha['REFERENCED_TABLE_NAME'];
							$colPK = $linha['REFERENCED_COLUMN_NAME'];
							$colFK = $linha['COLUMN_NAME'];
							
							//criar um array para gravar os nomes dos metodos
							//se ja tem o metodo criado nao cria novamente
							if (!in_array($tabPK, $vet)) 
							{
								// $tabPK = strtolower($tabPK);
								// $colPK = strtolower($colPK);
								// $colFK = strtolower($colFK);

								$tpl->newBlock('fks2');
								$tpl->assign('tabPK', ucfirst(strtolower($tabPK)));
								$tpl->assign('tab2PK', strtolower($tabPK));
								$tpl->assign('colpk', strtolower($colPK));
								$tpl->assign('tab2', strtolower($tabela));
								$tpl->assign('colfk', strtolower($colFK));
								
								//$cnx2 = $dba->connect($host, $user, $pass, $base);
								$cnx2 = new PDO($link, $user, $pass);
								$sql2 = "SHOW COLUMNS FROM $tabPK;"; //die($sql2);
								$res2 = $cnx2->query($sql2);
								$rows2 = $res2->fetchAll();
								$num2 = count($rows2);
								//$num2 = $cnx2->num_rows;
								foreach ($rows2 as $linha2) {
									$col = $linha2['Field'];
									$tpl->newBlock('colunas1_selFks2');
									$tpl->assign('col', strtolower($col));
								}
								
								array_push($vet, $tabPK);
							}
							
						}
					}
					//fim - mesclar com o template para gerar 1 classe
				}


				$tpl->gotoBlock('_ROOT');
				
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
					$arq = 'class.'.$tabela.'DAO.php';
					$ref = fopen($dir.$arq, 'w');
					$codigo = 
	"<?php
		$txt 
	?>";
					fwrite($ref, $codigo);
					fclose($ref);
				}

			}
			//fim while de cada tabela
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
					$sqltab = "select ta.name from sys.tables ta"; 
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
					$sqltab = "select ta.name from sys.tables ta where ta.name = '$tab'"; 
					$indtab = 'name';
				}
			}
			$resviw = $cnx->query($sqlviw);
			foreach ($resviw as $rowviw) 
			{
				$txt = '';
				//layout "mestre"
				$tpl = new TemplatePower('classe-modelo-dao.tpl'); 
				$tpl->prepare();
				
				$tabela = $rowviw[$indviw];
				$tpl->assign('tab', ucfirst(strtolower($tabela)));
				$tpl->assign('tab2', $tabela); 
				
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
				$rows = $res->fetchAll();
				$num = count($rows);
				$i = 0;
				foreach ($rows as $row) {
					$col = $row[$indcol];
					$col2 = ucfirst(strtolower($col)); //primeira letra Maiuscula
					$colid = '';
					if ($tipo === 'mysql') {
						if ($row['Key'] == 'PRI') 
							$colid = $col;
					}
					if ($tipo === 'oracle') {
						$sqlcon = "select CONSTRAINT_NAME from all_constraints ac where ac.table_name = '$tabela' and ac.constraint_type = 'P'";
						$rescon = $cnx->query($sqlcon);
						$vetcon = $rescon->fetchAll();
						if (count($vetcon) > 0) {
							$connam = $vetcon[0]['CONSTRAINT_NAME'];
							$sqlcol = "select COLUMN_NAME from all_cons_columns acc where acc.CONSTRAINT_NAME = '$connam' and acc.TABLE_NAME = '$tabela'";
							$rescol = $cnx->query($sqlcol);
							$vetcol = $rescol->fetchAll();
							$colnam = $vetcol[0]['COLUMN_NAME'];
							if (!empty($colnam))
								$colid = $colnam;
						} else {
							$colid = 'ID'; // !!rever isso!!
						}
					}
					if ($tipo === 'mssql') {
						$sqlcon = "SELECT * FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE TABLE_NAME = '$tabela' ";
						$rescon = $cnx->query($sqlcon);
						$vetcon = $rescon->fetchAll();
						if (count($vetcon) > 0) {
							$connam = $vetcon[0]['CONSTRAINT_NAME'];
							$sqlcol = "SELECT COLUMN_NAME from INFORMATION_SCHEMA.KEY_COLUMN_USAGE kcu where kcu.CONSTRAINT_NAME = '$connam' and kcu.TABLE_NAME = '$tabela'";
							$rescol = $cnx->query($sqlcol);
							$vetcol = $rescol->fetchAll();
							$colnam = $vetcol[0]['COLUMN_NAME'];
							if (!empty($colnam))
								$colid = $colnam;
						} else {
							$colid = 'ID'; // !!rever isso!!
						}
					}
					
					//para insert
					if ($col != $colid) {
						$tpl->newBlock('dados_ins');
						$tpl->assign('col', $col);
						$tpl->assign('col2', $col2);
					}
					
					if ($col != $colid) {
						$tpl->newBlock('colunas1_ins');
						$tpl->assign('col', $col);
						$tpl->assign('col2', $col2);
						if ($i+1 < $num)
							$tpl->assign('vir', ',');
					}
					
					if ($col != $colid) {
						$tpl->newBlock('colunas2_ins');
						$tpl->assign('col', $col);
						$tpl->assign('col2', $col2);
						if ($i+1 < $num)
							$tpl->assign('vir', ',');
					}
					//-----------
					
					//para update
					$tpl->newBlock('dados_upd');
					$tpl->assign('col', $col);
					$tpl->assign('col2', $col2);
					
					if ($col != $colid) {
						$tpl->newBlock('colunas1_upd');
						$tpl->assign('col', $col);
						$tpl->assign('col2', $col2);
						if ($i+1 < $num)
							$tpl->assign('vir', ',');
						$tpl->gotoBlock('_ROOT');
						$tpl->assign('colid', $colid);
					}
					//-----------
					
					//para delete
					//$tpl->newBlock('dados_del');
					$tpl->assign('col', $col);
					$tpl->assign('col2', $col2);
					
					if ($col != $colid) {
						$tpl->gotoBlock('_ROOT');
						$tpl->assign('colid', $colid);
					}
					//-----------
					
					//para selecionar todos
					// $tpl->newBlock('colunas1_selAll');
					// $tpl->assign('col', strtolower($col));
					//$tpl->assign('col2', $col2);
					//-----------
					
					//para selecionar coforme filtro
					//$tpl->newBlock('colunas1_selFil');
					//$tpl->assign('col', $col);
					//$tpl->assign('col2', $col2);
					//-----------

					$i++;
				}

				$tpl->gotoBlock('_ROOT');

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
					$arq = 'class.'.$tabela.'DAO.php';
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
	catch (PDOException $e) 
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
		$arquivo = 'ClassesDAO.zip';
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
	readfile($arquivo); // l� o arquivo
	exit; // aborta p�s-a��es
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
		echo utf8_encode($txt);
		echo '</pre>';
	}
	else {
		//mostra aviso para pegar no FTP
		echo 'Classes DAO geradas com sucesso. Baixe-as do FTP.';
	}
}
?>
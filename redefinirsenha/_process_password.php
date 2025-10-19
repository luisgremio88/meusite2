<?php
include('../admin/inc/inc.configdb.php');
include('../admin/inc/inc.lib.php');

if(empty($_POST['senha'])) {echo "senha"; exit;} 
if(strlen($_POST['senha']) < 6) {echo "senha_caracteres"; exit;}
if(empty($_POST['senha_confirma'])) {echo "senha_confirma"; exit;}            
if($_POST['senha'] != $_POST['senha_confirma']) {echo "senhas_iguais"; exit;}      

$senha = addslashes(trim($_POST['senha'])); 
$senha = password_hash($senha, PASSWORD_DEFAULT);
$aut   = addslashes(trim($_POST['aut']));

$sql = "SELECT tipo_usuario, id_usuario FROM cn_recuperar_senha WHERE aut='$aut'";
$query = $dba->query($sql);
$qntd = $dba->rows($query);
if ($qntd > 0) {
    $vet = $dba->fetch($query);
    $tipo_usuario = $vet[0];
    $id_usuario = $vet[1];

    $sql3 = "UPDATE cn_usuarios_associados SET senha='$senha' WHERE id=$id_usuario"; // Atualiza senha do usuário
    $dba->query($sql3);

    $sql2 = "UPDATE cn_recuperar_senha SET status=2 WHERE tipo_usuario=$tipo_usuario AND id_usuario=$id_usuario AND status=1"; // Atualiza status para inválido
    $dba->query($sql2);

    echo "success";
    exit;

} else {
	echo "error";
	exit;
}

?>
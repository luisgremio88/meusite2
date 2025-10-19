<?php

/**
 * @author			Roberto Rotondo - v 1.0 - mai/2022
 * @description 	Serviço
 * @params
 */

header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Credentials: true');
header('Content-type: application/json');
header('X-Content-Type-Options: nosniff');

include('../admin/inc/inc.configdb.php');
include('../admin/inc/inc.lib.php');
include('../admin/inc/phpmailer/PHPMailerAutoload.php');
include('./auth.php');

$array = array();

$json  = file_get_contents('php://input');

$obj   = json_decode($json); // var_dump($obj);

if ($obj === null) {
	$array = array("error" => "true", "type" => "format_json", "msg" => "format_json");
	header('Content-type: application/json');
	echo json_encode($array);
	exit;
}

if (empty($obj->nome)) {
	$array = array("error" => "true", "type" => "nome", "msg" => "Preencha o nome corretamente.");
	header('Content-type: application/json');
	echo json_encode($array);
	exit;
}

if (empty($obj->email)) {
	$array = array("error" => "true", "type" => "email", "msg" => "Preencha o email corretamente.");
	header('Content-type: application/json');
	echo json_encode($array);
	exit;
}

if (empty($obj->telefone)) {
	$array = array("error" => "true", "type" => "telefone", "msg" => "Preencha o telefone corretamente.");
	header('Content-type: application/json');
	echo json_encode($array);
	exit;
}

if (empty($obj->assunto)) {
	$array = array("error" => "true", "type" => "assunto", "msg" => "Preencha a assunto corretamente.");
	header('Content-type: application/json');
	echo json_encode($array);
	exit;
}
if (empty($obj->mensagem)) {
	$array = array("error" => "true", "type" => "mensagem", "msg" => "Preencha a mensagem corretamente.");
	header('Content-type: application/json');
	echo json_encode($array);
	exit;
}

$name     = trim(addslashes($obj->nome));
$email    = trim(addslashes($obj->email));
$email    = strtolower($email);
$telefone = trim(addslashes($obj->telefone));
$assunto  = trim(addslashes($obj->assunto));
$message  = trim(addslashes($obj->mensagem));

$mail = new PHPMailer;
// $mail->SMTPDebug = 3; // Enable verbose debug output
$mail->isSMTP(); // Set mailer to use SMTP
$mail->Host        = 'smtp.colnotrs.app.br'; // Specify main and backup SMTP servers
$mail->SMTPAuth    = true; // Enable SMTP authentication
$mail->Username    = 'noreply@colnotrs.app.br'; // SMTP username
$mail->Password    = 'C01n0t*22'; // SMTP password
$mail->SMTPSecure  = false; // Define se é utilizado SSL/TLS - Mantenha o valor "false"
$mail->SMTPAutoTLS = false; // Define se, por padrão, será utilizado TLS - Mantenha o valor "false"
$mail->Port        = 587; // TCP port to connect to

$mail->setFrom('noreply@colnotrs.app.br', 'Colégio Notarial RS');
// $mail->addAddress($email); // Name is optional
$mail->addAddress('odi@dedstudio.com.br');
// $mail->addAddress('secretaria@colnotrs.org.br');
// $mail->addAddress('informatica@colnotrs.org.br');
$mail->addReplyTo($email);
$mail->isHTML(true);
$mail->CharSet = 'UTF-8';

$mail->Subject = '[Colégio Notarial RS] Fale Conosco | ' . $assunto;

$mail->Body    = "De: $name ($email) <br>
				  Telefone: $telefone <br>
				  Assunto: $assunto <br>
				  Mensagem: $message";

if (!$mail->send()) {
	$array = array("error" => "true", "type" => "email_erro");
	header('Content-type: application/json');
	echo json_encode($array);
	exit;
} else {
	$sql   = "INSERT INTO cn_mensagens (assunto, nome, email, telefone, mensagem, status, data_registro) VALUES ('$assunto', '$name', '$email', '$telefone', '$message', 0, NOW())";
	$query = $dba->query($sql);
}

$array = array("success" => "true");

header('Content-type: application/json');
echo json_encode($array);

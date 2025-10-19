<?php

/**
 * @author			Andrey Willian - v 1.0 - out/2023
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

if (empty($obj->profissao)) {
    $array = array("error" => "true", "type" => "profissao", "msg" => "Preencha a profissão corretamente.");
    header('Content-type: application/json');
    echo json_encode($array);
    exit;
}
if (empty($obj->tabelionato)) {
    $array = array("error" => "true", "type" => "tabelionato", "msg" => "Preencha o tabelionato corretamente.");
    header('Content-type: application/json');
    echo json_encode($array);
    exit;
}
if (empty($obj->cidade_estado)) {
    $array = array("error" => "true", "type" => "cidade_estado", "msg" => "Preencha a cidade / estado corretamente.");
    header('Content-type: application/json');
    echo json_encode($array);
    exit;
}
if (empty($obj->pergunta)) {
    $array = array("error" => "true", "type" => "pergunta", "msg" => "Preencha a pergunta corretamente.");
    header('Content-type: application/json');
    echo json_encode($array);
    exit;
}

$name     = trim(addslashes($obj->nome));
$email    = trim(addslashes($obj->email));
$telefone    = trim(addslashes($obj->telefone));
$telefone = trim(addslashes($obj->telefone));
$profissao  = trim(addslashes($obj->profissao));
$tabelionato  = trim(addslashes($obj->tabelionato));
$cidade_estado  = trim(addslashes($obj->cidade_estado));
$pergunta  = trim(addslashes($obj->pergunta));

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
$mail->addAddress('andreywillian@dedstudio.com.br');
// $mail->addAddress('secretaria@colnotrs.org.br');
// $mail->addAddress('informatica@colnotrs.org.br');
$mail->addReplyTo($email);
$mail->isHTML(true);
$mail->CharSet = 'UTF-8';

$mail->Subject = '[Colégio Notarial RS] Assessoria Jurídica';

$mail->Body    = "De: $name ($email); <br>
				  Telefone: $telefone; <br>
				  Profissão: $profissao; <br>
				  Tabelionato: $tabelionato; <br>
				  Cidade / Estado: $cidade_estado; <br>
				  Pergunta: $pergunta.";

if (!$mail->send()) {
    $array = array("error" => "true", "type" => "email_erro");
    header('Content-type: application/json');
    echo json_encode($array);
    exit;
    
} else {

    $sql   = "INSERT INTO `cn_contato_assessoria_juridica`(`nome`, `email`, `telefone`, `profissao`, `tabelionato`, `cidade_estado`, `pergunta`, `data_hora_cadastro`) VALUES ('$nome', '$email', '$telefone', '$profissao', '$tabelionato','$cidade_estado', '$pergunta', NOW())";

    $query = $dba->query($sql);
};

$array = array("success" => "true");

header('Content-type: application/json');
echo json_encode($array);

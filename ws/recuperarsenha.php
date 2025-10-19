<?php
/**
 * @author			Roberto Rotondo - v 1.0 - mar/2019
 * @description 	Serviço de recuperação de senha
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
    $array = array("error" => "true", "type" => "format_json");
    header('Content-type: application/json');
    echo json_encode($array);
    exit;
}

if (!empty($obj->cpf) && isset($obj->cpf)) {

	$cpf = addslashes(trim($obj->cpf));
    $cpf = preg_replace("/[^0-9]/", "", $obj->cpf); // Retira formatação CPF

	$sql1 = "SELECT id, nome, email FROM cn_usuarios_associados WHERE cpf='$cpf'";
    $query1 = $dba->query($sql1);
    $qntd1 = $dba->rows($query1);
    if ($qntd1 > 0) {
        $vet1 = $dba->fetch($query1);
        $tipo_usuario = 1;
        $id_usuario   = $vet1[0];
        $nome         = stripslashes($vet1[1]);
        $email        = stripslashes($vet1[2]);

        $date = date('YmdHis');
        $aut  = md5($date.$id_usuario.$tipo_usuario); // Parâmetro de Autenticação da recuperação de senha
        $ip_registro = getIp();

        $sql   = "INSERT INTO cn_recuperar_senha (aut, tipo_usuario, id_usuario, ip_registro, data_hora_registro, status) VALUES ('$aut', $tipo_usuario, $id_usuario, '$ip_registro', NOW(), 1)";
        $query = $dba->query($sql);       

        $mail = new PHPMailer;
        // $mail->SMTPDebug = 3; // Enable verbose debug output
        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host        = 'smtp.dedstudio.poa.br'; // Specify main and backup SMTP servers
        $mail->SMTPAuth    = true; // Enable SMTP authentication
        $mail->Username    = 'noreply@dedstudio.poa.br'; // SMTP username
        $mail->Password    = 'D3dstud1o!22'; // SMTP password
        $mail->SMTPSecure  = false; // Define se é utilizado SSL/TLS - Mantenha o valor "false"
        $mail->SMTPAutoTLS = false; // Define se, por padrão, será utilizado TLS - Mantenha o valor "false"
        $mail->Port        = 587; // TCP port to connect to

        $mail->setFrom('noreply@dedstudio.poa.br', 'Colégio Notarial RS');
        $mail->addAddress($email); // Name is optional
        // $mail->addAddress('roberto@dedstudio.com.br');
        $mail->isHTML(true); // Set email format to HTML
        $mail->CharSet = 'UTF-8';
        $mail->Subject = '[Colégio Notarial RS] Redefinir Senha';
        $mail->Body    = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1.0"/><title></title><style>/* ----------- *//* -- Reset -- *//* ----------- */body{margin: 0;padding: 0;mso-padding-alt: 0;mso-margin-top-alt: 0;width: 100% !important;height: 100% !important;mso-margin-bottom-alt: 0;/*background-color: #f0f0f0;*/}body, table, td, p, a, li, blockquote{-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;}table{border-spacing: 0;}table, td{mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;}img, a img{border: 0;outline: none;text-decoration: none;}img{-ms-interpolation-mode: bicubic;}p, h1, h2, h3, h4, h5, h6{margin: 0;padding: 0;}.ReadMsgBody{width: 100%;}.ExternalClass{width: 100%;}.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div{line-height: 100%;}#outlook a{padding: 0;}img{max-width: 100%;height: auto;}/* ---------------- *//* -- Responsive -- *//* ---------------- */@media only screen and (max-width: 620px){#foxeslab-email .table1{width: 91% !important;}#foxeslab-email .table1-2{width: 98% !important;}#foxeslab-email .table1-3{width: 98% !important;}#foxeslab-email .table1-4{width: 98% !important;}#foxeslab-email .tablet_no_float{clear: both;width: 100% !important;margin: 0 auto !important;text-align: center !important;}#foxeslab-email .tablet_wise_float{clear: both;float: none !important;width: auto !important;margin: 0 auto !important;text-align: center !important;}#foxeslab-email .tablet_hide{display: none !important;}#foxeslab-email .image1{width: 100% !important;}#foxeslab-email .image1-290{width: 100% !important;max-width: 290px !important;}.center_content{text-align: center !important;}.center_button{width: 50% !important;margin-left: 25% !important;max-width: 300px !important;}}@media only screen and (max-width: 479px){#foxeslab-email .table1{width: 98% !important;}#foxeslab-email .no_float{clear: both;width: 100% !important;margin: 0 auto !important;text-align: center !important;}#foxeslab-email .wise_float{clear: both;float: none !important;width: auto !important;margin: 0 auto !important;text-align: center !important;}#foxeslab-email .mobile_hide{display: none !important;}}@media (max-width: 480px){.container_400{width: 95%;}}</style></head><body style="padding: 0;margin: 0;" id="foxeslab-email"><table class="table_full editable-bg-color bg_color_e6e6e6 editable-bg-image" bgcolor="#e6e6e6" width="100%" align="center" mc:repeatable="castellab" mc:variant="Header" cellspacing="0" cellpadding="0" border="0"><tr><td><table class="table1 editable-bg-color bg_color_000" bgcolor="#f6f5f5" width="600" align="center" border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto;"><tr><td height="15"></td></tr><tr><td><table class="table1" width="520" align="center" border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto;"><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="100%" align=""><a href="https://colnotrs.app.br/" class="editable-img"><img editable="true" mc:edit="image013" src="https://colnotrs.app.br/mails/images/logo-text.png" width="150" style="display:block; line-height:0; font-size:0; border:0;" border="0" alt="Logo"/></a></td></tr></table></td></tr></table></td></tr><tr><td height="15"></td></tr></table></td></tr><tr><td><table class="table1 editable-bg-color bg_color_ffffff" bgcolor="#ffffff" width="600" align="center" border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto;"><tr><td height="60"></td></tr><tr><td><table class="table1" width="520" align="center" border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto;"><tr><td mc:edit="text022" align="left" class="text_color_000" style="color: #068f9f; font-size: 30px; font-weight: 700; font-family: Arial, Helvetica, sans-serif; mso-line-height-rule: exactly;"><div class="editable-text"><span class="text_container"><multiline>Redefinir Senha</multiline></span></div></td></tr><tr><td height="40"></td></tr><tr><td mc:edit="text011" align="left" class="text_color_000" style="color: #068f9f; font-size: 20px; font-weight: 700; font-family: lato, Helvetica, sans-serif; mso-line-height-rule: exactly;"><div class="editable-text"><span class="text_container"><multiline>Olá '.$nome.', </multiline></span></div></td></tr><tr><td height="10"></td></tr><tr> <td mc:edit="text024" align="left" class="text_color_a1a2a5" style="color: #a1a2a5; font-size: 14px;line-height: 2; font-weight: 500; font-family: Arial, Helvetica, sans-serif; mso-line-height-rule: exactly;"> <div class="editable-text" style="line-height: 2;"> <span class="text_container"> <multiline> percebemos que você perdeu sua senha. </multiline> </span> </div></td></tr><tr><td height="20"></td></tr><tr> <td mc:edit="text013" align="left" class="text_color_a1a2a5" style="color: #a1a2a5; font-size: 14px;line-height: 2; font-weight: 500; font-family: lato, Helvetica, sans-serif; mso-line-height-rule: exactly;"> <div class="editable-text" style="line-height: 2;"> <span class="text_container"> <multiline> Mas não se preocupe! Acesse o seguinte link para redefinir sua senha: </multiline> </span> </div></td></tr><tr><td height="15"></td></tr><tr> <td mc:edit="text014" align="left" class="" style="font-size: 13px; line-height: 2; font-weight: 500; font-family: lato, Helvetica, sans-serif; mso-line-height-rule: exactly;"> <div class="editable-text" style="line-height: 2;"> <span class="text_container"> <multiline> <a href="https://colnotrs.app.br/redefinirsenha/?aut='.$aut.'" class="text_color_4a4a49" style="color: #068f9f; text-decoration: none;">https://colnotrs.app.br/redefinirsenha/?aut='.$aut.'</a> </multiline> </span> </div></td></tr><tr><td height="15"></td></tr><tr> <td mc:edit="text013" align="left" class="text_color_a1a2a5" style="color: #a1a2a5; font-size: 14px;line-height: 2; font-weight: 500; font-family: lato, Helvetica, sans-serif; mso-line-height-rule: exactly;"> <div class="editable-text" style="line-height: 2;"> <span class="text_container"> <multiline> Se você não usar este link no prazo de 24 horas, ele expirará. Para obter um novo link de redefinição de senha, visite <a href="https://colnotrs.app.br/" class="text_color_000" style="color: #068f9f; text-decoration: none;">https://colnotrs.app.br/</a> </multiline> </span> </div></td></tr><tr><td height="30"></td></tr><tr><td mc:edit="text029" align="left" class="text_color_a1a2a5" style="color: #a1a2a5; font-size: 14px;line-height: 2; font-weight: 500; font-family: Arial, Helvetica, sans-serif; mso-line-height-rule: exactly;"><div class="editable-text" style="line-height: 2;"><span class="text_container"><multiline>Obrigado,</multiline></span></div></td></tr><tr><td height="5"></td></tr><tr><td mc:edit="text030" align="left" class="text_color_a1a2a5" style="color: #a1a2a5; font-size: 14px;line-height: 2; font-weight: 500; font-family: Arial, Helvetica, sans-serif; mso-line-height-rule: exactly;"><div class="editable-text" style="line-height: 2;"><span class="text_container"><multiline>Colégio Notarial RS</multiline></span></div></td></tr><tr><td height="20"></td></tr><tr><td><a href="#" class="editable-img" style="text-decoration: none;"><img src="https://colnotrs.app.br/mails/images/google-play-badge.png" width="143" style="display:inline-block; line-height:0; font-size:0; border:0;" border="0" alt=""/></a><a href="#" class="editable-img" style="text-decoration: none;"><img src="https://colnotrs.app.br/mails/images/app-store-badge.png" width="125" style="display:inline-block; line-height:0; font-size:0; border:0;" border="0" alt=""/></a></td></tr><tr><td height="20"></td></tr><tr><td mc:edit="text031" align="left" class="text_color_a1a2a5" style="color: #a1a2a5; font-size: 14px;line-height: 2; font-weight: 500; font-family: Arial, Helvetica, sans-serif; mso-line-height-rule: exactly;"><div class="editable-text" style="line-height: 2;"><span class="text_container"><multiline>Dúvidas? Entre em contato pelo e-mail <a href="mailto:informatica@colnotrs.org.br" class="text_color_000" style="color:#068f9f; text-decoration: none;">informatica@colnotrs.org.br</a></multiline></span></div></td></tr></table></td></tr><tr><td height="60"></td></tr></table></td></tr><tr><td><table class="table1" width="600" align="center" border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto;"><tr><td height="40"></td></tr><tr><td><table class="table1-2" width="350" align="left" border="0" cellspacing="0" cellpadding="0"><tr><td mc:edit="text032" align="left" class="center_content text_color_929292" style="color: #929292; font-size: 14px; line-height: 2; font-weight: 400; font-family: Arial, Helvetica, sans-serif; mso-line-height-rule: exactly;"><div class="editable-text" style="line-height: 2;"><span class="text_container"><multiline>Copyright © '.date('Y').' Colégio Notarial RS, Todos os direitos reservados. <a href="https://colnotrs.org.br" style="color: #000;text-decoration: none;"> colnotrs.org.br</a></multiline></span></div></td></tr><!-- <tr><td height="20"></td></tr><tr><td mc:edit="text033" align="left" class="center_content" style="font-size: 14px;font-weight: 400; font-family: Arial, Helvetica, sans-serif; mso-line-height-rule: exactly;"><div class="editable-text"><span class="text_container"><multiline><a href="https://colnotrs.app.br/#faq" class="text_color_929292" style="color:#929292; text-decoration: none;">Perguntas Frequentes</a></multiline></span></div></td></tr>--><!-- <tr><td height="10"></td></tr><tr><td mc:edit="text034" align="left" class="center_content" style="font-size: 14px;font-weight: 400; font-family: Arial, Helvetica, sans-serif; mso-line-height-rule: exactly;"><div class="editable-text"><span class="text_container"><multiline><a href="#" class="text_color_929292" style="color:#929292; text-decoration: none; display: block;">Cancelar assinatura</a></multiline></span></div></td></tr>--><tr><td height="30"></td></tr></table><table class="tablet_hide" width="130" align="left" border="0" cellspacing="0" cellpadding="0"><tr><td height="1"></td></tr></table><table class="table1-2" width="120" align="right" border="0" cellspacing="0" cellpadding="0"><tr><td><table width="120" align="center" style="margin: 0 auto;"><tr><td align="center" width="35"><a href="https://www.facebook.com/cnbrgs" style="border-style: none !important; display: inline-block;; border: 0 !important;" class="editable-img"><img editable="true" mc:edit="image016" src="https://colnotrs.app.br/mails/images/icon-fb.png" width="35" style="display:block; line-height:0; font-size:0; border:0;" border="0" alt=""/></a></td><td width="15"></td><td align="center" width="35"><a href="https://twitter.com/CNB_RS" style="border-style: none !important; display: inline-block; border: 0 !important;" class="editable-img"><img editable="true" mc:edit="image017" src="https://colnotrs.app.br/mails/images/icon-twitter.png" width="35" style="display:block; line-height:0; font-size:0; border:0;" border="0" alt=""/></a></td><td width="15"></td><td align="center" width="35"><a href="https://www.instagram.com/cnb_rs/" style="border-style: none !important; display: inline-block;; border: 0 !important;" class="editable-img"><img editable="true" mc:edit="image018" src="https://colnotrs.app.br/mails/images/icon-ig.png" width="35" style="display:block; line-height:0; font-size:0; border:0;" border="0" alt=""/></a></td></tr></table></td></tr><tr><td height="30"></td></tr></table></td></tr><tr><td height="70"></td></tr></table></td></tr></table></body>';

        if ($mail->send()) {
            $array = array("success" => "true"); 

        } else {
            $array = array("error" => "true", "type" => "email_error", "msg" => "Ops, ocorreu um erro, tente novamente. ".$mail->ErrorInfo); 
        }
        
    }  else {
        $array = array("error" => "true", "type" => "cpf_invalido", "msg" => "CPF não encontrado, tente novamente."); 
        
    }

} else {
    $array = array("error" => "true", "type" => "parametros", "msg" => "Parâmetros inválidos."); 
    
}

header('Content-type: application/json');
echo json_encode($array);


?>
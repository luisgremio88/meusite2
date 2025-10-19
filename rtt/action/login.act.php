<?php
require_once('../../inc/inc.autoload.php');
require_once('../../inc/inc.globals.php');
require_once('../config/inc.functions.php');

//$return = '';
// ---------- PROCESSAMENTO ------------

$act = request('act');
$act = base64_decode($act);

switch($act)
{
    case 'login': 
        // ##### reCaptcha Google #####
        $content = http_build_query(array(
            'secret' => '6Lely28rAAAAAHRlCqqw7e5mZcpcvgcRCdvXw4nY',
            'response' => $_POST['g-recaptcha-response']
        ));
        $context = stream_context_create(array(
            'http' => array(
                'method' => 'POST',
                'content' => $content
            )
        ));
        $result = file_get_contents('https://www.google.com/recaptcha/api/siteverify', null, $context);
        $result = json_decode($result);
        // $result->success = true; //forçado para testar localhost (tirar para publicar)
        // ############################

        $destino = '../login';
        session_start(); 
        
        if ($result!=null && !empty($result) && $result->success)
        {
            $sen = request('sen');
            $pas = base64_encode($sen);
            $cpf = request('cpf');
            try {
                //chama o endpoint que grava
                $host = "https://www.colnotrs.app.br/ws/login?api_token=545d6f5cb1d24a4f7c94e1be01d9f474";
                $body = '{ "user" : "'.$cpf.'" , "senha" : "'.$pas.'" }';
                $head = array('Content-Type: application/json' , 'Content-Length:'.strlen($body) , 'Accept: text/json');
                $api = new ApiRest($host);
                $res = $api->post($body, $head); 
                $objeto = json_decode($res);
                if ($objeto->success) {
                    $tok = $objeto->token;

                    $objusu = $objeto->user;
                    $idu = $objusu->id;
                    $cpf = $objusu->cpf;
                    $idt = $objusu->tabelionato;
                    $ofc = $objusu->oficial;

                    $_SESSION['login'] = base64_encode($idu); 
                    $_SESSION['idu'] = $idu; 
                    $_SESSION['cpf'] = $cpf;
                    $_SESSION['tab'] = $idt; 
                    $_SESSION['tok'] = $tok;
                    $_SESSION['msg'] = ''; 
                    $destino = '../home';
                }
                else {
                    $_SESSION['msg'] = 'Dados inválidos'; 
                }
            }
            catch(Exception $ex) {
                $_SESSION['msg'] = 'BUG => '.$ex->getMessage(); 
            }
        }
        else 
        {
            $_SESSION['msg'] = 'reCAPTCHA inválido.'; 
        }
        
        $pdo = null; //fim conexao db
        header('location: '.$destino);
        exit;
    break;



    case 'recovery': 
        $destino = '../login-recovery';
        session_start();

        //dados do form
        // $mat = request('mat');
        $cpf = request('cpf');
        
        //objetos de acesso aos dados
        $objusu = new Sis_nomes();
        $daousu = new Sis_nomesDAO();
        
        //verifica se o email ja existe no banco
        // $sqlema = "username = '$mat'";
        $sqlema = "cpf = '$cpf'";
        $resema = $daousu->select($sqlema);
        if (count($resema) > 0) {

            $idu = $resema[0]['id'];
            $ema = $resema[0]['emaresi'];
            $nom = $resema[0]['nome'];

            //codigo de confirmacao
            $cod = 'CPG-'.rand(1000, 9999);
            $now = date('Y-m-d H:i:s');

            $objusu->setId($idu);
            $objusu->setCodigo($cod);
            $objusu->setDatacod($now);
            $resusu = $daousu->update($objusu);
            if ($resusu) {
                //INI - enviar código de ativacao por email
                $smtp_host = $_ENV['SMTP_HOST'];
                $smtp_user = $_ENV['SMTP_USER'];
                $smtp_pass = $_ENV['SMTP_PASS'];
                $body = '{
                            "api_user": "'.$smtp_user.'",
                            "api_key" : "'.$smtp_pass.'",
                            "to":
                                [{
                                "email": "'.$ema.'"
                                }]
                            ,
                            "from": 
                            {
                                "name": "CPG - Atendimento",
                                "email": "atendimento@odix.com.br",
                                "reply_to": "atendimento@odix.com.br"
                            }
                            ,
                            "subject": "CPG - Recuperar Senha ou Primeiro Acesso",
                            "html": "<h3>Olá '.$nom.'</h3> Foi gerado um código de acesso para você confirmar a sua solicitação.<h1>'.$cod.'</h1>Informe esse código no campo indicado no site, juntamente com outros dados solicitados para criar uma nova senha. <br><br> Se preferir, clique no link abaixo para ser direcionado a essa tela. <br/> <a href=\"http://cpg.com.br/socios/login-register\">Nova Senha CPG Online</a> <br/> <h3>CPG.com.br</h3>"
                        }';
                $head = array(
                            'Content-Type:application/json' , 
                            'Content-Length:'.strlen($body) , 
                            'Accept: text/json'
                        );
                $api = new ApiRest($smtp_host);
                $res = $api->post($body, $head); 
                $vetres = json_decode($res); 
                //FIM - enviar código de ativacao por email
                
                $_SESSION['err'] = 'Email enviado com informações.';
                $destino = '../login-register';
            }
            else {
                $_SESSION['err'] = 'Não enviado. Tente mais tarde.';
                $destino = '../login-recovery';
            }
        }
        else {
            $_SESSION['err'] = 'Dados não encontrados!';
            $destino = '../login-recovery';
        }

        $pdo = null; //fim conexao db
        header('location: '.$destino);
        exit;
    break;



    case 'register':
        $destino = '../login-register';
        session_start();

        //dados do form
        $nom = request('nom');
        $dat = request('dat').' 00:00:00';
        // $mat = request('mat');
        $cpf = request('cpf');
        $cod = request('cod');
        $se1 = request('se1');
        $se2 = request('se2');
        if ($se1 == $se2) 
        {
            //objetos de acesso aos dados
            $objusu = new Sis_nomes();
            $daousu = new Sis_nomesDAO();

            //verifica codigo
            $sqlema = "nome like '%$nom%' and cpf = '$cpf' and dtnascim = '$dat' and codigo = '$cod'"; 
            $resema = $daousu->select($sqlema);
            if (count($resema) > 0) {

                $idu = $resema[0]['id'];
                $ema = $resema[0]['emaresi'];
                $nom = $resema[0]['nome'];
                
                $sen = sha1($se1);
                $dat = date('Y-m-d H:i:s');
                $cod = '0';

                $objusu->setId($idu);
                $objusu->setSenha($sen);
                $objusu->setCodigo($cod);
                $resusu = $daousu->update($objusu);
                if ($resusu) {
                    //INI - enviar código de ativacao por email
                    $smtp_host = $_ENV['SMTP_HOST'];
                    $smtp_user = $_ENV['SMTP_USER'];
                    $smtp_pass = $_ENV['SMTP_PASS'];
                    $body = '{
                                "api_user": "'.$smtp_user.'",
                                "api_key" : "'.$smtp_pass.'",
                                "to":
                                    [{
                                    "email": "'.$ema.'"
                                    }]
                                ,
                                "from": 
                                {
                                    "name": "CPG - Atendimento",
                                    "email": "atendimento@odix.com.br",
                                    "reply_to": "atendimento@odix.com.br"
                                }
                                ,
                                "subject": "CPG - Registro para Acesso Restrito",
                                "html": "<h3>Olá '.$nom.'</h3>Sua nova senha foi criada com sucesso!<br>Efetue o login na página do Clube para aproveitar os recursos disponíveis no seu acesso restrito. <br/><br/><h3>CPG.com.br</h3>"
                            }';
                    $head = array(
                                'Content-Type:application/json' , 
                                'Content-Length:'.strlen($body) , 
                                'Accept: text/json'
                            );
                    $api = new ApiRest($smtp_host);
                    $res = $api->post($body, $head); 
                    $vetres = json_decode($res); 
                    //FIM - enviar código de ativacao por email
                    
                    $_SESSION['err'] = 'Senha cadastrada. Faça o login.';
                    $destino = '../login';
                }
                else {
                    $_SESSION['err'] = 'Problemas. Tente mais tarde.';
                    $destino = '../login-register';
                }
            }
            else {
                $_SESSION['err'] = 'Alguma informação está errada.';
                $destino = '../login-register';
            }
        }
        else 
        {
            $_SESSION['err'] = 'Senhas não são iguais.';
            $destino = '../login-register';
        }

        $pdo = null; //fim conexao db
        header('location: '.$destino);
        exit;
    break;



    case 'logout':
        session_start();
        unset($_SESSION['login']);
        unset($_SESSION['matricula']);
        session_destroy();
        $destino = '/rtt/login';
        header('location: '.$destino);
        exit;
    break;



    default:
        $destino = '/rtt/login';
        session_start();
        $_SESSION['err'] = 'Oops, problemas no acesso';
        header('location: '.$destino);
        exit;
    break;
}

// ---------- PROCESSAMENTO ------------
//echo $return;

?>
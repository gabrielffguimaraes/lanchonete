<?php

class AuthController extends AuthDAO
{
    public function __construct()
    {
        $this->open();
    }
    public function verifyRecoveryCode($token) {
        $authDAO = new AuthDAO();
        $authDAO->connection = $this->connection;

        $recoveryData = $authDAO->getByRecoveryCode($token);
        if(!$recoveryData) {
            throw new Exception("Código de recuperação de senha inválido ou já utilizado .");
        }

        $today = date('Y-m-d H:i:s');
        $expiration_at = $recoveryData["expiration_at"];

        $expirated = ($today > $expiration_at) ? true : false;
        if ($expirated) {
            throw new Exception("Código de recuperação de senha expirado");
        }

        return true;
    }

    public function sendRecoveryCode($req,$res,$args = []) {
        $enviroments = require __DIR__.'./../../app/enviroments.php';
        $dateOperation = date("Y-m-d H:i:s");
        $clientDAO = new ClientDAO();
        $clientDAO->connection = $this->connection;

        $authDAO = new AuthDAO();
        $authDAO->connection = $this->connection;

        $params = $req->getParams();
        if(!isset($params['email'])) {
            return $res->withJson("Parametro email obrigatório",400);
        }

        $client = $clientDAO->getClientByEmail($params['email'],"client");
        if(!$client) {
            return $res->withJson("email não encontrado",404);
        }

        $auth = array(
            "recover_code" => $this->generateRecoveryCode($params['email'],$dateOperation),
            "client_id" => $client["id"],
            "expiration_at" => Util::addMinutesToDate($dateOperation,30)
        );
        $msgSuccess = "Codigo de verificação enviado com sucesso para o email {$params['email']}";
        $msgErr = "Ocorreu um erro ao enviar código recuperação de senha , por favor tente novamente .";

        // LIMPA CODIGOS DE RECUPERAÇÃO FEITOS ANTERIORMENTE
        $this->deleteRecoveryCode($auth);

        // SALVA UM NOVO CÓDIGO DE RECUPERAÇÃO COM EXPIRAÇÃO DE 30 MNINUTOS
        $result = $authDAO->saveRecoveryCode($auth);
        if($result != 1) {
            return $res->withJson($msgErr,400);
        }

        // ENVIO DE EMAIL
        $email =  new Email();
        $subject = "Código de recuperação de senha .";
        $msg = "Link para alteração de senha abaixo :<br/>{$enviroments['url']}recover?token={$auth['recover_code']}";
        $result = $email->send($params['email'],$subject,$msg);
        if($result == 1) {
             return $res->withJson($msgSuccess,200);
        } else {
            return $res->withJson($msgErr,400);
        }
    }
    public function subscription($req,$res,$args = []) {
        $params = $req->getParams();
        if(!isset($params['email']) || $params['email'] == "") {
            return $res->withJson("Email obrigatório",400);
        }
        // ENVIO DE EMAIL
        $email =  new Email();
        $result = $email->send("lanchonete.tcc@gmail.com",
            "INSCRIÇÃO DE EMAIL : {$params['email']}" ,
              "Pedido de inscrição feito as ".date("H:i")." em ".date("d/m/Y"));
        if($result == 1) {
            return $res->withJson("Sucesso , apartir de agora você ficará por dentro de todas as nossas novidades e promoções .",200);
        } else {
            return $res->withJson("Erro inesperado por favor tente mais tarde .",400);
        }
    }
    private function generateRecoveryCode($email,$date) {
        $random = Util::generateRandomNumber();
        return base64_encode($email.$random.$date);
    }
}

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
        $dateOperation = date("Y-m-d H:i:s");
        $clientDAO = new ClientDAO();
        $clientDAO->connection = $this->connection;

        $authDAO = new AuthDAO();
        $authDAO->connection = $this->connection;

        $params = $req->getParams();
        if(!isset($params['email'])) {
            return $res->withJson("Parametro email obrigatório",400);
        }

        $client = $clientDAO->getClientByEmail($params['email']);
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
        $result = $email->send($params['email'],$auth["recover_code"]);
        if($result == 1) {
             return $res->withJson($msgSuccess,200);
        } else {
            return $res->withJson($msgErr,400);
        }
    }
    private function generateRecoveryCode($email,$date) {
        $random = Util::generateRandomNumber();
        return base64_encode($email.$random.$date);
    }
}

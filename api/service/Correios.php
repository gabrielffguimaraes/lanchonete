<?php



class Correios
{
    const URL_BASE = 'http://ws.correios.com.br';

    const SERVICO_SEDEX = '04014';
    const SERVICO_SEDEX_12 = '04782';
    const SERVICO_SEDEX_10 = '04790';
    const SERVICO_SEDEX_HOJE = '04804';
    const SERVICO_PAC = '04510';

    const FORMATO_CAIXA_PACOTE = 1;
    const FORMATO_ROLO_PRISMA = 2;
    const FORMATO_ENVELOPE = 3;
    private $codigoEmpresa = '';
    private $senhaEmpresa = '';
    public function __construct($codigoEmpresa = '',$senhaEmpresa = '') {
        $this->codigoEmpresa = $codigoEmpresa;
        $this->senhaEmpresa = $senhaEmpresa;
    }
    public function frete($cepOrigem,$cepDestino) {
        $codigoServico = self::SERVICO_PAC;
        $peso = 1;
        $formato = self::FORMATO_CAIXA_PACOTE;
        $comprimento = 15;
        $altura = 15;
        $largura = 15;
        $diametro = 0;
        $maoPropria = false;
        $valorDeclarado = 0;
        $avisoRecebimento = false;
        $frete = $this->calcularFrete( $codigoServico,
            $cepOrigem,
            $cepDestino,
            $peso,
            $formato,
            $comprimento,
            $altura,
            $largura,
            $diametro,
            $maoPropria,
            $valorDeclarado,
            $avisoRecebimento);

        // VERIFICA O ERRO
        if(!$frete) {
            throw new Exception("Problemas ao calcular o frete");
        }
        // VERIFICA O ERRO
        if(strlen($frete->MsgErro)) {
            throw new Exception("Erro : " .$frete->MsgErro);
        }

        return array(
            "valor" => $frete->Valor,
            "prazo" => $frete->PrazoEntrega,
        );
    }
    public function calcularFrete($codigoServico = "",
                                  $cepOrigem = "",
                                  $cepDestino = "",
                                  $peso = "",
                                  $formato = "",
                                  $comprimento = "",
                                  $altura = "",
                                  $largura = "",
                                  $diametro = 0,
                                  $maoPropria = false,
                                  $valorDeclarado = 0,
                                  $avisoRecebimento = false) {
        $parametros = [
            'nCdEmpresa' => $this->codigoEmpresa,
            'sDsSenha'   => $this->senhaEmpresa,
            'nCdServico' => $codigoServico,
            'sCepOrigem' => $cepOrigem,
            'sCepDestino' => $cepDestino,
            'nVlPeso' => $peso,
            'nCdFormato' => $formato,
            'nVlComprimento' => $comprimento,
            'nVlAltura' => $altura,
            'nVlLargura' => $largura,
            'nVlDiametro' => $diametro,
            'sCdMaoPropria' => $maoPropria ? 'S' : 'N',
            'nVlValorDeclarado' => $valorDeclarado,
            'sCdAvisoRecebimento' => $avisoRecebimento ? 'S' : 'N',
            'StrRetorno' => 'xml'
        ];

        $query = http_build_query($parametros);
        $resultado = $this->get('/calculador/CalcPrecoPrazo.aspx?'.$query);

        return $resultado;
    }
    public function get($resource) {
        $endpoint = self::URL_BASE.$resource;

        // INICIA O CURL
        $curl = curl_init();

        //CONFIGURAÇÕES DO CURL
        curl_setopt_array($curl, [
            CURLOPT_URL => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET'
        ]);

        //EXECUTA A CONSULTA
        $response = curl_exec($curl);

        //FECHA CONEXÃO DO CURL
        curl_close($curl);

        //RETORNA O XML INSTANCIADO
        $resultado = strlen($response) ? simplexml_load_string($response) : null;

        //RETORNA O FRETE CALCULADO
        return ($resultado) ? $resultado->cServico : null;
    }
}
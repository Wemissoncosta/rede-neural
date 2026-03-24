<?php

class Neuronio {
    public array $entradas;
    public array $pesos;
    public float $somaPonderada;
    public float $saida;
    public float $bias;
    public function __construct( array $pesos, float $bias) {
        $this->pesos = $pesos;
        $this->bias = $bias;
    }

    // Calcula a Junção Somadora

    public function calcularSoma(array $entradas): void {
        $this->somaPonderada = 0;
        $this->entradas = $entradas;
        foreach ($this->entradas as $i => $valor) {
            $this->somaPonderada += $valor * $this->pesos[$i];
        }
        $this->somaPonderada += $this->bias;
    }

     // Aplicando a Função Ativação (Sigmoide)

    public function ativar2(): void {
        $e = M_E;
        $s = $this->somaPonderada;
        $this->saida = 1 / (1 + pow($e, exponent: -$s));
    }
}

class Camada {
    public array $neuronios;

    public function __construct(array $neuronios) {
        $this->neuronios = $neuronios;
    }

    //function Process Neurônio

    public function processar(array $entradas):array{
      $saidas = []; //Começãmos com um array vazio para guardar os resultados
      foreach ($this-> neuronios as $neuronio){
        $neuronio->calcularSoma($entradas);
        $neuronio->ativar2();
        $saidas[] = $neuronio->saida;
       }
      return $saidas;
    }
}

class redeNeural{
    public array $camadas;
    public function __construct(array $camadas) {
        $this->camadas = $camadas;
    }
    public function processar(array $entradas):array{
        $saidaAtual = $entradas;
        foreach ($this->camadas as $camada){
            $saidaAtual = $camada->processar($saidaAtual);
        }
        return $saidaAtual;
    }
}


echo "------- Configuração do Neurônio (OO) -------\n";
echo "Digite os valores de entrada (separados por vírgula): ";
$entradas = array_map("floatval", explode(",", trim(fgets(STDIN))));
echo "Digite os pesos (separados por vírgula): ";
$pesos = array_map("floatval", explode(",", trim(fgets(STDIN))));


if (count($entradas) !== count($pesos)) {
    die("Erro: Quantidade de entradas e pesos incompatível.\n");
}

$n1 = new Neuronio($pesos, bias: 1.0);
$n2 = new Neuronio($pesos, bias:1.0);

$camada1 = new Camada([$n1, $n2]);

$n3 = new Neuronio([0.5,0.7], bias:1.0);

$camda2 = new Camada([$n3]);


$rede = new redeNeural([$camada1, $camda2]);

// Passa os dados iniciais para a rede processar
$resultadoFinal = $rede->processar($entradas);

$resultadoEsperado = 1.0; // Exemplo de resultado esperado para comparação

$erro = $resultadoEsperado - $resultadoFinal[0];

$derivada = $resultadoFinal[0] * (1 - $resultadoFinal[0]); // Derivada da função sigmoide

$delta = $erro * $derivada;
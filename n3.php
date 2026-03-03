<?php

/**
 * Representa a estrutura de um Neurônio Artificial
 */
class Neuronio {
    public array $entradas;
    public array $pesos;
    public float $somaPonderada;
    public float $saida;

    public float $bias;

    public function __construct(array $entradas, array $pesos, float $bias) {
        $this->entradas = $entradas;
        $this->pesos = $pesos;
        $this->bias = $bias;
    }

    // Calcula a Junção Somadora
    public function calcularSoma(): void {
        $this->somaPonderada = 0;
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

class camada {
    public array $neuronios;

    public function __construct(array $neuronios) {
        $this->neuronios = $neuronios;
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

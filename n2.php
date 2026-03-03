<?php

/**
 * Representa a estrutura de um Neurônio Artificial
 */
class Neuronio {
    public array $entradas;
    public array $pesos;
    public float $somaPonderada;
    public float $saida;

    public function __construct(array $entradas, array $pesos) {
        $this->entradas = $entradas;
        $this->pesos = $pesos;
    }

    // Calcula a Junção Somadora
    public function calcularSoma(): void {
        $this->somaPonderada = 0;
        foreach ($this->entradas as $i => $valor) {
            $this->somaPonderada += $valor * $this->pesos[$i];
        }
    }
   
    // Aplicando a Função de Ativação (Tangente Hiperbólica)
    public function ativar(): void {
        $e = M_E;
        $s = $this->somaPonderada;
        $this->saida = (pow($e, $s) - pow($e, -$s)) / (pow($e, $s) + pow($e, -$s));
    }

     // Aplicando a Função Ativação (Sigmoide)
    public function ativar2(): void {
        $e = M_E;
        $s = $this->somaPonderada;
        $this->saida = 1 / (1 + pow($e, exponent: -$s));
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

// Instanciando a "Struct" (Objeto)
$meuNeuronio = new Neuronio($entradas, $pesos);
$meuNeuronio->calcularSoma();
$meuNeuronio->ativar();

echo "\n------ Resultado Tangente Hiperbólica ------\n";
echo "Soma Ponderada: " . number_format($meuNeuronio->somaPonderada, 4) . "\n";
echo "Saída (Tanh): " . number_format($meuNeuronio->saida, 4) . "\n";

// Na Tangente Hiperbólica, o limiar comum é 0 (intervalo de -1 a 1)
$decisao = ($meuNeuronio->saida >= 0) ? "ATIVADO (1)" : "DESATIVADO (-1/0)";
echo "Decisão: $decisao\n";

// Instanciando a "Struct" (Objeto)
$meuNeuronio = new Neuronio($entradas, $pesos);
$meuNeuronio->calcularSoma();
$meuNeuronio->ativar2();

echo "\n------ Resultado Sigmoide ------\n";
echo "Soma Ponderada: " . number_format($meuNeuronio->somaPonderada, 4) . "\n";
echo "Saída (Tanh): " . number_format($meuNeuronio->saida, 4) . "\n";

// Na Tangente Hiperbólica, o limiar comum é 0 (intervalo de -1 a 1)
$decisao = ($meuNeuronio->saida >= 0) ? "ATIVADO (1)" : "DESATIVADO (-1/0)";
echo "Decisão: $decisao\n";

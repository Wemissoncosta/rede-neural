<?php

echo "------- Configuração do Neurônio -------\n";

echo "Digite os valores de cada entrada (Ex: 0.5, 1.0): ";
$inputRaw = fgets(STDIN);
// O trim remove espaços extras que o usuário possa digitar
$entrada = array_map("floatval", explode(",", trim($inputRaw)));

echo "Digite os pesos de cada valor (Ex: 0.2, 0.8): ";
$pesoRaw = fgets(STDIN);
$peso = array_map("floatval", explode(",", trim($pesoRaw)));

if (count($entrada) !== count($peso)) {
    die("Erro: A quantidade de entradas deve ser igual à de pesos.\n");
}

// 1. Cálculo da Soma Ponderada (Junção Somadora)
$soma = 0;
for ($i = 0; $i < count($entrada); $i++) {
    $soma += $entrada[$i] * $peso[$i];
}

// 2. Aplicação da Função de Ativação (Sigmoide)
// Usamos M_E para maior precisão matemática
//$saida = 1 / (1 + (M_E ** -$soma));
//3. TANGENTE HIPERBOLICA
$saida = ((M_E ** $soma) - (M_E ** -$soma)) / ((M_E ** $soma) + (M_E ** -$soma));


echo "\n------ Resultado ------\n";
echo "Soma Ponderada Bruta: " . number_format($soma, 4) . "\n";
echo "Saída do Neurônio (Ativação): " . number_format($saida, 4) . "\n";

if ($saida >= 0.5) {
    echo "Decisão: ATIVADO (1)\n";
} else {
    echo "Decisão: DESATIVADO (0)\n";
}

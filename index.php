<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora Simples</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Calculadora Simples</h1>
    <div class="calculator">
        <form method="post">
            <input type="text" name="tela" class="screen" id="tela" readonly value="<?php echo $_POST['tela'] ?? ''; ?>">
            <input type="hidden" name="num1" id="num1">
            <input type="hidden" name="num2" id="num2">
            <input type="hidden" name="operacao" id="operacao">
            <div class="buttons">
                <!-- Botões de números -->
                <?php for ($i = 1; $i <= 9; $i++): ?>
                    <button type="button" onclick="adicionarValor('<?php echo $i; ?>')"><?php echo $i; ?></button>
                <?php endfor; ?>
                <button type="button" onclick="adicionarValor('0')">0</button>
                <button type="button" onclick="adicionarValor('.')">.</button>
                <button type="button" onclick="limpar()">C</button>
                
                <!-- Botões de operações -->
                <button type="button" onclick="definirOperacao('+')">+</button>
                <button type="button" onclick="definirOperacao('-')">-</button>
                <button type="button" onclick="definirOperacao('*')">*</button>
                <button type="button" onclick="definirOperacao('/')">/</button>
                
                <!-- Botão de igual -->
                <button type="submit" onclick="enviar()">=</button>
            </div>
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $num1 = $_POST['num1'] ?? null;
        $num2 = $_POST['num2'] ?? null;
        $operacao = $_POST['operacao'] ?? null;
    
        if (is_numeric($num1) && is_numeric($num2)) {
            switch ($operacao) {
                case '+':
                    $resultado = $num1 + $num2;
                    break;
                case '-':
                    $resultado = $num1 - $num2;
                    break;
                case '*':
                    $resultado = $num1 * $num2;
                    break;
                case '/':
                    $resultado = $num2 != 0 ? $num1 / $num2 : "Erro: Divisão por zero";
                    break;
                default:
                    $resultado = "Operação inválida.";
            }
    
            echo "<p id='resultado'>Resultado: $resultado</p>";
        } else {
            echo "<p>Erro: Entradas inválidas.</p>";
        }   
    }
    ?>

    <script>
       let tela = document.getElementById('tela');
let num1 = document.getElementById('num1');
let num2 = document.getElementById('num2');
let operacao = document.getElementById('operacao');
let reset = false;

function adicionarValor(valor) {
    if (reset) {
        tela.value = '';
        reset = false;
    }
    tela.value += valor;
}

function definirOperacao(op) {
    if (tela.value === '') {
        alert('Por favor, insira um número antes de escolher uma operação.');
        return;
    }
    num1.value = tela.value; // Salva o primeiro número
    operacao.value = op;     // Salva a operação
    tela.value = '';         // Limpa a tela para o próximo número
}

function limpar() {
    tela.value = '';
    num1.value = '';
    num2.value = '';
    operacao.value = '';
}

function enviar() {
    if (tela.value === '') {
        alert('Por favor, insira o segundo número antes de calcular.');
        return;
    }
    num2.value = tela.value; // Salva o segundo número
    reset = true;            // Reseta para nova operação
}

    </script>
</body>
</html>

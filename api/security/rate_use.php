<?php
// Inclui as funções e classes necessárias
// require_once 'JsonAppendLogger.php';

$mensagemErro = "";

// Verifica o estado do IP antes mesmo de processar o formulário
$rateLimit = verificarLimiteLogin('logs.jsonl', 5); // Limite de 5 tentativas por minuto

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($rateLimit['bloqueado']) {
        // Se já estiver bloqueado, exibe a notificação de tempo
        $mensagemErro = $rateLimit['mensagem'];
    } else {
        // Se NÃO estiver bloqueado, processamos a tentativa de login
        $email = $_POST['email'] ?? '';
        $senha = $_POST['password'] ?? '';

        // Captura dados do IP para o log
        $ipAtual = $_SERVER['REMOTE_ADDR'];

        // INSTANCIA O TEU LOGGER (da resposta anterior) para registar o evento
        // Importante: O level deve ser 'LOGIN_ATTEMPT' para a função de verificação contar
        $logger = new JsonAppendLogger('logs.jsonl');
        $logger->create('LOGIN_ATTEMPT', "Tentativa de login para o email: $email", ['ip' => $ipAtual]);

        // Aqui entraria a tua lógica real de validação com a Base de Dados
        $loginSucesso = false; // Exemplo de falha

        if ($loginSucesso) {
            // Regista sucesso e redireciona para o painel/dashboard
            $logger->create('INFO', "Login efetuado com sucesso", ['ip' => $ipAtual, 'email' => $email]);
            echo "Login correto! Redirecionando...";
            exit;
        } else {
            $mensagemErro = "Credenciais incorretas! Tente novamente.";

            // Atualiza os dados do rate limit após esta nova tentativa falhada para a interface
            $rateLimit = verificarLimiteLogin('logs.jsonl', 5);
            if ($rateLimit['bloqueado']) {
                $mensagemErro = $rateLimit['mensagem'];
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Login Seguro</title>
    <style>
        .alerta {
            color: #fff;
            background-color: #d9534f;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            font-family: sans-serif;
        }

        .formulario {
            width: 300px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .campo {
            margin-bottom: 10px;
        }

        .campo input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        .btn {
            width: 100%;
            padding: 10px;
            background-color: #0275d8;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        .btn:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }
    </style>
</head>

<body>

    <div class="formulario">
        <h2>Login</h2>

        <?php if (!empty($mensagemErro)): ?>
            <div class="alerta">
                <?php echo $mensagemErro; ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="campo">
                <label>E-mail:</label>
                <input type="email" name="email" required <?php echo $rateLimit['bloqueado'] ? 'disabled' : ''; ?>>
            </div>
            <div class="campo">
                <label>Senha:</label>
                <input type="password" name="password" required <?php echo $rateLimit['bloqueado'] ? 'disabled' : ''; ?>>
            </div>

            <button type="submit" class="btn" <?php echo $rateLimit['bloqueado'] ? 'disabled' : ''; ?>>
                Entrar
            </button>
        </form>
    </div>

</body>

</html>
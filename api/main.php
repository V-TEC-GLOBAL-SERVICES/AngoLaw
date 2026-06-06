<?php
# Funcao de login
function login($connect)
{
    # busca todos os dados do formulario
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT); // impedir o uso de virgula

    # converter todos os valores em htmlspecialchars para evitar XSS
    foreach ($dados as $campo => $valor) {
        $dados[$campo] = htmlspecialchars($valor);
    }

    $email = $dados['email'] ?? 'NAN';
    $senha = $dados['senha'] ?? 'NAN';

    # criar o url
    //$header = getCurrentUrlFromIndex();

    # buscar informacoes do usuario
    $return = buscaUnica("SELECT * FROM `usuarios` WHERE `email` = '{$email}'", $connect);

    // if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'] ?? '')) {
    //     warning("Requisição inválida (token).");
    // }

    if ($return && password_verify($senha, $return['senha'] ?? 'NAN')) {

        # verificar o estado da conta
        if ($return['estado'] != 'Ativo') {
            danger("<p>A sua conta não está <b>ativada</b>!</p><p>Contacte o <b>administrador</b> ou a equipe de <b>atendimento</b>!</p>");
            return;
        }

        # iniciar a sessão de usuario
        $usuarioID = password_hash($return['id'] ?? 'NAN', PASSWORD_DEFAULT);
        $_SESSION[$usuarioID] = $return;
        $_SESSION[$usuarioID]['sessao'] = session_id();

        # registrar data de login
        atualizar('usuarios', ['login' => date("Y-m-d")], $return['id'], null, null, true, $connect);

        # verificar acesso
        $acesso = strtolower($return['acesso']);

        # buscar dados da empresa
        $empresa = '';
        if ($acesso == 'admin')
            $empresa = buscaUnica("SELECT * FROM `empresas` WHERE `usuario`='{$return['id']}'", $connect);
        else
            $empresa = buscaUnica("SELECT * FROM `empresas` WHERE `id`='{$return['empresa']}'", $connect);

        # registrar na sessao
        if ($empresa) {
            $_SESSION[$usuarioID]['empresa'] = $empresa;
        } else {
            notificacao("Sistma", 'Erro ao encontrar empresa', 'error');
            return;
        }

        # Sucesso no login
        header("location: index.php?u=$usuarioID&page=$acesso");
    } else {
        // Falha no login
        $msg = '
        <div class="toast-notification error fade-in-down">
            <div class="toast-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
            </div>
            <div class="toast-content">
                <strong>Erro no login!</strong>
                <span>Dados de acesso incorretos.</span>
            </div>
            <button class="toast-close" onclick="this.parentElement.style.display=\'none\';">&times;</button>
        </div>';

        echo $msg;
    }
}

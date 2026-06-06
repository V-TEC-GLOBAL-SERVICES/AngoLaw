<?php
# registrar usuario
function setterUser($connect){
    # busca todos os dados do formulario
    $dados = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
    //var_dump($dados);

    # var de erro
    $erros = array();

    # converter todos os valores em htmlspecialchars para evitar XSS
    foreach ($dados as $campo => $valor) {
        $dados[$campo] = htmlspecialchars($valor);
    }

    # verificar dados
    if (strlen($dados['nome']) < 5) $erros[] = "Insira mais digitos no nome, minimo é 5!";
    if (buscaTotal("SELECT `email` FROM `usuarios` WHERE `email`='{$dados['email']}'", $connect))
        $erros[] = "E-mail já está em uso!";

    # verificar todos os campos obrigatórios
    foreach ($dados as $campo => $valor) {
        if (empty($valor)) {
            $erros[] = "O campo " . ucfirst($campo) . " é obrigatório!";
        }
        if (strlen($valor) > 130) {
            $erros[] = "O campo " . ucfirst($campo) . " tem mais de 130 caracteres!";
        }
    }

    # criar senha
    $senha = password_hash($dados['senha'] ?? "1234", PASSWORD_DEFAULT);

    # inserir dados
    if (query("INSERT INTO `usuarios` (`nome`, `email`, `contacto`, `senha`) VALUES('{$dados['nome']}', '{$dados['email']}', NULL, '{$senha}');", $connect, NULL, $erros, true)) {
        notificacao('Sistema', 'Operação realizada com sucesso');
    } else {
        # TOAST DE ERRO
        $erros_str = implode('<br>', $erros);
        notificacao('Sistema', $erros_str, 'error');
    }
}
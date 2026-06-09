<?php
# registrar usuario
function setterUser($connect)
{
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
    if (query("INSERT INTO `usuarios` (`nome`, `email`, `senha`) VALUES('{$dados['nome']}', '{$dados['email']}', '{$senha}');", $connect, NULL, $erros, true)) {
        notificacao('Sistema', 'Operação realizada com sucesso');
    } else {
        # TOAST DE ERRO
        $erros_str = implode('<br>', $erros);
        notificacao('Sistema', $erros_str, 'error');
    }
}

# funcao para cadastrar turma
function updateUsuario($user, $connect)
{
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
    if (empty($user['id']) && !is_numeric($user['id'])) {
        $erros[] = "Usuário inválido!";
    }
    if (strlen($dados['nome']) < 5) {
        $erros[] = "Insira mais digitos no nome, minimo é 5!";
    }
    if (buscaTotal("SELECT * FROM `usuarios` WHERE `email`='{$dados['email']}' AND `id`!='{$user['id']}'", $connect)) {
        $erros[] = "E-mail já está em uso noutra conta!";
    }
    if (buscaTotal("SELECT * FROM `usuarios` WHERE `contacto`='{$dados['contacto']}' AND `id`!='{$user['id']}'", $connect)) {
        $erros[] = "Número de telefone já está em uso noutra conta!";
    }

    # verificar todos os campos obrigatórios
    foreach ($dados as $campo => $valor) {
        if (empty($valor) && $campo != 'senha') {
            $erros[] = "O campo " . ucfirst($campo) . " é obrigatório!";
        }
        if (strlen($valor) > 130) {
            $erros[] = "O campo " . ucfirst($campo) . " tem mais de 130 caracteres!";
        }
    }

    # gerar senha automaticamente
    if (!empty($dados['senha'])) {
        $senha = password_hash($dados['senha'], PASSWORD_DEFAULT);
        atualizar('usuarios', [
            'senha' => $senha
        ], $user['id'], $erros, null, true, $connect);
    }

    atualizar('usuarios', [
        'nome' => $dados['nome'] ?? ($user['nome'] ?? NULL),
        'email' => $dados['email'] ?? ($user['email'] ?? NULL),
        'contacto' => $dados['contacto'] ?? ($user['contacto'] ?? NULL),
        'biografia' => $dados['biografia'] ?? ($user['biografia'] ?? NULL),
        'localizacao' => $dados['localizacao'] ?? ($user['localizacao'] ?? NULL),
        'nascimento' => $dados['nascimento'] ?? ($user['nascimento'] ?? NULL),
        'genero' => $dados['genero'] ?? ($user['genero'] ?? NULL),
        'profissao' => $dados['profissao'] ?? ($user['profissao'] ?? NULL),
        'idiomas' => $dados['idiomas'] ?? ($user['idiomas'] ?? NULL)
    ], $user['id'], $erros, null, false, $connect);

    # atualizar sessao
    $_SESSION[session_id()] = buscaUnica("SELECT * FROM `usuarios` WHERE `id`='{$user['id']}'", $connect);
    $_SESSION[session_id()]['sessao'] = session_id();
    $user = $_SESSION[session_id()];

    # enviar notificacao
    //query("INSERT INTO `notificacoes` (`usuario`, `tipo`, `titulo`, `mensagem`, `lido`, `data`) VALUES ('{$id}', 'Aviso', 'Atualização', 'Os dados da sua conta foram atualizados!!!', 0, curdate());", $connect, null, null, true);
}

# fazer publicacao
function setterPublicacao($user, $connect)
{
    # busca todos os dados do formulario
    $dados = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
    //var_dump($dados);

    # var de erro
    $erros = array();

    # verificar todos os campos obrigatórios
    foreach ($dados as $campo => $valor) {
        # converter todos os valores em htmlspecialchars para evitar XSS
        $dados[$campo] = htmlspecialchars($valor);

        if (empty($valor) && $campo != 'senha') {
            $erros[] = "O campo " . ucfirst($campo) . " é obrigatório!";
        }
        if (strlen($valor) > 130) {
            $erros[] = "O campo " . ucfirst($campo) . " tem mais de 130 caracteres!";
        }
    }

    # verificar dados
    if (empty($user['id']) && !is_numeric($user['id'])) {
        $erros[] = "Usuário inválido!";
    }

    query("INSERT INTO `publicacoes` (`usuario`, `url`, `titulo`, `tipo`, `descricao`) VALUES('{$user['id']}', '{$dados['url']}', '{$dados['titulo']}', '{$dados['tipo']}', '{$dados['descricao']}');", $connect, null, $erros, false);
}

# criar documento
function setterDocumento($user, $connect)
{
    # busca todos os dados do formulario
    $dados = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
    //var_dump($dados);

    # var de erro
    $erros = array();

    # verificar todos os campos obrigatórios
    foreach ($dados as $campo => $valor) {
        # converter todos os valores em htmlspecialchars para evitar XSS
        $dados[$campo] = htmlspecialchars($valor);

        if (empty($valor) && $campo != 'senha') {
            $erros[] = "O campo " . ucfirst($campo) . " é obrigatório!";
        }
        if (strlen($valor) > 130) {
            $erros[] = "O campo " . ucfirst($campo) . " tem mais de 130 caracteres!";
        }
    }

    # verificar dados
    if (empty($user['id']) && !is_numeric($user['id'])) {
        $erros[] = "Usuário inválido!";
    }

    // Verifica se o arquivo foi enviado
    $documento='';
    if (isset($_FILES['documento'])) {

        $diretorioUploads = 'uploads/documentos/'; // Pasta onde os arquivos ficarão salvos

        // Chama a função
        $documento = uploadDocumento($_FILES['documento'], $diretorioUploads);

        if ($documento['sucesso']) {
            notificacao("Documento", $documento['mensagem']);
        } else {
            $erros[] = $documento['mensagem'];
        }
    } else {
        $erros[] = "Nenhum arquivo foi enviado.";
    }
    
    # fazer o upload de imagem
    $imagem='';
    if (isset($_FILES['imagem'])) {

        $caminho = 'uploads/imagens/'; // Pasta onde os arquivos ficarão salvos

        // Chama a função
        $imagem = carregarImagem($caminho, "img_".$user['nome'].date("Y-m-d H-i-s"));

        if ($imagem['sucesso']) {
            notificacao("Imagem", $imagem['mensagem']);
        } else {
            $erros[] = $imagem['mensagem'];
            //var_dump($imagem);
        }
    } else {
        $erros[] = "Nenhuma imagem foi enviada!";
    }

    # enviar dados na BD
    query("INSERT INTO `documentos` (`usuario`, `imagem`, `titulo`, `tipo`, `descricao`, `documento`) VALUES ( '{$user['id']}', '{$imagem['arquivo']}', '{$dados['titulo']}', '{$dados['tipo']}', '{$dados['descricao']}', '{$documento['arquivo']}');", $connect, null, $erros, false);
}

<?php
# Funcoes de busca

# Funcao de login
function login($connect)
{
	# busca todos os dados do formulario
	$dados = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW); // impedir o uso de virgula

	# Verificacao CSRF
	// if (!isset($_SESSION[session_id()])) {
	// 	//$_SESSION[session_id()]['csrf_token'] = bin2hex(random_bytes(16));
	// 	$_SESSION[session_id()]['csrf_time'] = date('H-i-s');
	// 	$_SESSION[session_id()]['csrf_submit'] = 0;
	// 	$_SESSION[session_id()]['csrf_exp'] = date('H-') . ((int) date('i') + (int) 3) . date('-s');
	// }

	# contador de envio
	// $_SESSION[session_id()]['csrf_submit']++;
	// if ($_SESSION[session_id()]['csrf_submit'] >= 3 && date('H-i-s') <= $_SESSION[session_id()]['csrf_exp']) {
	// 	echo "Limite de tentativas atingido, tentar em: ". $_SESSION[session_id()]['csrf_exp'];
	// 	return;
	// } else if($_SESSION[session_id()]['csrf_submit'] >= 3 && date('H-i-s') >= $_SESSION[session_id()]['csrf_exp']){
	// 	$_SESSION[session_id()]['csrf_exp'] = date('H-') . ((int) date('i') + (int) 3) . date('-s');
	// }

	// var_dump($_SESSION[session_id()]);

	# converter todos os valores em htmlspecialchars para evitar XSS
	foreach ($dados as $campo => $valor) {
		$dados[$campo] = htmlspecialchars($valor);
	}

	$email = $dados['email'] ?? 'NAN';
	$senha = $dados['senha'] ?? 'NAN';

	# buscar informacoes do usuario
	$return = buscaUnica("SELECT * FROM `usuarios` WHERE `email` = '{$email}'", $connect);

	if ($return && password_verify($senha, $return['senha'] ?? 'NAN')) {

		# verificar o estado da conta
		if ($return['estado'] != 'Ativo') {
			notificacao("Autenticação", "<p>A sua conta não está <b>ativada</b>!</p><p>Contacte o <b>administrador</b> ou a equipe de <b>atendimento</b>!</p>", "error");
			return;
		}

		# iniciar a sessão de usuario
		//$usuarioID = password_hash($return['id'] ?? 'NAN', PASSWORD_DEFAULT);
		//$usuarioID = password_hash(session_id(), PASSWORD_DEFAULT);
		$_SESSION[session_id()] = $return;
		$_SESSION[session_id()]['sessao'] = session_id();

		# registrar data de login
		atualizar('usuarios', ['login' => date("Y-m-d")], $return['id'], null, null, true, $connect);

		# verificar acesso
		$acesso = strtolower($return['acesso']);

		# Sucesso no login
		header("location: index.php?pagina=$acesso");
	} else {
		// Falha no login
		notificacao('Sistema', 'Dados de acesso inválidos!', 'error');
	}
}

/**
 * Buscar todos dados no banco de dados
 * @param $query - Usado para solicitar a busca
 * @param $connect - Usado para conectar no banco de dados
 * @param Obs: Esta função retorna os resultados do banco de dados em array
 */
function busca($query, $connect)
{
	$execute = mysqli_query($connect, $query);
	$results = mysqli_fetch_all($execute, MYSQLI_ASSOC);
	return $results;
}

# Seleciona(busca) no BD apenas um resultado com base na Query
/**
 * Buscar apenas um dados no banco de dados
 * @param $query - Usado para solicitar a busca
 * @param $connect - Usado para conectar no banco de dados
 * @param Obs: Esta função retorna os resultados do banco de dados em array
 */
function buscaUnica($query, $connect)
{
	$execute = mysqli_query($connect, $query);
	$result = mysqli_fetch_assoc($execute);
	return $result;
}

# Seleciona(busca) no BD todos os resultados com base na Query e da um total
/**
 * Buscar apenas um dados no banco de dados
 * @param $query - Usado para solicitar a busca
 * @param $connect - Usado para conectar no banco de dados
 * @param Obs: Esta função retorna os resultados do banco de dados em números inteiros
 */
function buscaTotal($query, $connect)
{
	$execute = mysqli_query($connect, $query);
	$results = mysqli_num_rows($execute);
	return $results;
}

# gera numeros random
/**
 * Criar id para um usuario
 * @param $c - Usado para definir o tipo de conta
 * @param $c = U - usuario - Definido para usuarios
 * @param $c = C - cliente - Definido para clientes
 * @param $c = E - empresa - Definido para empresas
 * @param $connect - Usado para conectar no banco de dados
 * @param Obs: Esta função retorna os resultados do banco de dados em números inteiros
 */
function random($c = 'usuario', $i = 1000, $s = 9999)
{
	define("INFERIOR", $i);
	define("SUPERIOR", $s);
	$numero = rand(INFERIOR, SUPERIOR);

	# verificar se é empresa


	# verificar se a conta e de usuario/cliente
	if ($c == 'usuario') {
		return 'U' . $numero . random_letras();
	} elseif ($c == 'cliente') {
		return 'C' . $numero . random_letras();
	} elseif ($c == 'empresa') {
		return 'E' . $numero . random_letras();
	} else {
		return $numero;
	}
}
function random_letras()
{
	$str = str_split("QWERTYUIOPASDFGHJKLZXCVBNM");
	//echo $str[0];
	return $str[rand(0, 25)];
}

function random_numeros($inicio = 1000, $fim = 9999)
{
	return rand($inicio, $fim);
}

# funcao para calcular diferenca entre datas
/**
 * funcao para calcular diferenca entre datas
 * @param string $data usado para definir a data de referencia
 * @param return [y,m,d] ou [a] -> y-m-d ou [e]->m-d
 * 
 */
function calcData($data)
{
	# calcular datas
	$data_b = new DateTime($data);
	$data_a = new DateTime(date('Y-m-d'));

	# fazer o calculo
	$intervalo = $data_a->diff($data_b);

	# criar uma array
	$result = array();

	# normais
	$result['y'] = $intervalo->y;
	$result['m'] = $intervalo->m;
	$result['d'] = $intervalo->d;

	# combinadas
	$result['a'] = $intervalo->y . " :ano, " . $intervalo->m . " :meses, " . $intervalo->d . " :dias";
	$result['e'] = $intervalo->m . " :meses, " . $intervalo->d . " :dias";

	# retornar os valores em uma array
	return $result;
}

# funcao para somar datas
/**
 * Função de somar datas
 * @param $dataInicial Data de referência
 * @param $intervalo número a adicionar
 * @param $unidade tipo de unidade ('dias', 'meses', 'anos')
 * @param Exemplo: somarDatas('2004-11-27', '1', 'ano')
 * @return soma $data
 */
function somarDatas($dataInicial, $intervalo, $unidade)
{
	// Converter a data inicial para um objeto DateTime
	$data = new DateTime($dataInicial);

	// Verificar a unidade e criar o intervalo correspondente
	switch ($unidade) {
		case 'dias':
			$data->modify("+$intervalo days");
			break;
		case 'meses':
			$data->modify("+$intervalo months");
			break;
		case 'anos':
			$data->modify("+$intervalo years");
			break;
		default:
			throw new Exception("Unidade inválida. Use 'dias', 'meses' ou 'anos'.");
	}

	// Retornar a data resultante no formato Y-m-d
	return $data->format('Y-m-d');
}

# formatar numero para moeda
function formatarMoeda($numero, $simbolo = 'Kz', $decimais = 2, $separadorDecimal = ',', $separadorMilhar = '.')
{
	return number_format($numero, $decimais, $separadorDecimal, $separadorMilhar) . ' ' . $simbolo;
	// Exemplo de uso
	//$valor = 1234567.89;
	//echo formatarMoeda($valor); // Saída: R$ 1.234.567,89
}

# funcao para fazer as query
/** 
 * Inserir dados no banco de dados
 * 
 * @param $sql usado para enviar instruções
 * @param $connect usado para a conexão  
 * @param $warning usado para a personalizar uma mensagem
 * @param Obs: $warning serve para dar um aviso personalizado para o usuario
 * @param $bool=true Serve para a função retornar um valor verdadeiro ou falso
 * @param use mode - query("", $connect, $warning, $erros, $bool)
 */
function query($sql, $connect, $warning = null, $erros = null, $bool = false)
{
	if (empty($erros)) {
		# executar a query
		$executar = mysqli_query($connect, $sql);
		if ($executar) {
			if (!empty($warning) && !$bool) {
				//header("Location: {$header}&modal=warning&warning={$warning}");
				notificacao('Sistema', $warning, 'info');
			} elseif (empty($warning) && !$bool) {
				//header("Location: {$header}&modal=success");
				notificacao('Sistema', 'Operação realizada com sucesso', 'success');
			} else {
				return true;
			}
		} else {
			//header("Location: {$header}&modal=danger");
			notificacao('Sistema', 'Falha ao realizar a operação!', 'error');
		}
	} else {
		$lista = implode('<br>', $erros);
		//header("location: {$header}&modal=warning&warning={$lista}");
		notificacao('Sistema', $lista, 'error');
	}
}

# eliminar dados
/** 
 * Função para eliminar dados no banco de dados
 * 
 * @param $tabela usado para especificar a tabela a ser atualizada
 * @param $id usado para a identificar a linha
 * @param $connect usado para a conexão  
 * @param Obs: mode de usar - eliminar('tabela', $id, $connect)
 */
function eliminar($tabela, $parameter, $connect)
{
	if (buscaTotal("SELECT * FROM `$tabela` WHERE {$parameter}", $connect)) {
		$executar = mysqli_query($connect, "DELETE FROM `{$tabela}` WHERE {$parameter}");
		if ($executar)
			notificacao('Sistema', 'Item eliminado com sucesso', 'info');
		else
			notificacao('Sistema', 'Falha ao elimina o item', 'error');
	} else {
		notificacao('Sistema', 'Falha ao elimina o item,, não existe', 'error');
	}
}

# funcao para atualizar dados
// 
/** 
 * Função para atualizar os dados no banco de dados
 * 
 * @param $tabela usado para especificar a tabela a ser atualizada
 * @param $dados usado para enviar dados
 * @param $id usado para a identificar a linha
 * @param $erros usado para enviar os erros em array
 * @param $warning usado para emitir um aviso personalizado (success, info, error)
 * @param $connect usado para a conexão  
 * @param Obs: modo de usar - atualizar('tabela', ['linha' => 'valor', 'linha' => 'valor'], $id, $erros, 'Sucesso!', false, $connect)  
 */
function atualizar($tabela, $dados, $id, $erros, $warning, $bool, $connect)
{
	$set = [];
	foreach ($dados as $coluna => $valor) {
		$set[] = "`$coluna` = '$valor'";
	}
	$set = implode(', ', $set);
	$sql = "UPDATE `$tabela` SET $set WHERE `id` = '$id'";

	if (empty($erros)) {
		# executar a query
		$executar = mysqli_query($connect, $sql);
		if ($executar) {
			if (!empty($warning) && !$bool) {
				notificacao('Sistema', $warning, 'info');
			} elseif (empty($warning) && !$bool) {
				notificacao('Sistema', 'Operação realizada com sucesso', 'success');
			} else {
				return true;
			}
		} else {
			notificacao('Sistema', 'Falha ao realizar a operação!', 'error');
		}
	} else {
		$lista = implode('<br>', $erros);
		notificacao('Sistema', $lista, 'error');
	}
}

/** 
 * Função para alterar a url atual com base na variavel $_GET
 * 
 * @return return Esta funcao retorna a url atual  
 */
function getCurrentUrlFromIndex()
{
	$url = $_SERVER['REQUEST_URI'];
	$indexPos = strpos($url, 'index.php');
	if ($indexPos !== false) {
		return substr($url, $indexPos);
	}
	return $url;
}

/** 
 * Função para cortar a url atual com base na variavel $_GET
 * 
 * @param mixed $get Usado para especificar a variável para cortar
 * @return return Esta funcao retorna a url modificada
 */
function cortarUrl($get = 'modal')
{
	// Verifica se existe uma query string na URL
	if (isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING'])) {
		// Divide a query string em um array de parâmetros
		$params = explode('&', $_SERVER['QUERY_STRING']);
		$paramsBeforeModal = [];

		// Itera sobre os parâmetros e acumula somente os que vêm antes de "modal"
		foreach ($params as $param) {
			// Se o parâmetro começar com "modal=" ou for exatamente "modal", interrompe a iteração
			if (strpos($param, $get . '=') === 0 || $param === $get) {
				break;
			}
			$paramsBeforeModal[] = $param;
		}

		// Reconstrói a nova query string com os parâmetros capturados
		$newQueryString = implode('&', $paramsBeforeModal);
		// Monta a nova URL utilizando o caminho atual
		$newUrl = $_SERVER['PHP_SELF'] . ($newQueryString ? '?' . $newQueryString : '');

		# retornar a url modificada
		if ($get != 'modal') {
			return $newUrl;
		}

		// Se a URL atual for diferente, redireciona para a nova URL
		if ($_SERVER['REQUEST_URI'] !== $newUrl) {
			header("Location: " . $newUrl);
			exit;
		}
	}
}

# terminar a sessao
function logout($sessao)
{
	# ir para a pagina inicial
	echo "<script>window.location.href='index.php'</script>";

	# terminar apenas a sessao de uma conta especifica
	unset($_SESSION[$sessao]);
}

# funcao de eliminar dados
function deletar($tabela, $id, $connect)
{
	if (isset($_POST['sim'], $_GET['id'], $_GET['modal'], $_GET['confirmar']) && $_GET['confirmar'] == 'eliminar') {
		eliminar($tabela, base64_decode($id), $connect);
	}
}

/**
 * Verifica se os dados estão preenchidos e possuem pelo menos 4 caracteres.
 *
 * @param array $dados Dados a serem validados.
 * @return array Lista de erros encontrados.
 */
function validarDados($dados)
{
	$erros = [];

	foreach ($dados as $campo => $valor) {
		if (empty($valor)) {
			$erros[] = "O campo '{$campo}' está vazio.";
		} elseif (is_string($valor) && strlen($valor) < 4) {
			$erros[] = "O campo '{$campo}' deve conter pelo menos 4 caracteres.";
		}
	}

	return $erros;
}

/**
 * Função para enviar o modal de aviso para o usuario
 *
 * @param var $warning serve para enviar a mensagem.
 * @return Retorna o modal de aviso.
 */
function warning($warning)
{
	$header = getCurrentUrlFromIndex();
	header("Location: {$header}&modal=warning&warning={$warning}");
	exit;
}

/**
 * Função para enviar o modal de aviso para o usuario
 *
 * @param var $danger serve para enviar a mensagem.
 * @return Retorna o modal de aviso.
 */
function danger($danger)
{
	$header = getCurrentUrlFromIndex();
	header("Location: {$header}&modal=danger&danger={$danger}");
	exit;
}

/**
 * Funcao para enviar notificacao
 * @param var $title serve para especificar o titulo
 * @param var $msg serve para especificar a mensagem
 * @param var $type serve para especificar to tipo de mensagem (success, error, info)
 */
function notificacao($title = 'Notifição', $msg = 'Operação realizada com sucesso', $type = 'success')
{
	# var de controle
	// $_SESSION[$_GET['u'] ?? '0']['notif']['msg'] = $msg;
	// $_SESSION[$_GET['u'] ?? '0']['notif']['type'] = $type;
	// $_SESSION[$_GET['u'] ?? '0']['notif']['title'] = $title;

	echo "<script>mostrarToast('{$msg}','{$type}')</script>";
}

/**
 * Faz upload e compressão de uma imagem
 *
 * @param string $caminho Caminho onde a imagem será salva
 * @param string $nome Nome base da imagem (sem extensão)
 * @param string $file Nome do campo de arquivo no formulário
 * @return array Retorna ['success'=>true, 'file'=>...] ou ['success'=>false, 'errors'=>[...]]
 */
function uploadImagem($caminho, $nome, $file = 'imagem')
{
	$resultado = ['success' => false, 'errors' => []];

	if (empty($_FILES[$file]['name'])) {
		$resultado['errors'][] = "Nenhum arquivo enviado.";
		return $resultado;
	}

	$nomeImagem     = $_FILES[$file]['name'];
	$nomeTemporario = $_FILES[$file]['tmp_name'];
	$tamanho        = $_FILES[$file]['size'];

	// Verifica se é realmente um upload válido
	if (!is_uploaded_file($nomeTemporario)) {
		$resultado['errors'][] = "Upload inválido.";
		return $resultado;
	}

	// Limite de tamanho (7MB)
	$tamanhoMaximo = 1024 * 1024 * 7;
	if ($tamanho > $tamanhoMaximo) {
		$resultado['errors'][] = "Tamanho máximo excedido (7MB).";
	}

	// Extensões permitidas
	$extensao = strtolower(pathinfo($nomeImagem, PATHINFO_EXTENSION));
	$permitidos = ['png', 'jpg', 'jpeg'];
	if (!in_array($extensao, $permitidos)) {
		$resultado['errors'][] = "Tipo de arquivo não permitido.";
	}

	if (!empty($resultado['errors'])) {
		return $resultado;
	}

	// Caminho absoluto
	$destino = rtrim($caminho, "/") . "/" . $nome . ".jpg";

	$arquivoFinal = compressImage($nomeTemporario, $destino, 80); // qualidade ajustada

	if ($arquivoFinal) {
		$resultado['success'] = true;
		$resultado['file'] = $arquivoFinal;
	} else {
		$resultado['errors'][] = "Falha ao processar a imagem.";
	}

	return $resultado;
}

/**
 * Comprime uma imagem e salva em destino
 *
 * @param string $sourcePath Caminho da imagem original
 * @param string $destinationPath Caminho final da imagem
 * @param int $quality Qualidade da compressão (0-100)
 * @return string|false Nome do arquivo gerado ou false em caso de erro
 */
function compressImage($sourcePath, $destinationPath, $quality = 80)
{
	$info = @getimagesize($sourcePath);
	if (!$info) {
		return false;
	}

	switch ($info['mime']) {
		case 'image/jpeg':
			$image = imagecreatefromjpeg($sourcePath);
			break;
		case 'image/png':
			$image = imagecreatefrompng($sourcePath);
			break;
		default:
			return false;
	}

	// Cria diretório se não existir
	if (!file_exists(dirname($destinationPath))) {
		mkdir(dirname($destinationPath), 0775, true);
	}

	// Salva como JPEG
	$ok = imagejpeg($image, $destinationPath, $quality);
	imagedestroy($image);

	return $ok ? basename($destinationPath) : false;
}

/**
 * Carrega uma imagem mantendo a qualidade e o formato original.
 *
 * @param string $sourcePath Caminho temporário da imagem enviada.
 * @param string $destinationPath Caminho de destino para salvar a imagem.
 * @return string|false Retorna o nome do arquivo salvo ou false em caso de erro.
 */
function carregarImagem($caminho, $nome)
{
	$sourcePath = $_FILES['imagem']['tmp_name'];
	//$nomeImagem = $_FILES['imagem']['name'];
	# Cria o diretório de destino se ele não existir
	if (!is_dir($caminho)) {
		mkdir($caminho, 0777, true);
	}


	$erros = array();

	// 3. Define as extensões permitidas
	$extensoesPermitidas = ['png', 'jpg', 'jpeg', "JPG", "JPEG"];

	// Obtém a extensão do arquivo enviado
	$nomeOriginal = basename($_FILES['imagem']['name']);
	$extensao = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));
	$destinationPath = $caminho . $nome . "." . $extensao;


	// 4. Valida a extensão
	if (!in_array($extensao, $extensoesPermitidas)) {
		return [
			'sucesso' => false,
			'mensagem' => 'Formato de arquivo não permitido. Extensões aceitas: ' . implode(', ', $extensoesPermitidas)
		];
	}

	$info = getimagesize($sourcePath);
	if ($info['mime'] == 'image/jpeg') {
		$image = imagecreatefromjpeg($sourcePath);
		$saved = imagejpeg($image, $destinationPath, 100); // Qualidade máxima
	} elseif ($info['mime'] == 'image/png') {
		$image = imagecreatefrompng($sourcePath);
		$saved = imagepng($image, $destinationPath); // Sem compressão adicional
	} else {
		// Não suporta outros formatos
		return [
			'sucesso' => false,
			'mensagem' => 'Formato não permitido! Formatos aceites: image/jpeg, image/png'
		];
	}

	// Libera a memória
	imagedestroy($image);

	//return $saved ? basename($destinationPath) : false;
	return [
		'sucesso' => $saved ? true : false,
		'mensagem' => $saved ? 'Imagem salva com sucesso':'Erro ao salvar imagem!',
		'arquivo' => $saved ? basename($destinationPath) : 'Erro ao salvar imagem!'
	];
}


function filtrarArray($dados, $chave)
{
	// pegar todas as chaves
	$keys = array_keys($dados);

	// encontrar a posição da chave
	$startIndex = array_search($chave, $keys);

	// cortar o array a partir desse índice
	$result = array_slice($dados, $startIndex, null, true);

	return $result;
}

function filtrarNumber($key, $splitter = '-')
{
	$partes = explode($splitter, $key);
	$numero = end($partes);
	return $numero; // 10
}

/**
 * Função para upload de documentos
 *
 * @param array $arquivo O array $_FILES['nome_do_input']
 * @param string $diretorioDestino O caminho da pasta onde o arquivo será salvo
 * @param int $tamanhoMaximo Tamanho máximo permitido em bytes (Padrão: 5MB)
 * @return array Retorna um array com 'sucesso' (bool) e 'mensagem' ou 'caminho'
 */
function uploadDocumento($arquivo, $diretorioDestino, $tamanhoMaximo = 5242880)
{

	// 1. Verifica se houve algum erro nativo no upload
	if ($arquivo['error'] !== UPLOAD_ERR_OK) {
		return [
			'sucesso' => false,
			'mensagem' => 'Erro ao fazer upload do arquivo. Código de erro: ' . $arquivo['error']
		];
	}

	// 2. Verifica o tamanho do arquivo
	if ($arquivo['size'] > $tamanhoMaximo) {
		return [
			'sucesso' => false,
			'mensagem' => 'O arquivo excede o tamanho máximo permitido de ' . ($tamanhoMaximo / 1048576) . 'MB.'
		];
	}

	// 3. Define as extensões permitidas
	$extensoesPermitidas = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt', 'rtf', 'csv'];

	// Obtém a extensão do arquivo enviado
	$nomeOriginal = basename($arquivo['name']);
	$extensao = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));

	// 4. Valida a extensão
	if (!in_array($extensao, $extensoesPermitidas)) {
		return [
			'sucesso' => false,
			'mensagem' => 'Formato de arquivo não permitido. Extensões aceitas: ' . implode(', ', $extensoesPermitidas)
		];
	}

	// 5. Cria o diretório de destino se ele não existir
	if (!is_dir($diretorioDestino)) {
		mkdir($diretorioDestino, 0777, true);
	}

	// 6. Gera um nome único para o arquivo (evita sobrescrever arquivos com o mesmo nome e problemas com caracteres especiais)
	$novoNome = uniqid('doc_', true) . '.' . $extensao;
	$caminhoCompleto = rtrim($diretorioDestino, '/') . '/' . $novoNome;

	// 7. Move o arquivo do diretório temporário para o destino final
	if (move_uploaded_file($arquivo['tmp_name'], $caminhoCompleto)) {
		return [
			'sucesso' => true,
			'mensagem' => 'Upload realizado com sucesso!',
			'caminho' => $caminhoCompleto,
			'arquivo' => $novoNome
		];
	} else {
		return [
			'sucesso' => false,
			'mensagem' => 'Falha ao mover o arquivo para o diretório de destino.'
		];
	}
}

// 1. Inicializa o Logger
$logger = new JsonLogger('meus_logs.json');

// --- C R E A T E ---
echo "<h2>Criando Logs...</h2>";
$id1 = $logger->create('INFO', 'Usuário fez login com sucesso.', ['user_id' => 42]);
$id2 = $logger->create('ERROR', 'Falha ao conectar com a API externa.', ['api' => 'V-WALLET']);

echo "Log 1 criado com ID: $id1 <br>";
echo "Log 2 criado com ID: $id2 <br>";


// --- R E A D ---
echo "<h2>Lendo os Logs...</h2>";
// Ler todos
$todosLogs = $logger->read();
echo "
<pre>" . print_r($todosLogs, true) . "</pre>";

// Ler apenas um
$logEspecifico = $logger->read($id1);
echo "Busca por ID único:<br>";
echo "
<pre>" . print_r($logEspecifico, true) . "</pre>";


// --- U P D A T E ---
echo "<h2>Atualizando um Log...</h2>";
// Vamos atualizar o log de erro para dizer que o problema foi resolvido
$logger->update($id2, [
'message' => 'Falha ao conectar com a API externa. (RESOLVIDO)',
'status_resolucao' => 'Conexão restabelecida após retry.'
]);
echo "Log de erro atualizado.<br>";


// --- D E L E T E ---
echo "<h2>Deletando um Log...</h2>";
// Remove o primeiro log criado
if ($logger->delete($id1)) {
echo "Log $id1 removido com sucesso.<br>";
}
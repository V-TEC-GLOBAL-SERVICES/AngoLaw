<?php
header('Content-Type: application/json; charset=utf-8');
$path = __DIR__ . '/admin_data.json';
if (!file_exists($path)) {
    echo json_encode(['success' => false, 'error' => 'Ficheiro de dados não encontrado.']);
    exit;
}

$json = file_get_contents($path);
$data = json_decode($json, true);
if (!is_array($data)) {
    echo json_encode(['success' => false, 'error' => 'Dados inválidos.']);
    exit;
}

$entity = $_POST['entity'] ?? '';
$action = $_POST['action'] ?? '';
$allowed = ['profile', 'publications', 'documents', 'articles', 'playlists'];
if (!in_array($entity, $allowed, true) && $action !== 'profile') {
    echo json_encode(['success' => false, 'error' => 'Entidade inválida.']);
    exit;
}

function write_data($path, $data) {
    $out = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    return file_put_contents($path, $out, LOCK_EX) !== false;
}

function create_item($entity, $payload) {
    return array_merge(['id' => bin2hex(random_bytes(8))], $payload);
}

if ($action === 'profile') {
    $data['profile'] = [
        'name' => trim($_POST['name'] ?? ''),
        'role' => trim($_POST['role'] ?? ''),
        'email' => trim($_POST['email'] ?? ''),
        'location' => trim($_POST['location'] ?? ''),
        'phone' => trim($_POST['phone'] ?? ''),
        'bio' => trim($_POST['bio'] ?? '')
    ];
    if ($data['profile']['name'] === '' || $data['profile']['role'] === '') {
        echo json_encode(['success' => false, 'error' => 'Nome e função são obrigatórios.']);
        exit;
    }
    if (!write_data($path, $data)) {
        echo json_encode(['success' => false, 'error' => 'Falha ao gravar o perfil.']);
        exit;
    }
    echo json_encode(['success' => true]);
    exit;
}

if (!in_array($action, ['add', 'delete', 'update'], true)) {
    echo json_encode(['success' => false, 'error' => 'Ação inválida.']);
    exit;
}

if (!isset($data[$entity]) || !is_array($data[$entity])) {
    $data[$entity] = [];
}

if ($action === 'add' || $action === 'update') {
    $payload = [];
    foreach ($_POST as $key => $value) {
        if (in_array($key, ['url', 'title', 'type', 'description', 'image', 'body', 'category'], true)) {
            $payload[$key] = trim($value);
        }
    }
    if (empty($payload['title']) && empty($payload['url']) && empty($payload['category'])) {
        echo json_encode(['success' => false, 'error' => 'Preencha pelo menos os campos obrigatórios.']);
        exit;
    }

    if ($action === 'update') {
        $id = trim($_POST['id'] ?? '');
        if ($id === '') {
            echo json_encode(['success' => false, 'error' => 'ID inválido.']);
            exit;
        }
        $found = false;
        foreach ($data[$entity] as $index => $item) {
            if (isset($item['id']) && $item['id'] === $id) {
                $found = true;
                $data[$entity][$index] = array_merge($item, $payload);
                break;
            }
        }
        if (!$found) {
            echo json_encode(['success' => false, 'error' => 'Item não encontrado.']);
            exit;
        }
        if (!write_data($path, $data)) {
            echo json_encode(['success' => false, 'error' => 'Falha ao gravar item.']);
            exit;
        }
        echo json_encode(['success' => true, 'item' => $data[$entity][$index]]);
        exit;
    }

    $item = create_item($entity, $payload);
    $data[$entity][] = $item;
    if (!write_data($path, $data)) {
        echo json_encode(['success' => false, 'error' => 'Falha ao gravar item.']);
        exit;
    }
    echo json_encode(['success' => true, 'item' => $item]);
    exit;
}

if ($action === 'delete') {
    $id = trim($_POST['id'] ?? '');
    if ($id === '') {
        echo json_encode(['success' => false, 'error' => 'ID inválido.']);
        exit;
    }
    $found = false;
    foreach ($data[$entity] as $index => $item) {
        if (isset($item['id']) && $item['id'] === $id) {
            $found = true;
            array_splice($data[$entity], $index, 1);
            break;
        }
    }
    if (!$found) {
        echo json_encode(['success' => false, 'error' => 'Item não encontrado.']);
        exit;
    }
    if (!write_data($path, $data)) {
        echo json_encode(['success' => false, 'error' => 'Falha ao gravar exclusão.']);
        exit;
    }
    echo json_encode(['success' => true]);
    exit;
}

echo json_encode(['success' => false, 'error' => 'Sem ação válida.']);

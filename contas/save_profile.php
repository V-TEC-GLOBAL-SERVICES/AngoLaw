<?php
header('Content-Type: application/json; charset=utf-8');

// Local do ficheiro JSON
$path = __DIR__ . '/profile.json';

// Ler dados POST
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$age = isset($_POST['age']) ? intval($_POST['age']) : null;
$gender = isset($_POST['gender']) ? trim($_POST['gender']) : '';
$profession = isset($_POST['profession']) ? trim($_POST['profession']) : '';
$location = isset($_POST['location']) ? trim($_POST['location']) : '';
$contact = isset($_POST['contact']) ? trim($_POST['contact']) : '';
$bio = isset($_POST['bio']) ? trim($_POST['bio']) : '';

// Validação básica
$errors = [];
if($name === '') $errors[] = 'Nome é obrigatório';
if($age !== null && ($age < 18 || $age > 120)) $errors[] = 'Idade inválida';

if(count($errors) > 0){
    echo json_encode(['success' => false, 'error' => implode('; ', $errors)]);
    exit;
}

$data = [
    'name' => $name,
    'age' => $age,
    'gender' => $gender,
    'profession' => $profession,
    'location' => $location,
    'contact' => $contact,
    'bio' => $bio,
    'updated_at' => date('c')
];

// Escrever com lock
$tmp = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
if(file_put_contents($path, $tmp, LOCK_EX) !== false){
    echo json_encode(['success' => true]);
}else{
    echo json_encode(['success' => false, 'error' => 'Não foi possível gravar o ficheiro']);
}

?>
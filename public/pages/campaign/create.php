<?php
session_start();

$method = $_SERVER['REQUEST_METHOD'];

// Redireciona para a página de listagem se o método não for POST
if ($method != 'POST') {
    header('Location: /pages/campaign/index.php');
    exit();
}

define('DB_PATH', __DIR__ . '/../../../database/campaigns.txt');

$campaign = $_POST['campaign'];
$title = trim($campaign['title']);

// VALIDAÇÕES SIMPLES
$errors = [];

if (empty($title)) {
    $errors[] = 'O título da campanha é obrigatório.';
}

if (empty($errors)) {
    // INSERINDO NO "BANCO DE DADOS" (ARQUIVO)
    file_put_contents(DB_PATH, $title. PHP_EOL, FILE_APPEND);

    header('Location: /pages/campaign');

} else{
    // Armazena erros na sessão e redireciona para evitar reenvio de POST
    $_SESSION['errors'] = $errors;
    $_SESSION['title_value'] = $title;
    header('Location: /pages/campaign/new.php');
    exit();
}
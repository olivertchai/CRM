<?php

$method = $_REQUEST['_method'] ?? $_SERVER['REQUEST_METHOD'];

// Redireciona para a página de listagem se o método não for POST
if ($method != 'PUT') {
    header('Location: /pages/campaign/index.php');
    exit();
}

define('DB_PATH', '/var/www/database/campaigns.txt');

$campaign = $_POST['campaign'];
$id = $campaign['id'];
$title = trim($campaign['title']);

// VALIDAÇÕES SIMPLES
$errors = [];

if (empty($title)) {
    $errors[] = 'O título da campanha é obrigatório.';
}

if (empty($errors)) {
    // INSERINDO NO "BANCO DE DADOS" (ARQUIVO)

    $campaigns = file(DB_PATH, FILE_IGNORE_NEW_LINES);
    $campaigns[$id] = $title;

    $data = implode(PHP_EOL, $campaigns);
    file_put_contents(DB_PATH, $data. PHP_EOL);

    header('Location: /pages/campaign');

} else{
    // Recarrega o formulário 

    $title = $campaign['title'];

    $view = '/var/www/app/views/campaign/edit.phtml';

    require '/var/www/app/views/layouts/application.phtml';
}
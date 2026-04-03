<?php

require '/var/www/app/models/Campaign.php';

$method = $_SERVER['REQUEST_METHOD'];

// Redireciona para a página de listagem se o método não for POST
if ($method != 'POST') {
    header('Location: /pages/campaign/index.php');
    exit();
}

$params = $_POST['campaign'];
$campaign = new Campaign(
    id : uniqid(), // Gerar um ID único para a campanha
    title : trim($params['title']),
    description : trim($params['description']),
    startDate : new DateTime($params['start_date']),
    endDate : new DateTime($params['end_date'])
);

if($campaign->save()) {
    header('Location: /pages/campaign/index.php');
} else {
    // Recarrega o formulário com os erros
    $title = 'Criar Nova Campanha';
    $view = '/var/www/app/views/campaign/new.phtml';
    require '/var/www/app/views/layouts/application.phtml';
}






// define('DB_PATH', '/var/www/database/campaigns.txt');

// $campaign = $_POST['campaign'];
// $title = trim($campaign['title']);

// // VALIDAÇÕES SIMPLES
// $errors = [];

// if (empty($title)) {
//     $errors[] = 'O título da campanha é obrigatório.';
// }

// if (empty($errors)) {
//     // INSERINDO NO "BANCO DE DADOS" (ARQUIVO)
//     file_put_contents(DB_PATH, $title. PHP_EOL, FILE_APPEND);

//     header('Location: /pages/campaign');

// } else{
//     // Recarrega o formulário com os erros

//     $title = 'Criar Nova Campanha';
//     $view = '/var/www/app/views/campaign/new.phtml';

//     require '/var/www/app/views/layouts/application.phtml';
// }
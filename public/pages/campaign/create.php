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
    id : null,
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
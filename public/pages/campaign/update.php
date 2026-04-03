<?php

require '/var/www/app/models/Campaign.php';

$method = $_REQUEST['_method'] ?? $_SERVER['REQUEST_METHOD'];

// Redireciona para a página de listagem se o método não for POST
if ($method != 'PUT') {
    header('Location: /pages/campaign/index.php');
    exit();
}

$campaign = $_POST['campaign'];

$id = $campaign['id'];
$title = trim($campaign['title']);

$campaign = Campaign::findById($id);
$campaign->setTitle($title);

if($campaign->save()) {
    header('Location: /pages/campaign/index.php');
} else{
    // Recarrega o formulário 

    $title = $campaign['title'];

    $view = '/var/www/app/views/campaign/edit.phtml';

    require '/var/www/app/views/layouts/application.phtml';
}
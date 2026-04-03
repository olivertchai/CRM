<?php

require '/var/www/app/models/Campaign.php';

$method = $_REQUEST['_method'] ?? $_SERVER['REQUEST_METHOD'];

// Redireciona para a página de listagem se o método não for DELETE
if ($method != 'DELETE') {
    header('Location: /pages/campaign/index.php');
    exit();
}

$params = $_POST['campaign'];
$campaign = Campaign::findById($params['id']);

$campaign->destroy();

header('Location: /pages/campaign');
exit(); // É sempre bom colocar um exit() depois de um header de redirecionamento
<?php

require '/var/www/app/models/Campaign.php';

$id = (int)$_GET['id'];

$campaign = Campaign::findById($id);

if (!$campaign) {
    header('Location: /pages/campaign/index.php');
    exit;
}

$titleEdit = 'Editar Campanha';

$view = '/var/www/app/views/campaign/edit.phtml';

require '/var/www/app/views/layouts/application.phtml';
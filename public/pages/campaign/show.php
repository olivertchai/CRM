<?php

require '/var/www/app/models/Campaign.php';

$id = (int)$_GET['id'];

$campaign = Campaign::findById($id);

if (!$campaign) {
    header('Location: /pages/campaign/index.php');
    exit;
}

//$title = file_get_contents(DB_PATH);

$view = '/var/www/app/views/campaign/show.phtml';

require '/var/www/app/views/layouts/application.phtml';
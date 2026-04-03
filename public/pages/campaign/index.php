<?php

require '/var/www/app/models/Campaign.php';

$campaigns = Campaign::all();

// define('DB_PATH', '/var/www/database/campaigns.txt');

// $campaigns = file(DB_PATH, FILE_IGNORE_NEW_LINES);

$title = 'Campanhas';
$view = '/var/www/app/views/campaign/index.phtml';

require_once '/var/www/app/views/layouts/application.phtml';
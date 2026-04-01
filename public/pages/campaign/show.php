<?php

$id = (int)$_GET['id'];

define('DB_PATH', '/var/www/database/campaigns.txt');

$campaigns = file(DB_PATH, FILE_IGNORE_NEW_LINES);

$campaign['title'] = $campaigns[$id];
$campaign['id'] = $id;

$title = file_get_contents(DB_PATH);

$view = '/var/www/app/views/campaign/show.phtml';

require '/var/www/app/views/layouts/application.phtml';
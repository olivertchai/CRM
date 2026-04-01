<?php

$id = (int)$_GET['id'];

define('DB_PATH', '/var/www/database/campaigns.txt');

$campaigns = file(DB_PATH, FILE_IGNORE_NEW_LINES);

$campaign ['id'] = $id;
$campaign['title'] = $campaigns[$id];

$titleEdit = 'Editar Campanha';
$title = $campaign['title'];

$view = '/var/www/app/views/campaign/edit.phtml';

require '/var/www/app/views/layouts/application.phtml';
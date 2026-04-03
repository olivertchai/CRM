<?php
require '/var/www/core/errors/handler.php';
require '/var/www/app/models/Campaign.php';

$title = 'Criar Nova Campanha';
$view = '/var/www/app/views/campaign/new.phtml';
$campaign = new Campaign(id: null, title: '', description: '', startDate: new DateTime(), endDate: new DateTime());

require '/var/www/app/views/layouts/application.phtml';
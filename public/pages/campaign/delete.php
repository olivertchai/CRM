<?php

require '/var/www/config/bootstrap.php';

use App\Controllers\CampaignsController;

$controller = new CampaignsController();
$controller->delete();

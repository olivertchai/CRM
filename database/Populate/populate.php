<?php

require __DIR__ . '/../../config/bootstrap.php';

use Core\Database\Database;
use Database\Populate\CampaignsPopulate;
use Database\Populate\UsersPopulate;

Database::migrate();

CampaignsPopulate::populate();
UsersPopulate::populate();

<?php

use App\Controllers\CampaignsController;
use Core\Router\Route;

Route::get('/', [CampaignsController::class, 'index'])->name('root');

Route::get('/', [CampaignsController::class, 'index'])->name('campaigns.index');
Route::get('/pages/campaign/new', [CampaignsController::class, 'new'])->name('campaigns.new');
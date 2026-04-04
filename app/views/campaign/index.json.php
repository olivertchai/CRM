<?php

$campaignsToJson = [];

foreach ($campaigns as $campaign) {
    $campaignsToJson[] = ['id' => $campaign->id, 'title' => $campaign->title];
}

header('Content-Type: application/json');
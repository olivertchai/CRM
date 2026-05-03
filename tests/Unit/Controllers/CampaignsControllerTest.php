<?php

namespace Tests\Unit\Controllers;

use App\Models\Campaign;
use App\Controllers\CampaignsController;
use Tests\Unit\Controllers\ControllerTestCase;

class CampaignsControllerTest extends ControllerTestCase
{
    public function test_list_all_campaigns(): void
    {
        $campaigns[] = new Campaign(title: 'Campaign 1');
        $campaigns[] = new Campaign(title: 'Campaign 2');

        foreach ($campaigns as $campaign) {
            $campaign->save();
        }

        $response = $this->get(action: 'index', controller: 'App\Controllers\CampaignsController');

        foreach ($campaigns as $campaign) {
            $this->assertMatchesRegularExpression("/{$campaign->getTitle()}/", $response);
        }
    }
}

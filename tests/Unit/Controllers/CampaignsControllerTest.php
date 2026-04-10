<?php

namespace Tests\Unit\Controllers;

use App\Models\Campaign;
use App\Controllers\CampaignsController;
use Tests\Unit\Controllers\ControllerTestCase;

class CampaignsControllerTest extends ControllerTestCase
{
    public function test_list_all_campaigns(): void
    {
        $campaigns[] = new Campaign(1, 'Campaign 1');
        $campaigns[] = new Campaign(2, 'Campaign 2');

        foreach ($campaigns as $campaign) {
            $campaign->save();
        }

        // Criamos a lista de coisas que queremos encontrar no HTML
        $patterns = [
            '/Campaign 1/',
            '/Campaign 2/'
        ];

        // Chamamos o método da base. Ele já vai validar tudo sozinho!
        $this->get('index', CampaignsController::class, $patterns);
    }
}

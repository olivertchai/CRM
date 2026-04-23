<?php

namespace Tests\Unit\Models;

use App\Models\Campaign;
use Lib\Paginator;
use Tests\TestCase;

class CampaignTest extends TestCase
{
    public function test_can_set_title(): void
    {
        $campaign = new Campaign(title: 'Initial Title');
        $this->assertEquals('Initial Title', $campaign->getTitle());
    }

    public function test_should_create_new_campaign(): void
    {
        $campaign = new Campaign(title: 'New Campaign', description: 'Description of the campaign');
        $this->assertTrue($campaign->save());
        $this->assertCount(1, Campaign::all());
    }

    public function test_paginate_should_return_a_paginator(): void
    {
        $this->assertInstanceOf(Paginator::class, Campaign::paginate());
    }
}

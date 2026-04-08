<?php

namespace Tests\Unit\Models;

use PHPUnit\Framework\TestCase;
use App\Models\Campaign;

class CampaignTest extends TestCase
{
    public function test_can_set_title()
    {
        $campaign = new Campaign(1, title: 'Initial Title');
        $this->assertEquals('Initial Title', $campaign->getTitle());
    }

    public function test_should_create_new_campaign()
    {
        $campaign = new Campaign(1, title: 'New Campaign', description: 'Description of the campaign');
        $this->assertTrue($campaign->save());
        $this->assertCount(1, Campaign::all());
    }
}
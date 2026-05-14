<?php

namespace Tests\Unit\Models;

use App\Models\Campaign;
use App\Models\User;
use Lib\Paginator;
use Tests\TestCase;

class CampaignTest extends TestCase
{
    public function test_can_set_title(): void
    {
        $campaign = new Campaign(['title' => 'Initial Title']);
        $this->assertEquals('Initial Title', $campaign->title);
    }

    public function test_should_create_new_campaign(): void
    {
        $user = new User([
            'name' => 'User 1',
            'email' => 'fulano@example.com',
            'password' => '123456',
            'password_confirmation' => '123456',
            'role' => 'manager_marketing',
            'active' => true
        ]);  
        $user->save();

        $campaign = new Campaign(['title' => 'New Campaign',
                                 'description' => 'Description of the campaign',
                                 'start_date' => '2022-01-01',
                                 'end_date' => '2022-01-01',
                                 'user_id' => $user->id]);
                                 
        $this->assertTrue($campaign->save());
        $this->assertCount(1, Campaign::all());
    }

    public function test_paginate_should_return_a_paginator(): void
    {
        $this->assertInstanceOf(Paginator::class, Campaign::paginate());
    }
}

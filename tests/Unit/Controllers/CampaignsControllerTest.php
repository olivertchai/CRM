<?php

namespace Tests\Unit\Controllers;

use App\Models\Campaign;
use App\Models\User;
use Tests\Unit\Controllers\ControllerTestCase;

class CampaignsControllerTest extends ControllerTestCase
{
    public function test_list_all_campaigns(): void
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
        $this->signIn($user);

        $campaigns[] = new Campaign(['title' => 'Campaign 1',
                                     'user_id' => $user->id]);
        $campaigns[] = new Campaign(['title' => 'Campaign 2',
                                     'user_id' => $user->id]);

        foreach ($campaigns as $campaign) {
            $campaign->save();
        }

        $response = $this->get(action: 'index', controllerName: 'App\Controllers\CampaignsController');

        foreach ($campaigns as $campaign) {
            $this->assertMatchesRegularExpression("/{$campaign->title}/", $response);
        }
    }
}

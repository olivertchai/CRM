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

    public function test_should_not_create_campaign_with_invalid_data(): void
    {
        // 1. Instanciamos uma campanha vazia (sem título, datas, etc.)
        $campaign = new Campaign([]);

        // 2. Tentamos salvar (deve retornar false porque as validações vão barrar)
        $this->assertFalse($campaign->save());

        // 3. Pegamos os erros gerados pela sua Model
        $errors = $campaign->getErrorsIndex();

        // 4. Garantimos que o sistema acusou erro nos campos obrigatórios
        $this->assertArrayHasKey('title', $errors);
        $this->assertArrayHasKey('start_date', $errors);
        $this->assertArrayHasKey('end_date', $errors);
    }
}

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

    public function test_should_not_save_campaign_with_image_too_large(): void
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

        $campaign = new Campaign([
            'title'       => 'Campanha com imagem grande',
            'description' => 'Descrição',
            'start_date'  => '2024-01-01',
            'end_date'    => '2024-01-31',
            'user_id'     => $user->id
        ]);

        // Simula um arquivo de 3MB (maior que o limite de 2MB)
        $campaign->campaign_image = [
            'name'     => 'foto.jpg',
            'tmp_name' => '/tmp/fakefile',
            'size'     => 3145728,
            'error'    => UPLOAD_ERR_OK
        ];

        $this->assertFalse($campaign->save());
        $this->assertArrayHasKey('campaign_image', $campaign->getErrorsIndex());
    }

    public function test_should_save_campaign_without_image(): void
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

        $campaign = new Campaign([
            'title'       => 'Campanha sem imagem',
            'description' => 'Descrição',
            'start_date'  => '2024-01-01',
            'end_date'    => '2024-01-31',
            'user_id'     => $user->id
        ]);

        // Nenhum arquivo enviado: campaign_image null não deve gerar erro
        $campaign->campaign_image = null;

        $this->assertTrue($campaign->save());
    }

    public function test_should_not_save_campaign_with_invalid_file_type(): void
    {
        $user = new User([
            'name'                  => 'User 1',
            'email'                 => 'fulano@example.com',
            'password'              => '123456',
            'password_confirmation' => '123456',
            'role'                  => 'manager_marketing',
            'active'                => true
        ]);
        $user->save();

        $campaign = new Campaign([
            'title'       => 'Campanha com arquivo inválido',
            'description' => 'Descrição',
            'start_date'  => '2024-01-01',
            'end_date'    => '2024-01-31',
            'user_id'     => $user->id
        ]);

        // Cria um arquivo .txt temporário real para o finfo conseguir ler
        $tmpFile = tempnam(sys_get_temp_dir(), 'test_');
        file_put_contents($tmpFile, 'isso não é uma imagem');

        $campaign->campaign_image = [
            'name'     => 'documento.txt',
            'tmp_name' => $tmpFile,
            'size'     => filesize($tmpFile),
            'error'    => UPLOAD_ERR_OK
        ];

        $this->assertFalse($campaign->save());
        $this->assertArrayHasKey('campaign_image', $campaign->getErrorsIndex());

        unlink($tmpFile);
    }
}

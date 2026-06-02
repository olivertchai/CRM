<?php

namespace Tests\Unit\Controllers;

use App\Models\Campaign;
use App\Models\User;
use Tests\Unit\Controllers\ControllerTestCase;
use App\Controllers\CampaignsController;

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

    public function test_authenticated_routes_should_not_be_accessible_by_unauthenticated_users(): void
    {
        // Garante que a sessão do usuário está vazia (ninguém logado)
        unset($_SESSION['user']);

        // O controller que vamos testar
        $controller = CampaignsController::class;

        // Lista das ações protegidas: [Método HTTP, Ação do Controller, Parâmetros (opcional)]
        $protectedActions = [
            ['get', 'index'],
            ['get', 'new'],
            ['post', 'create'],
            ['get', 'edit', ['id' => 1]],
            ['put', 'update', ['id' => 1, 'campaign' => ['title' => 'Teste']]],
            ['post', 'destroy', ['id' => 1]], // Ou 'delete', dependendo de como você implementou o destroy
        ];

        foreach ($protectedActions as $route) {
            $httpMethod = $route[0]; // get, post, put
            $action = $route[1];     // index, new, create...
            $params = $route[2] ?? [];

            // Chama o método helper que está lá no seu ControllerTestCase
            $output = $this->$httpMethod($action, $controller, $params);

            // Verifica se o controller cuspiu o redirecionamento (provavelmente para /login ou /)
            // Se o seu sistema redireciona para a home ('/'), mude '/login' para '/'
            $this->assertStringContainsString(
                'Location: /login',
                $output,
                "A action '{$action}' falhou em bloquear o acesso de visitante."
            );
        }
    }

    public function test_create_campaign_with_valid_image_redirects_to_index(): void
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
        $this->signIn($user);

        // Simula um arquivo dentro do limite (1MB)
        $_FILES['campaign_image'] = [
            'name'     => 'foto.jpg',
            'tmp_name' => '',       // vazio = update() não move nenhum arquivo
            'size'     => 1048576,
            'error'    => UPLOAD_ERR_NO_FILE
        ];

        $response = $this->post(
            action: 'create',
            controllerName: CampaignsController::class,
            params: [
                'campaign' => [
                    'title'       => 'Campanha com imagem',
                    'description' => 'Descrição',
                    'start_date'  => '2024-01-01',
                    'end_date'    => '2024-01-31',
                ]
            ]
        );

        $this->assertStringContainsString('Location: ' . route('campaigns.index'), $response);
    }

    public function test_create_campaign_with_image_too_large_renders_new(): void
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
        $this->signIn($user);

        // 3MB — ultrapassa o limite
        $_FILES['campaign_image'] = [
            'name'     => 'pesada.jpg',
            'tmp_name' => '/tmp/fakefile',
            'size'     => 3145728,
            'error'    => UPLOAD_ERR_OK
        ];

        $response = $this->post(
            action: 'create',
            controllerName: CampaignsController::class,
            params: [
                'campaign' => [
                    'title'       => 'Campanha inválida',
                    'description' => 'Descrição',
                    'start_date'  => '2024-01-01',
                    'end_date'    => '2024-01-31',
                ]
            ]
        );

        // Deve renderizar o form de novo, não redirecionar
        $this->assertStringNotContainsString('Location:', $response);
    }
}

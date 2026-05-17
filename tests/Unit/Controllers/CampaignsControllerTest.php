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
}

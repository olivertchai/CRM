<?php

namespace App\Controllers;

use App\Models\User;
use Lib\Authentication\Auth;

class UsersController
{
    private string $layout = 'application';
    private ?User $currentUser = null;

    // 1. Trazemos a função currentUser para cá também
    public function currentUser(): ?User
    {
        if ($this->currentUser === null) {
            $this->currentUser = Auth::user();
        }

        return $this->currentUser;
    }

    public function index(): void
    {
        // 2. Trava de Segurança: Se não for admin, manda de volta pras campanhas
        if (!$this->currentUser() || !$this->currentUser()->isAdmin()) {
            $this->redirectTo('/campaigns');
        }

        // 3. Se passou da trava, busca os usuários e define o título da página
        $users = User::all();
        $title = 'Gerenciar Usuários';

        // 4. Renderiza a view passando os dados
        $this->render('index', compact('users', 'title'));
    }

    /**
     * @param string $view
     * @param array<string, mixed> $data
     * @return void
     */
    private function render(string $view, array $data = []): void
    {
        extract($data);

        // ATENÇÃO: Aqui ajustamos o caminho de 'campaign' para 'user'
        $view = '/var/www/app/views/user/' . $view . '.phtml';
        require '/var/www/app/views/layouts/' . $this->layout . '.phtml';
    }

    private function redirectTo(string $location): void
    {
        header('Location: ' . $location);
        exit;
    }
}

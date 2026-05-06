<?php

namespace App\Controllers;

use App\Models\User;
use Lib\Authentication\Auth;
use Lib\FlashMessage;

class UsersController
{
    private string $layout = 'application';
    private ?User $currentUser = null;

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
            FlashMessage::danger('Você não pode acessar esta página!');
            $this->redirectTo('/campaigns');
        }

        $users = User::all();
        $userModel = new User();
        $totalUsers = $userModel->getTotalUsers();
        $title = 'Gerenciar Usuários';

        $this->render('index', compact('users', 'title', 'totalUsers'));
    }

    /**
     * @param string $view
     * @param array<string, mixed> $data
     * @return void
     */
    private function render(string $view, array $data = []): void
    {
        extract($data);

        $view = '/var/www/app/views/user/' . $view . '.phtml';
        require '/var/www/app/views/layouts/' . $this->layout . '.phtml';
    }

    private function redirectTo(string $location): void
    {
        header('Location: ' . $location);
        exit;
    }
}

<?php

namespace Lib\Authentication;

use App\Models\User;

class Auth
{
    public static function login($user): void
    {
        $_SESSION['user']['id'] = $user->getId();
    }

    public static function logout(): void
    {
        unset($_SESSION['user']['id']);
    }

    // Este método é uma versão estática para recuperar o usuário logado diretamente da sessão.
    public static function user(): ?User
    {
        if (isset($_SESSION['user']['id'])) {
            $id = $_SESSION['user']['id'];
            return User::findById($id);
        }

        return null;
    }

    // Este método serve para verificar rapidamente se existe um usuário autenticado no sistema.
    public static function check(): bool
    {
        return isset($_SESSION['user']['id']) && self::user() !== null;
    }


}

<?php

namespace Database\Populate;

use App\Models\User;

class UsersPopulate
{
    public static function populate()
    {
        $user = new User(
            name: 'Fulano',
            email: 'fulano@example.com',
            password: '123456',
            password_confirmation: '123456',
            role: 'manager_marketing'
        );

        $user->save();

        // 1. Cria o usuário Administrador
        $admin = new User(
            name: 'Administrador',
            email: 'admin@teste.com',
            password: '123456',
            password_confirmation: '123456',
            role: 'admin'
        );
        $admin->save();

        // 2. Cria o usuário Manager Marketing
        $manager = new User(
            name: 'Gerente de Marketing',
            email: 'marketing@teste.com',
            password: '123456',
            password_confirmation: '123456',
            role: 'manager_marketing'
        );
        $manager->save();

        $numberOfUsers = 10;

        for ($i = 1; $i < $numberOfUsers; $i++) {
            $user = new User(
                name: 'Fulano ' . $i,
                email: 'fulano ' . $i . '@example.com',
                password: '123456',
                password_confirmation: '123456'
            );

            $user->save();
        }

        echo "Users populated with $numberOfUsers registers\n";
    }
}
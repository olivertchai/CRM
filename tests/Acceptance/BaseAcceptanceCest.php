<?php

namespace Tests\Acceptance;

use Core\Database\Database;
use Core\Env\EnvLoader;
use Tests\Support\AcceptanceTester;

// phpcs:disable PSR2.Methods.MethodDeclaration.Underscore

class BaseAcceptanceCest
{
    public function _before(AcceptanceTester $page): void
    {
        EnvLoader::init();
        Database::create();
        Database::migrate();
    }

    public function _after(AcceptanceTester $page): void
    {
        Database::drop();
    }
}

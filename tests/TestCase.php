<?php

namespace Tests;

use Core\Constants\Constants;
use PHPUnit\Framework\TestCase as FrameworkTestCase;

class TestCase extends FrameworkTestCase
{
    public function setUp(): void
    {
        $this->clearDatabase(); // Limpa o banco de dados ou arquivos antes de cada teste, se necessário
    }

    public function tearDown(): void
    {
        // Limpa o banco de dados ou arquivos após cada teste, se necessário
        $this->clearDatabase();
    }

    private function clearDatabase()
    {
        $file = Constants::databasePath()->join($_ENV['DB_NAME']);
        if (file_exists($file)) {
            unlink($file); // Remove o arquivo de banco de dados
        }
    }
}

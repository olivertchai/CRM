<?php

namespace Tests;

use PHPUnit\Framework\TestCase as FrameworkTestCase;

require dirname(__DIR__) . '/core/constants/general.php';
require ROOT_PATH . '/core/debug/functions.php';

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
        $file = DATABASE_PATH . $_ENV['DB_NAME'];
        if (file_exists($file)) {
            unlink($file); // Remove o arquivo de banco de dados
        }
    }
}

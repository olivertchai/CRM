<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;

abstract class ControllerTestCase extends TestCase
{
    // Mudamos para 'void' pois o PHPUnit vai validar a saída internamente
    public function get(string $action, string $controllerClass, array $regexPatterns = []): void
    {
        $controller = new $controllerClass();

        // Se passarmos padrões, avisamos o PHPUnit para esperar por eles na tela
        foreach ($regexPatterns as $pattern) {
            $this->expectOutputRegex($pattern);
        }

        // Executa a ação (index, show, etc)
        $controller->$action();
    }
}
<?php
session_start();

$title = 'Criar Nova Campanha';

// Recupera erros da sessão, se houver
$errors = $_SESSION['errors'] ?? [];
$title_value = $_SESSION['title_value'] ?? '';

// Limpa a sessão após recuperar
unset($_SESSION['errors'], $_SESSION['title_value']);

$view = __DIR__ . '/../../../app/views/campaign/new.phtml';

require __DIR__ . '/../../../app/views/layouts/application.phtml';
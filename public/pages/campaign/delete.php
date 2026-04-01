<?php

$method = $_REQUEST['_method'] ?? $_SERVER['REQUEST_METHOD'];

// Redireciona para a página de listagem se o método não for DELETE
if ($method != 'DELETE') {
    header('Location: /pages/campaign/index.php');
    exit();
}

define('DB_PATH', '/var/www/database/campaigns.txt');

$campaign = $_POST['campaign'];
$id = $campaign['id'];

// Verifica se o ID foi enviado e se o arquivo TXT realmente existe
if ($id !== null && file_exists(DB_PATH)) {
    
    // 1. LÊ O ARQUIVO: Aqui a variável $campaigns é oficialmente criada
    $campaigns = file(DB_PATH, FILE_IGNORE_NEW_LINES);
    
    // 2. SEGURANÇA: Garante que a leitura funcionou e que o ID existe no arquivo
    if (is_array($campaigns) && isset($campaigns[$id])) {
        
        // Remove a linha exata da campanha
        unset($campaigns[$id]);
        
        // Remonta o texto. Se o array estiver vazio, o implode retorna string vazia
        $data = implode(PHP_EOL, $campaigns);
        
        // Se ainda sobrou alguma campanha, garante a quebra de linha no final
        if (!empty($data)) {
            $data .= PHP_EOL;
        }
        
        // Salva as alterações de volta no arquivo TXT
        file_put_contents(DB_PATH, $data);
    }
}

header('Location: /pages/campaign');
exit(); // É sempre bom colocar um exit() depois de um header de redirecionamento
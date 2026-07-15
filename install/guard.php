<?php

// Depois que a licenca e a API existem, o instalador nao deve mais ficar
// acessivel. Em um servidor novo, sem o volume runtime restaurado, ele volta
// a ficar disponivel para a configuracao inicial.
$installation_complete = file_exists(__DIR__ . '/../includes/.lic')
    && file_exists(__DIR__ . '/../api.php');

if ($installation_complete) {
    header('Location: ../index.php');
    exit;
}


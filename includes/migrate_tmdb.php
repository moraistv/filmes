<?php
/**
 * Migracao idempotente executada a cada deploy (via entrypoint.sh).
 * Adiciona a coluna tbl_settings.tmdb_api_key caso ainda nao exista, para
 * permitir a importacao de filmes/series pelo TMDB (titulo/sinopse em
 * portugues + imagem de capa), com fallback para OMDb quando vazia.
 */

require_once __DIR__ . '/connection.php';

$col = mysqli_query($mysqli, "SHOW COLUMNS FROM tbl_settings LIKE 'tmdb_api_key'");

if ($col && mysqli_num_rows($col) == 0) {
    if (mysqli_query($mysqli, "ALTER TABLE tbl_settings ADD COLUMN tmdb_api_key VARCHAR(191) NOT NULL DEFAULT '' AFTER omdb_api_key")) {
        echo "Coluna tmdb_api_key criada.\n";
    } else {
        echo "Falha ao criar tmdb_api_key: " . mysqli_error($mysqli) . "\n";
    }
} else {
    echo "Coluna tmdb_api_key ja existe.\n";
}

// Garante que exista o idioma "Português" (o seed original so trazia
// English/Hindi). Nao remove nada — a limpeza dos demais idiomas fica a
// cargo do admin pela tela Idiomas, para nao afetar conteudo existente.
$hasPt = mysqli_query($mysqli, "SELECT id FROM tbl_language WHERE language_name LIKE '%Portugu%'");
if ($hasPt && mysqli_num_rows($hasPt) == 0) {
    if (mysqli_query($mysqli, "INSERT INTO tbl_language (language_name, language_background, status) VALUES ('Português', '11762E', 1)")) {
        echo "Idioma Portugues adicionado.\n";
    }
}

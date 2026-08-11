<?php
/**
 * Migracao idempotente (via entrypoint.sh): adiciona campos de metadados
 * (diretor, elenco, pais, data de lancamento) em tbl_movies e tbl_series,
 * usados na tela de detalhes do app e preenchidos automaticamente pelo TMDB.
 */

require_once __DIR__ . '/connection.php';

function add_col_if_missing($mysqli, $table, $column, $definition)
{
    $res = mysqli_query($mysqli, "SHOW COLUMNS FROM `$table` LIKE '$column'");
    if ($res && mysqli_num_rows($res) == 0) {
        if (mysqli_query($mysqli, "ALTER TABLE `$table` ADD COLUMN `$column` $definition")) {
            echo "Coluna $table.$column criada.\n";
        } else {
            echo "Falha ao criar $table.$column: " . mysqli_error($mysqli) . "\n";
        }
    }
}

foreach (array('tbl_movies', 'tbl_series') as $table) {
    add_col_if_missing($mysqli, $table, 'director', "VARCHAR(255) NOT NULL DEFAULT ''");
    add_col_if_missing($mysqli, $table, 'casts', "VARCHAR(600) NOT NULL DEFAULT ''");
    add_col_if_missing($mysqli, $table, 'country', "VARCHAR(191) NOT NULL DEFAULT ''");
    add_col_if_missing($mysqli, $table, 'release_date', "VARCHAR(40) NOT NULL DEFAULT ''");
}

// Series ainda nao tinha genero associado (so filmes tinham). Necessario
// para exibir series por categoria/genero em carrossel no app, igual filmes.
add_col_if_missing($mysqli, 'tbl_series', 'genre_id', "VARCHAR(191) NOT NULL DEFAULT ''");

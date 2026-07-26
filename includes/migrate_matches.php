<?php
/**
 * Migracao idempotente executada a cada deploy (via entrypoint.sh).
 * Cria a tabela tbl_matches usada pela secao "Jogos/Partidas" (agenda de
 * jogos exibida no app, com times, horario e link de transmissao).
 */

require_once __DIR__ . '/connection.php';

$sql = "CREATE TABLE IF NOT EXISTS `tbl_matches` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `league` VARCHAR(191) NOT NULL DEFAULT '',
  `team1_name` VARCHAR(191) NOT NULL DEFAULT '',
  `team1_logo` VARCHAR(500) NOT NULL DEFAULT '',
  `team2_name` VARCHAR(191) NOT NULL DEFAULT '',
  `team2_logo` VARCHAR(500) NOT NULL DEFAULT '',
  `match_time` DATETIME NOT NULL,
  `stream_url` VARCHAR(500) NOT NULL DEFAULT '',
  `stream_type` VARCHAR(30) NOT NULL DEFAULT 'url',
  `status` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

if (mysqli_query($mysqli, $sql)) {
    echo "Tabela tbl_matches ok.\n";
} else {
    echo "Falha ao criar tbl_matches: " . mysqli_error($mysqli) . "\n";
}

<?php
/**
 * Migracao idempotente executada a cada deploy (via entrypoint.sh).
 *
 * Objetivo: em instalacoes que ja existiam ANTES do rebrand para GetCine,
 * o banco de producao mantem os valores antigos (app_name/app_logo) porque
 * o seed de install/database.sql so vale para instalacoes novas.
 *
 * Este script atualiza tbl_settings.app_name/app_logo SOMENTE quando o valor
 * atual ainda for exatamente o default antigo do template ('Live TV' /
 * 'ic_launcher_round.png'). Se o admin ja customizou esses campos pela tela
 * de Configuracoes para outro valor, o script nao sobrescreve nada.
 */

require_once __DIR__ . '/connection.php';

$oldNames = array('Live TV', 'Live Tv App', 'AndroidLiveTVSeries', '');
$oldLogos = array('ic_launcher_round.png', '');

$row = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT app_name, app_logo FROM tbl_settings WHERE id = 1 LIMIT 1"));

if ($row) {
    $updates = array();

    if (in_array($row['app_name'], $oldNames, true)) {
        $updates['app_name'] = 'GetCine';
    }

    if (in_array($row['app_logo'], $oldLogos, true) && file_exists(__DIR__ . '/../images/logo-getcine.svg')) {
        $updates['app_logo'] = 'logo-getcine.svg';
    }

    if (!empty($updates)) {
        $sets = array();
        foreach ($updates as $col => $val) {
            $sets[] = "`$col` = '" . mysqli_real_escape_string($mysqli, $val) . "'";
        }
        mysqli_query($mysqli, "UPDATE tbl_settings SET " . implode(', ', $sets) . " WHERE id = 1");
        echo "Marca atualizada: " . implode(', ', array_keys($updates)) . "\n";
    } else {
        echo "Nenhuma atualizacao de marca necessaria.\n";
    }
} else {
    echo "tbl_settings nao encontrada, pulando migracao de marca.\n";
}

<?php
include __DIR__.'/connection.php';

$sql = "CREATE TABLE IF NOT EXISTS tbl_app_updates (
  id INT NOT NULL AUTO_INCREMENT,
  version_code INT NOT NULL,
  version_name VARCHAR(50) NOT NULL,
  title VARCHAR(160) NOT NULL,
  release_notes TEXT NOT NULL,
  is_required TINYINT(1) NOT NULL DEFAULT 0,
  source_type VARCHAR(20) NOT NULL DEFAULT 'apk',
  update_url TEXT NOT NULL,
  apk_file VARCHAR(255) NOT NULL DEFAULT '',
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uq_app_update_version_code (version_code),
  KEY idx_app_update_active_version (is_active, version_code)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

if (!mysqli_query($mysqli, $sql)) {
  fwrite(STDERR, "Falha ao criar tbl_app_updates: ".mysqli_error($mysqli).PHP_EOL);
  exit(1);
}

echo "Tabela tbl_app_updates pronta.\n";
?>

#!/bin/sh
set -eu

cd /var/www/html
mkdir -p runtime images uploads runtime/sessions

# O diretorio images/ vive num volume persistente (sobrevive aos deploys),
# entao arquivos NOVOS adicionados na imagem (ex.: logo-getcine.svg) nunca
# chegavam ao volume ja existente. Aqui copiamos da copia "de fabrica"
# (images.dist, gerada no build) para o volume, sem sobrescrever arquivos
# que ja existem la (uploads de filmes/series feitos pelo admin).
if [ -d images.dist ]; then
  cp -rn images.dist/. images/ 2>/dev/null || true
fi

if [ ! -f runtime/connection.php ]; then
  cp includes/connection.php runtime/connection.php
fi

rm -f includes/connection.php
ln -s ../runtime/connection.php includes/connection.php

# A verificacao da compra grava a licenca em includes/.lic. Mantemos o
# arquivo no volume runtime para que ele sobreviva aos proximos deploys.
if [ -f includes/.lic ] && [ ! -f runtime/.lic ]; then
  cp includes/.lic runtime/.lic
fi
rm -f includes/.lic
ln -s ../runtime/.lic includes/.lic

# A API do app (api.php) e gerada a partir do template versionado app.default.
# Como e apenas codigo (nao dado do usuario), regeramos a cada deploy para
# refletir atualizacoes e garantir que os includes relativos funcionem.
rm -f api.php
cp includes/app.default api.php

chown -R www-data:www-data runtime images uploads
chown www-data:www-data api.php

# Migracao idempotente: atualiza nome/logo do app no banco caso ainda
# estejam com os valores default antigos do template (nao sobrescreve
# customizacoes feitas pelo admin). Nao interrompe o deploy se falhar.
php includes/force_brand_update.php || true

exec docker-php-entrypoint "$@"

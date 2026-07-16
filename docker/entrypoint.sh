#!/bin/sh
set -eu

cd /var/www/html
mkdir -p runtime images uploads

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

exec docker-php-entrypoint "$@"

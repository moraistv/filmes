# Painel de filmes

Painel PHP e API do aplicativo Android de filmes, series e canais.

## Deploy no Dokploy

O projeto usa `docker-compose.yml` com dois servicos:

- `painel`: PHP 8.2 com Apache, publicado por padrao na porta `8088`.
- `banco`: MariaDB 10.11 com volume persistente.

Cadastre no Dokploy as variaveis descritas em `.env.example`, usando senhas fortes e diferentes.

No primeiro deploy, acesse `http://IP_DO_SERVIDOR:8088/install/` e informe:

- host do banco: `banco`
- nome do banco: valor de `DB_NAME`
- usuario: valor de `DB_USER`
- senha: valor de `DB_PASSWORD`

Os arquivos gerados pelo instalador, a licenca, as imagens, os uploads e o banco ficam em volumes persistentes para sobreviver aos proximos deploys.

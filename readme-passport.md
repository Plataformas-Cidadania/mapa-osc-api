Para instalar o passport no servidor.

1) Excluir composer.lock
2) composer install
3) php artisan migrate
4) php artisan passport:keys
5) acessar rota /key para gerar o app_key
6) colar a key gerada no .env em APP_KEY
7) rodar o script sql client-passport.sql localizado na raiz do projeto.

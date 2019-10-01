# Procuradoria

## Características da aplicação

- [Git](https://git-scm.com/docs/user-manual.html)
- [PHP 7.2 ou superior](http://php.net/)
- [Composer](https://getcomposer.org/)
- [Redis](https://redis.io/topics/quickstart)
- [PostgreSQL](https://www.postgresql.org/)

## Controle de processos

Limite para upload de arquivos deve ser aumentado para 64M tanto no PHP quanto no servidor web.

<p align="center">
    <a href="https://scrutinizer-version.com/g/alerj/procuradoria/?branch=master"><img alt="Code Quality" src="https://img.shields.io/scrutinizer/g/alerj/procuradoria.svg?style=flat-square"></a>
    <a href="https://scrutinizer-version.com/g/alerj/procuradoria/?branch=master"><img alt="Build" src="https://img.shields.io/scrutinizer/build/g/alerj/procuradoria.svg?style=flat-square"></a>
    <a href="https://scrutinizer-version.com/g/alerj/procuradoria/?branch=master"><img alt="Coverage" src="https://img.shields.io/scrutinizer/coverage/g/alerj/procuradoria.svg?style=flat-square"></a>
    <a href="https://styleci.io/repos/116709546"><img alt="StyleCI" src="https://styleci.io/repos/116709546/shield"></a>
</p>

### Atualizando a aplicação

- Entrar na `<pasta-aonde-o-site-foi-instalado>`
- Baixar as atualizações de código fonte usando Git (git pull ou git fetch + git merge, isso depende de como operador prefere trabalhar com Git)
- Executar, no mínimo, os comandos:
```
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev
php artisan migrate --force
php artisan route:cache
php artisan cache:clear
php artisan view:clear
```

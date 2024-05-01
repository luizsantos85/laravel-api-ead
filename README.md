<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## PROJETO API EAD com Laravel

Projeto em desenvolvimento.

## Configurações / Requisitos

-   **[nginx:alpine]**
-   **[mysql:8.0](https://www.mysql.com/)**
-   **[redis]**
-   **[Laravel:9](https://laravel.com/)**
-   **[PHP:8.1\*](https://www.php.net/manual/pt_BR/index.php)**
-   **[docker]**

## Instalar App

```bash
$ git clone https://github.com/luizsantos85/laravel-api-ead.git

**observar as configurações de portas e usuario no arquivo docker-composer.yml

**Copiar o .env.example e gerar o .env, fazer as modificações das portas (se necessário) e usuario do DB

**Inicializar os containers
$ docker compose up -d

**será criada uma pasta .docker/mysql para os arquivos de banco de dados

**Acessar o container do laravel
$ docker compose exec app bash

**Instalar os packges do laravel
$ composer install

**Gerar a key do laravel
$ php artisan key:generate

**acessar localhost:(porta selecionada) para acessar o sistema

```

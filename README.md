# API CRUDL - PASTELARIA
### Documentação da API no Postman <a name="postman-documentation"></a>

Acesso: [Documentação no Postman - Pastelaria](https://documenter.getpostman.com/view/20890833/2s93sjVUjZ)
- Raiz da API **http://localhost/api/v1/**

## Ferramentas Utilizadas <a name="tech-specification"></a>

- ▶ PHP 8.1
- ▶ Laravel 10
- ▶ MySQL 8
- ▶ Docker
- ▶ PHPUnit 10 

## Instalação <a name="installation"></a>

- `cp .env.example .env`
- `composer install`
- `docker-compose up -d`
- `php artisan key:generate`
- `php artisan migrate`
- `php artisan db:seed`


## Testes Unitários <a name="unit-test"></a>

#### PHPUnit Localmente <a name="run-phpunit-in-local"></a>

```bash
# Todos os Testes:
vendor/bin/phpunit
# Testes de Feature
vendor/bin/phpunit --testsuite Feature
# Testes de Unidade
vendor/bin/phpunit --testsuite Unit
```


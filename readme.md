# Muambex Versão 1.0.0

Projeto simples em laravel para rastreio de pacotes dos correios, busca de cep e mais...

## Screenshot

![muambex](https://user-images.githubusercontent.com/7799406/38389120-cf72840a-38f3-11e8-8ff5-a8c97007273a.JPG)

## Instruções

```
1 - git clone https://github.com/felipe-alves-reis/muambex.git

2 - cd muambex

3 - composer install

4 - Criar e edit arquivo .env com as informações do seu banco de dados

5 - php artisan key:generate

6 - php artisan migrate

Enjoy

```

### Pré-requisitos

```
* Laravel 5.5
* MySQL
* Composer
* Git
* Soap Client - sudo apt-get install php-soap
* PHP >= 7.0
```

## Construído com:

* [Laravel](https://laravel.com/docs/5.5) - Web framework
* [Composer](https://getcomposer.org/) - Gerenciamento de Dependência
* [MySQL](https://www.mysql.com/) - Banco de Dados
* [Jquery](https://jquery.com/) - Manipulação de Front
* [jeroennoten/Laravel-AdminLTE](https://github.com/jeroennoten/Laravel-AdminLTE) - Template
* [jqueryvalidation](https://jqueryvalidation.org/) - Validação do form
* [cagartner/correios-consulta](https://github.com/cagartner/correios-consulta) - Buscar informações de serviços dos correios
* [Soap Client](http://php.net/manual/pt_BR/class.soapclient.php) - Necessário para utilizar a correios-consulta
* [Laravel Collective](https://laravelcollective.com/docs/5.2/html) - Pacote Laravel Form para aumento da produtividade
* [SweetAlert](https://github.com/uxweb/sweet-alert) - Torna as mensagens popup mais bonitas

## Autor

* **Felipe Alves Reis** - [felipe-alves-reis](https://github.com/felipe-alves-reis)

## Licença

Este projeto está licenciado a Copyright 2018 Felipe Alves Reis

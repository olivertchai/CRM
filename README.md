## CRM

Este projeto tem como objetivo implementar um controle de clientes que será separados em campanhas personalizadas para envio de mensagens.

### Dependências

-   Docker
-   Docker Compose

### To run


#### Clone Repository
```
$ git clone https://github.com/olivertchai/CRM
$ cd crm
```
#### Define the env variables
```
$ cp .env.example .env
```

#### Install the dependencies
```
$ ./run composer install
OU
$ docker compose run --rm composer install
```

#### Up the containers
```
$ ./run up -d
OU
$ docker compose up -d
```

#### Run the tests
```
$ ./run test
OU
$ docker compose run --rm php ./vendor/bin/phpunit tests/Unit/Models/CampaignTest.php --color
```

#### Run the linters
```
$ ./run phpcs

$ ./run phpstan
Ou
$ vendor/bin/phpstan analyse

$ ./run composer dump-autoload

$ docker compose run --rm php ./vendor/bin/phpstan
```

Access [localhost](http://localhost)

<img width="1749" height="942" alt="image" src="https://github.com/user-attachments/assets/bfb74068-62c9-4a02-92c4-bfbbac8f1c48" />

<img width="1749" height="942" alt="image" src="https://github.com/user-attachments/assets/b8ab0418-c312-41fb-b51f-16f93eede2d7" />


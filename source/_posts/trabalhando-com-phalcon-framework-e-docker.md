---
createdAt: 2020-03-06
title: Trabalhando com Phalcon Framework e Docker
author: Rogério Silva
authorEmail: ress.rogerio@gmail.com
---

[Read in english](https://medium.com/@rogsilva/working-with-phalcon-framework-and-docker-fef3fe5b85c8)

Olá pessoal, este é um simples tutorial de como rodar aplicações Phalcon usando Docker em ambiente de desenvolvimento.

Verifique se você possui os requisitos abaixo instalados no seu computador.

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)

## Passo 1: Criando a pasta do projeto

Abra o seu terminal e crie sua pasta para o projeto.

```
mkdir phalcon_sample && cd phalcon_sample
```

## Passo 2: Configurando o Docker

O **Dockerfile** é necessário para que o Docker crie um contêiner com base em uma imagem PHP e faça a instalação do Phalcon.
Crie um arquivo chamado `docker-compose.yml` com o código fonte abaixo.

```yaml
version: '3'

services:
  app:
    container_name: app
    build: .
    working_dir: /var/www/html
    volumes:
      - ./:/var/www/html
    ports:
      - '8080:80'
    expose:
      - '8080'
    depends_on:
      - mysql
    links:
      - mysql

  mysql:
    container_name: mysql
    image: mysql:8
    environment:
      MYSQL_DATABASE: phalcon_app
      MYSQL_ROOT_PASSWORD: root
      SERVICE_TAGS: dev
      SERVICE_NAME: mysql
    ports:
      - '3306:3306'
```

Crie um arquivo chamado `Dockerfile` com o código fonte abaixo.

```Dockerfile
FROM webdevops/php-nginx:7.4

ARG PSR_VERSION=0.7.0
ARG PHALCON_VERSION=4.0.2
ARG PHALCON_EXT_PATH=php7/64bits

RUN set -xe && \
    # Download PSR, see https://github.com/jbboehr/php-psr
    curl -LO https://github.com/jbboehr/php-psr/archive/v${PSR_VERSION}.tar.gz && \
    tar xzf ${PWD}/v${PSR_VERSION}.tar.gz && \
    # Download Phalcon
    curl -LO https://github.com/phalcon/cphalcon/archive/v${PHALCON_VERSION}.tar.gz && \
    tar xzf ${PWD}/v${PHALCON_VERSION}.tar.gz && \
    docker-php-ext-install -j $(getconf _NPROCESSORS_ONLN) \
        ${PWD}/php-psr-${PSR_VERSION} \
        ${PWD}/cphalcon-${PHALCON_VERSION}/build/${PHALCON_EXT_PATH} \
    && \
    # Remove all temp files
    rm -r \
        ${PWD}/v${PSR_VERSION}.tar.gz \
        ${PWD}/php-psr-${PSR_VERSION} \
        ${PWD}/v${PHALCON_VERSION}.tar.gz \
        ${PWD}/cphalcon-${PHALCON_VERSION} \
    && \
    php -m

ENV WEB_DOCUMENT_ROOT=/var/www/html/application/public
```

## Passo 3: Rodando o contêiner Docker

Execute o seguinte comando para rodar o contêiner Docker.

```
docker-compose up -d
```

## Passo 4: Criando a aplicação Phalcon

Nós usaremos o [Phalcon developer tools](https://github.com/phalcon/phalcon-devtools) para criar um projeto padrão do Phalcon. Rode o comando abaixo para inicializar o composer.

```
docker-compose exec app composer init
```

Você pode inicializar o composer usando seus dados personalizados.

![Inicialização do composer](https://miro.medium.com/max/3396/1*qQmj9TZH0Nx2Ke1s_LUeqA.png)

Após a criação do `composer.json`, você precisa instalar o Phalcon developer tools e criar a aplicação.

```
docker-compose exec app composer require --dev phalcon/devtools
```

```
docker-compose exec app ./vendor/bin/phalcon project application simple
```

## Passo 5: Acessando a aplicação

Se você concluiu os passos anteriores sem erros, você pode acessar o projeto pelo seu browser, o projeto está rodando em http://localhost:8080

![Aplicação rodando](https://miro.medium.com/max/4316/1*PHGrg23dRw7Etan9oP1LLw.png)

Espero que este pequeno tutorial tenha ajudado.

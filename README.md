# phpsp.org.br
PHPSP Website

Site estático gerado via [Jigsaw](http://jigsaw.tighten.co);

## Duvidas e acompanhamento
Nós contamos com um canal aberto do Slack para tirar dúvidas e discutir problemas e soluções relacionadas ao site do phpsp.
Sinta-se livre para acompanhar e participar a qualquer momento através [do canal #Site](https://phpsp.slack.com/messages/CHTV7H1KK/)
do nosso Slack.

## Enviando artigos
* Fazer fork do repositório;
* Adicionar um novo arquivo no formato [markdown](https://en.wikipedia.org/wiki/Markdown) na pasta `source/_posts` com o seguinte cabeçalho preenchido:
> 
    ---
    createdAt: YYYY-MM-DD
    title: TITULO
    author: SEU NOME
    authorEmail: SEU EMAIL
    ---
    CONTEÚDO
    Lorem ipsum
* Enviar um PR para `master` com o novo conteúdo;

## Desenvolvimento do website local
Requisitos: PHP7.2 e Yarn instalados localmente;
Passos:
* Fazer fork do repositório;
* Rodar composer install:
```sh
composer install
```
* Rodar yarn install:
```sh
yarn install
```
* Deixar o yarn "observando" as mudanças (e gerando o conteúdo estático):
```sh
yarn watch
```
* Enviar um PR para `master` com as alterações;

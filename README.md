# phpsp.org.br
PHPSP Website

Site estático gerado via [Jigsaw](http://jigsaw.tighten.co);

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
Requisitos: PHP7.2 e NPM instalados localmente;
Passos:
* Fazer fork do repositório;
* Rodar composer install:
* > $ composer install
* Rodar NPM install:
* > $ npm install
* Reixar o NPM "observando" as mudanças (e gerando o conteúdo estático):
* > $ npm run watch
* Enviar um PR para `master` com as alterações;

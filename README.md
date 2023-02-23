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

## Convenções e metadados em arquivos markdown

Todo post em `.md` contém algumas convenções e metadados que você pode aproveitar enquanto escreve seu artigo:

* Gravatar

Através do metadado `authorEmail` iremos procurar um avatar disponível no site [Gravatar](https://gravatar.com) para exibição.

* Canonical

Se por qualquer motivo (um re-post, por exemplo) você desejar alterar a url canônica do seu post, você pode utilizar o metadado
`canonicalHref` apontando para a url original. Veja o exemplo abaixo:

```markdown
---
createdAt: 2019-05-12
...
canonicalHref: 'https://meublog.com.br/post-original'
---
```

## Desenvolvimento do website local
Requisitos: Docker e Docker-compose instalados localmente;

Passos:
* Fazer fork do repositório;
* Inicializar o container;
* Abrir a URL http://localhost:3000/ e ver o site rodando :)
* Após fazer suas alterações, enviar um PR para `master` com as alterações;


## Inicialização do Container:
### Básico
* Utilizar o helper para construir, instalar e rodar o ambiente local:
```sh
make install
```
* Para encerrar:
```sh
make stop
```
Uma vez que o ambiente é construído, nas proximas vezes bastar rodar o comando para inicializar
```sh
make start
```
Para mais comandos utilize o `help`:
```sh
make help
```

### Avançado
* Fazer o `build` do container do docker:
```sh
docker-compose build
```
* Rodar composer install:
```sh
docker-compose run --rm web composer install
```
* Rodar yarn install:
```sh
docker-compose run --rm web yarn install
```
* Deixar o yarn "observando" as mudanças (e gerando o conteúdo estático):
```sh
docker-compose up
```

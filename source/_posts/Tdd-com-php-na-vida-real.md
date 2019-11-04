---
createdAt: 2019-11-03
title: 'TDD na vida real com PHP'
author: Níckolas Silva
authorEmail: nickolas@nawarian.xyz
canonicalHref: 'https://thephp.website/br/edicao/tdd-com-php-na-vida-real/'
---

[Read in English](https://thephp.website/en/issue/real-life-tdd-php/) (link externo!)

**Antes de tudo**

TDD têm várias técnicas a serem utilizadas, este post apresenta algumas
delas. Se você está procurando se aprofundar mais no assunto, tem um livro
bom pra ti: **_"Test Driven Development: By Example"_, por Kent Beck**.

Todo código escrito aqui está disponível no [repositório do github thephp.website](https://github.com/nawarian/The-PHP-Website/tree/master/code/1-real-life-tdd-with-php/archive-org-client).

# Test-Driven Development na vida real com PHP

**Modo enrolação: desligado** (bora codar!)

Test Driven Development não é sobre escrever testes unitários, mas sim
sobre **escrever teste primeiro**.

Testes não são a coisa mais importante, **a gente escreve eles pra ter
um ciclo constante de feedback** durante o desenvolvidomento.

Com isso em mente, o nosso ciclo de desenvolvimento é o seguinte:
1. [Escreva um teste superficial, rode e veja-o falhar](#1-escreva-um-teste-superficial)
1. [Faça este teste passar da forma mais burra possível](#2-faca-este-teste-passar-da-forma-mais-burra-possivel)
1. [Refatore a implementação até que não pareça mais tão burra assim](#3-refatore-ate-que-nao-pareca-tao-burra)

## Antes do "como", vem o "porquê"

Existem algumas ótimas razões pra escrever testes primeiro. Vamos alinhar
em algumas pra que tu possa ter uma ideia de por quê manter essa prática.

Escrever testes primeiro:
- te força a saber o que você quer alcançar antes de começar a escrever código
- te mantém focado(a) em seu objetivo
- te provê uma estrutura com ciclo de feedback constante: alterar, salvar, verificar

# Construindo um adapter para buscar metadados no Archive.org com TDD

Como um exemplo razoável, vamos construir um client que busca metadados sobre
itens disponívels no site Archive.org.

**O que sabemos:**

- Archive.org nos permite fazer o upload de arquivos e os chama de "Item"
- [Aqui há um exemplo de item identificado por "nawarian-test"](https://archive.org/details/nawarian-test)
- Um item contém multiplos arquivos, representando o arquivo em várias
formas e seus metadados
- Todo item contém metadados como data de criação, nome, arquivos...
- Archive.org provê uma API para buscar metadados usando o seguinte URL:
`https://archive.org/metadata/<nome-do-item>`

**O que a gente quer:**

Uma classe para buscar os metadados de um item no Archive.org e que
nos retorne uma entidade chamada `Nawarian\ArchiveOrg\Item\Metadata`.

Vamos construir um setup básico pra escrever nosso teste que garanta
o que a gente quer!

## Configuração do ambiente de teste

Rapidex: vamos criar uma pasta para o nosso projeto, instalar os
pacotes necessários e botar os testes pra rodar. O meu setup normalmente
vem com PHPUnit e Mockery:

```shell script
$ mkdir archive-org-client/ && cd archive-org-client
$ composer require phpunit/phpunit mockery/mockery
$ ./vendor/bin/phpunit --generate-configuration
``` 

Ao gerar as configurações do phpunit, a ferramenta vai lhe perguntar sobre
diretório de testes e outras coisas. Vamos pegar as opções padrão pra tudo
aqui (só aperta "enter").

A configuração padrão diz que os nossos testes ficam dentro da pasta `tests`,
e o nosso código fica dentro da pasta `src`. Vamos criá-las:

```shell script
$ mkdir tests src
```

A gente também precisa configurar o **autoloader** do composer. Vamos
atualizar o arquivo `composer.json`, vai ficar assim:

Arquivo: **composer.json**
```json
{
    "require": {
        "phpunit/phpunit": "^8.4",
        "mockery/mockery": "^1.2"
    },
    "autoload": {
        "psr-4": {
            "Nawarian\\ArchiveOrg\\": "src/"
        }
    },
    "autoload-dev": {
        "psr-4": {
            "Nawarian\\ArchiveOrg\\Test\\": "tests/"
        }
    }
}
```

Atualizado o `composer.json`, vamos gerar o autoloader novamente:
```shell script
$ composer dump-autoload
```

Agora a gente pode criar a nossa classe de testes e começar a brincadeira!

Arquivo: **tests/ClientTest.php**
```php
<?php

namespace Nawarian\ArchiveOrg\Test;

use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testMyTest(): void
    {
        $this->assertTrue(true);
    }
}
```

E podemos rodar o phpunit normalmente:
```shell script
$ ./vendor/bin/phpunit -c phpunit.xml
```

Muintcho beeim! Com o teste configurado e rodando, vamos começar
com o TDD.

<h3 id="1-escreva-um-teste-superficial">
    1. Escreva um teste superficial, rode e veja-o falhar
</h3>

Novamente, nosso objetivo é: uma classe para buscar os metadados de
um item no Archive.org e que nos retorne uma entidade chamada
`Nawarian\ArchiveOrg\Item\Metadata`.

Nosso teste vai então se parecer com o seguinte:

Arquivo: **tests/ClientTest.php**
```php
<?php

namespace Nawarian\ArchiveOrg\Test;

use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testClientFetchesMetadata(): void
    {
        $client = new \Nawarian\ArchiveOrg\Client();

        $metadata = $client->fetchMetadata('nawarian-test');

        $this->assertSame('nawarian-test', $metadata->identifier());
        $this->assertSame('2019-02-19 20:00:38', $metadata->publicDate());
        $this->assertSame('opensource', $metadata->collection());
    }
}
```

Pronto! A gente precisa de um `Client` que contém um método `fetchMetadata()`,
que receba uma string `identifier` (nawarian-test neste caso).

A gente também quer que o retorno seja um objeto com os métodos `identifier()`,
`publicDate()` e `collection()`, retornando cada um os valores disponíveis na API.

**Salve o arquivo, rode o phpunit e veja o teste falhar.**

<h3 id="2-faca-este-teste-passar-da-forma-mais-burra-possivel">
    2. Faça este teste passar da forma mais burra possível
</h3>

O primeiro erro que vemos diz que a classe Client não foi encontrada:
`Class 'Nawarian\ArchiveOrg\Client' not found`.

Corrigir este é bem simples, criamos uma classe com o mesmo FQN. Dentro da
pasta `src/`, claro.

Arquivo: **src/Client.php**
```php
<?php

namespace Nawarian\ArchiveOrg;

class Client
{
}
```

Salve, rode o phpunit. O próximo erro diz
`Call to undefined method Nawarian\ArchiveOrg\Client::fetchMetadata()`.
Ainda mais fácil, basta escrever o método na classe `Client`:

```php
public function fetchMetadata(string $identifier): object
{
    return new \stdClass();
}
```

Salve, rode o phpunit. O próximo erro diz
`Call to undefined method stdClass::identifier()`.
Vamos então usar uma classe anônima pra acabar com esses erros
e seguir em frente!

```php
public function fetchMetadata(string $identifier): object
{
    return new class {
        public function identifier(): string
        {
            return '';
        }

        public function publicDate(): string
        {
            return '';
        }

        public function collection(): string
        {
            return '';
        }
    };
}
```

O que falta agora é fazer o teste passar **da forma mais burra possível**.
Eu consigo somente pensar em retornar direto os valores que passa no teste:

```php
public function fetchMetadata(string $identifier): object
{
    return new class {
        public function identifier(): string
        {
            return 'nawarian-test';
        }

        public function publicDate(): string
        {
            return '2019-02-19 20:00:38';
        }

        public function collection(): string
        {
            return 'opensource';
        }
    };
}
```

Massa! Os testes passaram! É hora de fazer uma implementação de verdade,
pra poder buscar os metadados da API em si. **A partir deste momento a
gente inicia o ciclo constante de feedback durante o desenvolvimento.**

<h3 id="3-refatore-ate-que-nao-pareca-tao-burra">
    3. Refatore a implementação até que não pareça mais tão burra assim
</h3>

O termo **até que** é extremamente importante aqui. Nós estamos no
último passo, mas também o passo que mais se repete.

Isto significa que nós vamos continuar retornando a este passo até
que estejamos contentes com a implementação. 

**3.1 Introduzindo a classe `Item\Metadata`**

A primeira coisa que eu sinto ser necessária é escrever a entidade `Metadata`,
desta forma a gente pode remover a classe anônima. Vamos lá:

Arquivo: **src/Item/Metadata.php** (métodos copiados da classe anônima em Client)
```php
<?php

namespace Nawarian\ArchiveOrg\Item;

class Metadata
{
    public function identifier(): string
    {
        return 'nawarian-test';
    }

    public function publicDate(): string
    {
        return '2019-02-19 20:00:38';
    }

    public function collection(): string
    {
        return 'opensource';
    }
}
```

Vamos atualizar a implementação em `Client::fetchMetadata()`. Observe
como o retorno do método mudou para `Metadata`.

Arquivo: **src/Client.php**
```php
// ...

use Nawarian\ArchiveOrg\Item\Metadata;

// class Client...

public function fetchMetadata(string $identifier): Metadata
{
    return new Metadata();
}
```

Salve, rode o phpunit. Os testes ainda estão passando. Estamos indo bem!

**3.2 Receber os dados no construtor da entidade `Metadata`**

Em vez de escrever os resultados direto no arquivo da classe `Metadata`,
vamos delegar a responsabilidade de montar os dados para a classe `Client`
e recebê-los no construtor de `Metadata`.

Arquivo: **src/Item/Metadata.php**
```php
class Metadata
{
    private $identifier;

    private $publicDate;

    private $collection;

    public function __construct(string $identifier, string $publicDate, string $collection)
    {
        $this->identifier = $identifier;
        $this->publicDate = $publicDate;
        $this->collection = $collection;
    }

    public function identifier(): string
    {
        return $this->identifier;
    }

    public function publicDate(): string
    {
        return $this->publicDate;
    }

    public function collection(): string
    {
        return $this->collection;
    }
}
```

E agora vamos delegar a responsabilidade de montar os dados para a
classe `Client`.

Arquivo: **src/Client.php**
```php
public function fetchMetadata(string $identifier): Metadata
{
    return new Metadata('nawarian-test', '2019-02-19 20:00:38', 'opensource');
}
```

Salve, rode o phpunit. Ainda está verde. Continuemos.

**3.3 Chamando a API para buscar dados de verdade**

`Client` ainda está produzindo dados falsos, o que não é bem útil.
Vamos usar a API do archive.org pra buscar os dados que precisamos.

Lembrando que o endpoint é `https://archive.org/metadata/<identificador>`.
Então invocar o método `Client::fetchMetadata()` passando `nawarian-test` como
identificador (os teste que escrevemos já faz isso), nós deveríamos chamar
`https://archive.org/metadata/nawarian-test`.

Eu vou implementar isto rapidinho usando `file_get_contents()`.

Arquivo: **src/Client.php**
```php
public function fetchMetadata(string $identifier): object
{
    $jsonData = file_get_contents("https://archive.org/metadata/{$identifier}");
    $decoded = json_decode($jsonData, true);
    $metadata = $decoded['metadata'];

    return new Metadata(
        $metadata['identifier'],
        $metadata['publicdate'],
        $metadata['collection']
    );
}
```

Salve, rode o phpunit. Testes estão passando e... nós atingimos nosso objetivo!

## Continue refatorando ou pare por aqui

A ideia do ciclo de feedback descrito no passo 3.3 é implementar nosso código
com base num objetivo bem definido.

Você encontrá vários momentos de "aaah", e vai querer implementar da melhor
forma possível desde o incício. **Não caia nessa armadilha!**

Quanto maior o tempo você passa sem feedback (sem ver os resultados dos testes),
maiores são as chances de quebrar o seu código sem entender onde ocorreu o problema.

Sempre que você encontrar algo que sinta ser muito importante, anote e continue
indo em frente! Bote esta anotação como a próxima coisa a resolver no seu ciclo,
mas não interrompa a iteração atual.

Eu posso exemplificar algumas coisas que eu gostaria de ter feito nessa implementação:

- usar um client http compatível com a PSR-18 e remover a chamada
à função `file_get_contents()`
- quebrar este teste em unitário e de integração
- um mecanismo de hydration melhor para a classe `Metadata` 

Também importante notar que nós não testamos nenhum caso de exceção. Estes testes
devem ser criados também! Como deveria a nossa classe se comportar quando
`identificador` não existe no archive.org?

Quanto mais você escreve código, mais você irá querer escrever código. Seu
trabalho aqui é entender quando parar e iniciar o próximo tópico.

**Nunca se esqueça de manter o ciclo de feedback em andamento: refatore, salve,
rode o phpunit.** 

É isso. Não tem mais motivo pra esperar pra implementar TDD.

Bora codar, leia o livro do Kent Beck e sinta-se convidado(a) a me dar um
toque pra discutir ou perguntar coisas.



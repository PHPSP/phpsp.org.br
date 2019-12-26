---
createdAt: 2019-12-11
title: Você achou que sabia sobre Generators no PHP
author: Níckolas Silva
authorEmail: nickolas@nawarian.xyz
canonicalHref: 'https://thephp.website/br/edicao/voce-achou-que-sabia-sobre-generators/'
---

[Read in English](https://thephp.website/en/issue/you-thought-you-knew-php-generators/)

## TL;DR

Generators são muito mais do que apenas dar yield em
variáveis pra evitar a utilização de arrays. Eles nos
proveem com o poder do async, coroutines e várias magias 🧙!

Se você busca uma explicação mais exaustiva, dá uma sacada
[nesse artigo de 2012 do nikic](https://nikic.github.io/2012/12/22/Cooperative-multitasking-using-coroutines-in-PHP.html).

# O que são Generators e o que eles fazem?

Comecemos pela [documentação oficial](https://www.php.net/manual/en/language.generators.overview.php).
Encontraremos várias pistas a partir dela!

Generators são uma feature do php desde a versão 5.5 da linguagem,
como você pode ver na [RFC sobre generators](https://wiki.php.net/rfc/generators).

A principal ideia dos Generators é prover uma forma **simplificada
de escrever iterators** sem ter de implementar a interface
Iterator. Generators também nos permite **interromper o fluxo
de execução do código**, o que é bem massa!

A forma como ele funciona é utilizando a palavra-chave
`yield` dentro de uma função. Ao fazer isso, o **tipo
de retorno** da sua função **automaticamente se transformará
em [`\Generator`](https://www.php.net/manual/en/class.generator.php)**.

**Então se liga!** O código abaixo _quebra_ porque força
um tipo de retorno, mas a utilização de Generators retorna
algo diferente:
```php
// String como tipo de retorno, quebrará
function myGeneratorFunction(): string
{
  yield 'Generators'; // Transforma o tipo de retorno em \Generator

  // Fatal Error: tipo de retorno é \Generator, estamos retornando string
  return 'The PHP Website';
}
```

Por nos permitir interromper a execução do código, isto
naturalmente nos permite gerenciar melhor a memória em
nossos programas php. Tem um script famoso que ilustra
este caso:

```php
// range comum
foreach (range(1, 10000) as $n) {
  echo $n . PHP_EOL;
}

// range baseado em Generators
function xrange(int $from, int $to) {
  for ($i = $from; $i <= $to; $i++) {
    yield $i;
  }
}

foreach (xrange(1, 10000) as $n) {
  echo $n . PHP_EOL;
}
```

A diferença? Alerta de super simplificação: `range()`
alocou memória para 10.000 integers, enquanto `xrange()`
alocou memória para apenas um.

Você provavelmente já sabia isso desde 2012, claro. Mas
vamos resumir aqui rapidex e partir pra parte divertida
do texto!

## O que PHP Generators fazem?

Generators nos permitem **criar iterators facilmente** sem
precisar implementar a interface Iterator e permitem
**interrupção de código** para melhor gerenciamento de
memória ou qualquer tipo de maluquice que você queira
construir.

Abaixo eu mostro um exemplo simples de generator e comento
alguns termos. Se você em algum momento ler alguma palavra-chave
que não faça muito sentido, volta aqui e lê esse exemplo.

```php
// Generator function
function xrange(): \Generator {
  // Contexto/corpo/escopo do Generator
  while (true) {
    yield 1;
  }
}

$xrange = xrange();
$xrange->next(); // Puxa o próximo yield
```

# O que você possivelmente não sabe sobre Generators...

Uma feature maravilhosa dos Generators que normalmente
deixam passar batido é a capacidade de **enviar valores
de volta para a Generator function**.

Basicamente quando você dá um `yield` dentro da generator
function, o código pára de executar lá e volta para o
contexto de quem invocou o generator. De lá é possível
enviar valores de volta para dentro da generator function.

Isso cria uma série de oportunidades para criar ferramentas
incríveis que negociam o flow de processamento para você.
Incluindo **coroutines**, **programação assíncrona** e
**otimização de coleta de dados**. Tu vai curtir essa ultima,
segue a linha!

## Como enviar valores de volta para a generator function?

Na verdade é bem simples. Um objeto do tipo Generator implementa
todos os métodos de Iterator e alguns a mais. Um deles é
o método [`Generator::send()`](https://www.php.net/manual/en/generator.send.php),
que é utilizado para enviar valores para dentro da generator
function.

Funciona da seguinte maneira:
1. Alguém invoca a generator function
1. A generator function dá yield em algo, interrompendo a
execução e voltando para quem a invocou
1. O método `send()` do objeto generator é invocado,
que passa um valor como resultado do `yield` dentro da
generator function
1. A generator function continua executando com o valor passado

Tá confuso né? Olha esse código:

```php
function meuGenerator(): Generator
{
  // 2. joga o valor 10 para quem chama a função
  $vinte = yield 10;

  // 4. Continua a execução com o novo valor
  var_dump($vinte);
}

$gen = meuGenerator();
// 1. Inicia a execução
$dez = $gen->current();

// 3. Joga de volta o valor para o generator function
$gen->send($dez * 2);

// Saída: int(20)
```

**Isso é meio que tudo o que tu precisaria saber sobre Generators.**
Quer dizer, você também pode lançar exceptions de fora da generator function
usando o método `Generator::throw()`. Mas isso é meio que tudo mesmo...

**Mas é claro que tem mais coisa pra ver!** Você não esperava
vir aqui com conteúdo que encontraria facilmente noutro canto,
né?

Lendo o post do nikic (o de 2012 que eu citei acima) você pode
extrair informações muito mais profundas sobre o que pode ser
feito com Generators no php. Vai lá, leia quantas vezes
julgar necessário até absorver a ideia.

Isso tudo é teoria e é bem massa. Mas tem algumas **implementações
reais de Generators que podem mudar a sua vida** ou pelo menos
te fazer considerar um paradigma diferente.

# Para que são utilizados Generators?

Eu gostaria de lhe apresentar **duas aplicações maneiras de
Generators com PHP**. Uma é open source e tu pode começar a
utilizar desde já. A outra é mais um conceito e tu precisaria
desenvolver algo pra si.

## Desenvolvimento assíncrono: como o framework Amp funciona

Eu sei, você provavelmente já ouviu falar do framework Amp e
como ele pode te ajudar a desenvolver código assíncrono no PHP.

**Mas eu tô aqui pra te tirar da camada de usuário.** Eu quero
que tu pense sobre como esse treco foi implementado e tenha
ao menos uma visão superficial em como ele funciona e o quão
dependente de Generators este framework é.

Considere o seguinte exemplo incompleto:

```php
Amp\Loop::run(function () {
  $socket = yield connect(
    'localhost:443'
  );

  // object(EncryptableSocket)
  var_dump($socket);
});
```

Sééé loco, tanta coisa rolando aqui...

Comecemos com a ideia de que `Amp\Loop::run()` cria um Event Loop.
Se você não sabe o que um event loop faz, dá uma paradinha aqui
e vai buscar ler um pouco sobre isso. Tu vai encontrar coisas sobre
React PHP e Node.JS.

Na verdade, tenta aprender um teco como o React PHP funciona e
como ele enfileira tarefas e faz polling para operações de E/S (I/O),
lhe permitindo fazer programação assíncrona com PHP.

A coisa é que esse Event Loop do Amp é muito especial porque
**ele não é só um event loop**. Ele também monitora `yield`,
portanto ele **espera que a sua função de callback seja uma
generator function**!

Daí além de fazer o enfileiramento e monitorar E/S pra manter a thread
desocupada, ele também trata valores que você der yield.

Ao equipar-se com [React Promises](https://github.com/reactphp/promise)
**ele te permite emular a funcionalidade async/await no PHP**.

Mas como?

Se você der uma olhadinha mais de perto na
[implementação da função connect](https://github.com/amphp/socket/blob/d49dc0d7936f65fd41068482da801768266d0c1a/src/functions.php#L63)
notará que ela retorna uma Promise que quando resolvida irá
retornar um objeto `EncryptableSocket`.

Então `connect('localhost:443');` na verdade retorna uma Promise.
Como pode `$socket` conter `EncryptableSocket` então?

No momento em que nós fazemos `yield` em uma Promise dentro
deste Event Loop, Amp irá aguardar esta promise resolver para
então devolver o valor (em caso de fulfil) ou lançar exceção
(em caso de reject).

**Namoral, num é massa isso não!? Digaí!**

Significa que você deveria escrever suas aplicações dessa
maneira de agora em diante? Talvez, talvez não...

Apesar de ser tão massa que não precisemos esperar o
async/await chegar no core da linguagem, esse modelo parece
um tanto invasivo pra quem gosta de tipificar tudo.

Primeiro de tudo, isso te força a sempre retornar um Generator
no seu callback. O que é até ok. Mas daí tu precisaria **retornar
Promise em todo canto** pra tirar proveito dessa biblioteca.

O que também pode ser ok, a galera do JavaScript faz isso
direto e não fica chateada com isso. Mas sem Type Generics é
difícil forçar os tipos de retorno das Promises.

Se você está ok com essa ideia, vá em frente. Tem todo um mundo
a ser explorado! Dá uma olhada nos [pacotes disponíveis no Framework Amp](https://amphp.org/packages)
só pra ter certeza de que você não vá reinventar a roda.

## Otimização de coleta de dados com Generators

A gente tá nessa era de web apis, o que é bem maneiro. Existem
vários padrões a se seguir enquando provedor de API: SOAP, REST,
GraphQL... O que acaba deixando pouco espaço para aplicações
MVC tradicionais que estávamos acostumados a ver há alguns anos.

Coisas como REST tendem a diminuir a árvore de dependências
da request: nós especializamos um recurso por URL, que pode,
por exemplo, ser pré computado e armazenado num repositório
de dados mega rápido.

Mas sempre que você pensar em múltiplos repositórios de dados
para compor uma resposta, Generator pode ser uma incrível
ferramenta para otimizar a utilização de recursos e tempos
de resposta.

Talvez não para apis REST, mas pensando em GraphQL é natural
que o gerenciamento da coleta de dados é importante. A
performance fala alto e nós temos as ferramentas pra fazer
isso da forma correta.

[Nessa incrível apresentação do Bastian Hoffmann](https://www.youtube.com/watch?v=YYt9u4uUetU)
a gente consegue tomar alguma inspiração a partir do momento
em que ele começa a falar sobre widgets. A ideia de ter um
request handler para determinado tipo graphql que é composto
de outros recursos mais granulares e ter essa árvore de dependências
organizada pode trazer benefícios maravilhosos.

Imagine a seguinte requisição GraphQL (sintaxe simplificada):

```gql
{
  person {
    name
  }
  team {
    people {
      name
      age
    }
  }
}
```

O array de `people` pode conter o mesmo objeto `person`
entre seus elementos. Então por quê solicitar `person` duas vezes?
Isto poderia ser otimizado numa única chamada.

Então por quê não algo parecido com o seguinte?

```php
// PersonType.php
yield DataRequirement::craft(
  Person::class,
  ['name'],
  $whereClause
);

// PeopleType.php
yield DataRequirement::craft(
  Person::class,
  ['name', 'age'],
  $whereClause
);
```

Parece um tanto estranho, né? E é mesmo, dado que engenheiros(as)
php normalmente têm um ciclo de vida bem direto em suas
aplicações.

Apenas imagine o quão bacana seria se o handler chamando
`PersonType.php` fosse o mesmo chamando `PeopleType.php` e
ao dar yield nesses dois requisitos, um `Resolver` entenderia
que eles usam exatamente a mesma entidade e otimizaria a
chamada REST/SOAP/MongoDB para solicitar somente os campos
necessários apenas uma vez.

Eu recentemente iniciei um POC em como desenvolver essa parada.
Parece com o snippet a seguir (que tu também pode [encontrar aqui](https://github.com/nawarian/resolver/blob/master/tests/integration/FetchThePhpWebsiteSitemapsTest.php#L43-L68i)).

```php
public function fetchSitemaps(): Generator
{
  // Envolve o service para sempre retornar Promise.
  // Talvez pudesse ser feito com Annotations
  $sitemapProvider = wrap($this->sitemapService);

  list($this->en, $this->br) = yield [
    $sitemapProvider->getSitemap('en'),
    $sitemapProvider->getSitemap('br'),
  ];

  // Aqui $this->en e $this->br são
  // populados com resultados do
  // getSitemap()
}
```

O quão mais eu desenvolvi essa POC, mais eu percebi que
se parecia com o Amp framework. Então acho que esse
seria [um bom ponto de partida.](https://amphp.org/amp/coroutines/)

Em geral, eu vejo grande potencial em Coroutines no PHP
e adoraria ver este lado da linguagem ser melhor desenvolvido.

Diz aí o que tu acha! Me dá um ping no Twitter e bora
desenvolver essa ideia juntos 😉


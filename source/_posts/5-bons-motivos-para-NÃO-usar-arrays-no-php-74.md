---
createdAt: 2019-05-12
title: '5 bons motivos para NÃO usar arrays no PHP 7.4'
author: Níckolas Silva
authorEmail: nickolas@nawarian.xyz
canonicalHref: 'https://imasters.com.br/back-end/5-bons-motivos-para-nao-usar-arrays-no-php-7-4'
---

A versão do php que ainda está por vir, a `7.4`, está cada vez mais rapidamente tomando forma e até o presente momento
apresenta novidades muito interessantes para a linguagem que já foram confirmadas. Dentre elas:

- [Preloading](https://wiki.php.net/rfc/preload)
- [Typed properties](https://wiki.php.net/rfc/typed_properties_v2)
- [Short closures](https://wiki.php.net/rfc/arrow_functions_v2) (!!)

A partir destas atualizações fica cada vez mais clara a intenção da comunidade em tornar o php cada vez mais simples de
escrever e confiável na execução. O php está reduzindo sua sintaxe ao mesmo passo que reafirma a tipagem e performance.

Ao mesmo tempo [o Laravel continua no topo da lista de Frameworks populares](https://hotframeworks.com/languages/php)
por diversas razões, dentre elas a facilidade de produzir software com velocidade e qualidade. Com sua sintaxe agradável
e componentes independentes, o Framework (ou partes dele) acaba conquistando até mesmo desenvolvedores mais céticos. Meu
caso.

Animado com a revolução que algumas implementações trouxeram ao blog estático do [PODEntender](https://podentender.com)
e sedento para atualizar para o php 7.4 assim que sair, eu vim aqui te contar meus **5 motivos para você NUNCA MAIS usar
arrays a partir do PHP 7.4** mas que você pode começar a aplicar desde já!

## Motivo \#1 - Arrays são uma *péssima* estrutura de dados
O termo `array` vem do Latim e significa `saco de bagulhos variados que você não quer se dar o trabalho de armazenar
propriamente`.

Mentira.

Mas veja, o tipo `array` é uma estrutura altamente permissiva que vai agregar qualquer tipo de dado indiscriminadamente.
Num mesmo array você consegue armazenar inteiros, booleanos, strings, objetos...

Essa estrutura de dados permissiva te torna num(a) eterno(a) namorado(a) ciumento(a) e tóxico(a) do seu código, tendo
que avaliar cada passo pelo qual ele passa. Não seja essa pessoa!

Veja isso:
```php
$numeros = ...;

$total = array_sum($numeros);
```

Não sei quanto a você. Mas eu não consigo confiar que `$numeros` possui apenas tipos numéricos.
Me diga aí, sem executar o código, qual o resultado da soma se números fosse o seguinte:
```php
$numeros = [0, 10, "1 maçã", false, "duas bananas"];
```

**Não consegue né, Moisés?**

Além disso os índices dos arrays também são muito permissivos. Num array é possível armazenar um valor por chave
numérica ou por string. Ou os dois!

```php
$arrayLindo = [
    5 => 'cinco',
    'um',
    'dois' => '3'
];
```

Digaí agora: em qual posição do array está o valor `um`?

Portanto a todo momento em que um `array` se apresenta pra mim, o meu código fica automaticamente duas vezes mais
defensivo. Para realizar um `array_sum()`, por exemplo, eu costumo antes fazer um `array_filter()` que vá retirar todos
itens cujo retorno de `is_numeric()` seja `false`.

Verificações que eu não precisaria fazer se pudesse confiar nos tipos internos de um array. Iterações que todos nós
poderíamos evitar.

Assim chegamos ao segundo motivo...

## Motivo \#2 - Arrays oferecem performance reduzida em diversos casos
Comecemos por um princípio básico: um parâmetro de função do tipo `object`, ou seja, uma instância de classe sempre é
passado por referência. Um parâmetro de função do tipo `array` sempre é passado por cópia.

O que isso significa em termos práticos?
```php
function arrayFunction(array $param) {
    $param['pos'] = 1;
}

function objectFunction(\stdClass $param) {
    $param->pos = 1;
}

$array = [];
arrayFunction($array);
var_dump($array); // vazio

$object = new \stdClass();
objectFunction($object);
var_dump($object); // pos = int(1)
```

Toda vez que você chamar a função `arrayFunction()` e passar um array, o php irá fazer uma cópia do array inteiro para
passar para a função. Este array se mantém naquele escopo.

Ao passo que ao passar um objeto como parâmetro, não é feita uma cópia, mas passada uma referência ao objeto.

Isto significa menos memória consumida.

E daí?

Daí que existem diversas implementações de coleção otimizadas para diversos casos diferentes com as quais você pode
utilizar menos memória, processamento ou os dois.

Vamos ver um exemplo rápido usando o `SplFixedArray`?

O fixed array é um objeto muito interessante para quando você sabe o tamanho máximo da sua coleção. E é otimizado para
lidar com os dados que espera receber.

Faz aí no seu computador! Eu vou deixar aqui o tempo que levou pra executar no meu:

```php
<?php // array.php
$tamanho = 1000000;
$inicio = microtime(true);
$array = [];

for ($i=0; $i < $tamanho; $i++) {
  $array[] = null;
}

echo (microtime(true) - $inicio) . PHP_EOL; // 0.043247938156128
var_dump(memory_get_peak_usage()); // 33950192
```

```php
<?php // SplFixedArray.php
$tamanho = 1000000;
$inicio = microtime(true);
$fixedArray = new SplFixedArray($tamanho);

for ($i=0; $i < $tamanho; $i++) {
  $fixedArray[$i] = null;
}

echo (microtime(true) - $inicio) . PHP_EOL; // 0.041646957397461
var_dump(memory_get_peak_usage()); // 16394864
```

O `SplFixedArray` neste exemplo roda em menos tempo (a diferença é inexpressiva, sejamos justos) e utiliza metade da
memória para realizar a mesma ação. **Metade!**

O tipo `array` traz consigo diversas responsabilidades: iterar, contar, armazenar e acessar por chave.

A analogia do pato se encaixa perfeitamente! Ele anda, voa e nada. Mas não faz nenhum dos três direito. **O mesmo
acontece com o nosso array**. O `SplFixedArray` é especializado em criar coleções de tamanho fixo com 16 bytes por
posição e a classe faz isso muito bem!

E olha só, o `SplFixedArray` tem toda API do `Iterator` bonitinha implementada, que é uma API consistente e que segue o
mesmo padrão por todos que a implementam, diferente de certos tipos de dados por aí... 👀

## Motivo \#3 - Existem abstrações muito mais legíveis e diretas

E aqui eu falo abertamento do pacote [Collection do Laravel](https://laravel.com/docs/5.8/collections). Apesar de não
ser o pedaço de código mais performático do mundo, ele apresenta uma API muito agradável e é extensível. Portanto a
parte de performance você pode consertar se necessário.

Vamos dar uma olhada na diferença!

Eis aqui uma coleção contendo nomes de pessoas e queremos coletar somente pessoas cujo nome tenha mais de 12 caracteres
e transformar cada nome em uma entidade `Pessoa` do nosso domínio.

```php
$nomes = ['Nome Curto', 'Um nome um pouco maior', 'Outro Curto'];

class Pessoa
{
    public function __construct(string $name)
    {...}
}
```

Este requisito se traduz em duas operações: `filter` e `map`. O nosso filter precisa remover pessoas cujo
`strlen($nome)` seja menor ou igual a `12`. Enquanto o `map` precisa transformar uma `string` em instância de `Pessoa`.

Usando a API nativa, ficaria assim:

```php
$nomes = ['Nome Curto', 'Um nome um pouco maior', 'Outro Curto'];

// Utilizando short closures: php 7.4
$nomes = array_filter($nomes, fn(string $nome): boolean => strlen($nome) <= 12);
$nomes = array_map(fn(string $nome): Pessoa => new Pessoa($nome), $nomes);
```

Além da confusão da posição dos argumentos que faz qualquer programador sem `autocomplete` pensar duas vezes sobre sua
profissão, nós precisamos atribuir o valor de `$nomes` três vezes.

Ainda de uma colher de chá e usei `array_filter()` e `array_map()`, mas eu sei que quando se trata de arrays a gente
gosta mesmo é de usar `foreach()`...

Mas veja só como o `Collection` do Laravel trata esse mesmo problema:

```php
// Isto é um exemplo! Não use collect()!! Me pergunta no twitter que eu te explico
$nomes = collect(['Nome Curto', 'Um nome um pouco maior', 'Outro Curto'])
    ->filter(fn(string $nome): boolean => strlen($nome) <= 12)
    ->map(fn(string $nome): Pessoa => new Pessoa($nome));
```

Com a API Collection fazemos uma única atribuição, a API é consistente, o código fica claro de início e de quebra você
pode optar por implementações diferentes do seu mecanismo de lista que façam mais sentido e possam ser mais eficientes
no seu caso de uso.

E são exatamente os benefícios da API Collection que contrastam com o motivo 4 a seguir:

## Motivo \#4 - A gente nunca sabe que diabos está dentro de um array

No começo do texto eu já comentei que um array é um saco de bagulhos, certo?

Já a implementação com Collection nos permite tornar a nossa coleção especializada em determinado tipo sem muita dor de
cabeça. Uma classe `PessoaCollection`, por exemplo, nos permite esperar que seus elementos são do tipo `Pessoa` em vez
de precisarmos testar com `is_string`, `instanceof` ou afins cada um dos seus elementos.

É justamente disso que o [Object Calisthenics](http://bit.ly/php-calisthenics)
fala no exercício de **First class collections**:
> Uma classe que contenha uma lista em suas propriedades, não deverá possuir outras propriedades.

Em outras palavras: larga de usar `array` pra tudo e cria uma classe pra representar sua coleção de tipo específico!

No caso de Collection tu pode ainda extender a classe e sobrescrever os métodos pertinentes pra garantir os tipos
internos da coleção, já que o PHP não traz consigo Generics.

No estatista do PODEntender eu [sequer implementei esta checagem](https://github.com/PODEntender/estatista/blob/c9c2ed7de0632cafb4cbc807bdb0c09212484bd6/src/Domain/Model/Post/PostCollection.php)
porque julguei desnecessária. Ao sobrescrever a classe Collection por um tipo específico, eu simplesmente adoto por
convenção que os tipos internos serão aqueles.

```php
class PessoaCollection extends Collection
{}
```

Diria ao ver uma classe dessa que `PessoaCollection` é um conjunto de vários objetos do tipo `Pessoa`. Portanto poderia
tornar esta classe otimizada para a sua necessidade por implementar uma estratégia específica de collection usando o
`SplObjectStorage`:

```php
class PessoaCollection extends SplObjectStorageCollection
{}

class SplObjectStorageCollection extends Collection
{
    private SplObjectStorage $storage;

    // Sobrescrever métodos pertinentes
}
```

Particularmente eu penso que sobrescrever os métodos da classe Collection é um saco. Faria mais sentido Collection ser
uma interface em alguns contextos, mas a forma como foi construída requer que não. Paciência, cada projeto entende o que
é melhor para o seu contexto. 

Todo esse esforço tem uma saída positiva, porém. Para que possamos ter um código cada vez mais testável, é importante
seguir o princípio da responsabilidade única. E é assim que chegamos ao motivo número 5:

## Motivo \#5 - A sua regra de negócio não precisa saber como funciona um array!

Será que a coleção precisa crescer? Qual o tamanho esperado? Eu preciso colocar tudo em memória ou vou usar como stream?
Eu acesso por chave numérica ou string?

Normalmente a gente não repara nisso, mas coleções por si só possuem um domínio muito específico e importante o
suficiente para uma boa modelagem. Quando a gente ignora isso, acaba tomando o caminho curto que, como vimos, pode ser
também tortuoso.

Ao tratar nossas coleções como os domínios de respeito que são, passamos também a poder depender de interfaces quando se
trata de sua utilização. Ou melhor dizendo, podemos depender de contratos!

As collections que vimos acima resolvem muita coisa para nós desde seus contratos. Funções como `filter()` e `map()`
estão sempre presentes. Além de outras muito interessantes como `groupBy()` e por aí vai. Não há bons motivos para que
executemos todas essas lógicas em nossas classes de negócio. (domínio, services, repositories...)

Além disso, há um ganho em extrair a lógica de coleção que é quase óbvio mas que vale a pena ser citado:
> Quanto menor o número de responsabilidades, mais simples e diretos serão os testes.

Para finalizar este texto (ufa) eu gostaria de trazer um ultimo exemplo de como a utilização de collections
especializadas tem se pagado no PODEntender. Se você abrir [este teste aqui](https://github.com/PODEntender/estatista/blob/083231511761cef242e232c743f8febeaef7805e/test/unit/Application/Service/Post/FetchLatestEpisodesTest.php#L26-L43)
será direcionado para o seguinte snippet:

```php
public function testExecuteFetchesExactAmount(): void
{
    $audioEpisodeCollection = $this->createDefaultAudioEpisodeCollection()
        ->sortByDesc(function (AudioEpisode $episode) {
            return $episode->createdAt();
        });

    $this->postRepository->withAudio()->willReturn($audioEpisodeCollection);
    
    $result = $this->fetchLatestEpisodesService->execute(2, null);

    $this->assertEquals(2, $result->count());

    $lastEpisode = $result->first();
    $episodeBeforeLast = $result->last();

    $this->assertEquals($audioEpisodeCollection->take(2)->first()->guid(), $lastEpisode->guid());
    $this->assertEquals($audioEpisodeCollection->take(2)->last()->guid(), $episodeBeforeLast->guid());
}
```

**Um método de teste, 11 linhas de código. (Que poderiam ser reduzidas para 5 sem muita perda de legibilidade)**

Como o nosso `postRepository` trabalha com Collections, fazer o mock para seu output é relativamente simples e direto.
As chamadas ao método `assertEquals()` também são muito simples e diretas, pois eu posso aqui confiar no contrato da
collection e simplesmente dizer ao teste o que eu espero que aconteça **de forma semântica**! 

Ainda assim você pode estar esclamando:

> Ah! Mas eu vou ficar criando classe e forçar o php a carregar mais classes atoa? Isso vai aumentar o tempo de execução
por uma questão estética!

Não, não e não. Não é atoa, não vai aumentar o tempo de execução e não é uma questão puramente estética.

Não é atoa: segregar responsabilidades e tornar sua classe testável são princípios mais que consolidados na prática de
desenvolvimento de software.

Não vai aumentar o tempo de execução: Ao menos não necessariamente. O php 7.4 traz consigo um mecanismo de preloading
que vai permitir carregar pacotes antes da execução do script e manter isto em cache para execuções futuras. Alguns
benchmarks preliminares mostraram **aumento de performance de cerca de 50%** no Zend Framework 2.

Não é uma questão puramente estética: especializar seus componentes em busca de alta coesão e baixo acoplamento são
**princípios de design** que todo software manutenível deve buscar.

## Conclusão

A versão 7.4 do php traz consigo diversas otimizações de performance e também de linguagem. Existe um esforço conjunto
da comunidade em tornar o seu código mais legível e performático. Mas principalmente: tipado!

A utilização de arrays quando mal feita tende a condenar o seu código e a quem mais tiver coragem de tocar nele. Seja em
performance, legibilidade ou até mesmo em decisões de design.

É claro que você não precisa esperar o php 7.4 sair pra parar de usar arrays. O quanto antes você começar, melhor.

Sinta-se livre pra me perguntar no [Twitter](http://bit.ly/tw-nawarian) a qualquer momento caso tenha ficado alguma
dúvida.

Um xêro muito grande e até a próxima!

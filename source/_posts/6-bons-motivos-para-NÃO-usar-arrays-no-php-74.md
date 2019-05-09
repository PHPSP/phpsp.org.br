---
createdAt: 2019-05-12
title: '6 bons motivos para NÃO usar arrays no PHP 7.4'
author: Níckolas Silva
authorEmail: nawarian@gmail.com
---

A versão do php que ainda está por vir, a `7.4`, está cada vez mais rapidamente
tomando forma e até o presente momento apresenta novidades muito interessantes
para a linguagem que já foram confirmadas. Dentre elas:

- [Preloading](https://wiki.php.net/rfc/preload)
- [Null coalescing assignment](https://wiki.php.net/rfc/null_coalesce_equal_operator)
- [Typed properties](https://wiki.php.net/rfc/typed_properties_v2)
- [Short closures](https://wiki.php.net/rfc/arrow_functions_v2) (!!)

A partir destas atualizações fica cada vez mais clara a intenção da comunidade
em tornar o php cada vez mais simples de escrever e confiável na execução. O php
está reduzindo sua sintaxe ao mesmo passo que reafirma a tipagem e performance.

Ao mesmo tempo [o Laravel continua no topo da lista de Frameworks populares](https://hotframeworks.com/languages/php) por diversas razões, dentre elas a facilidade de produzir
software com velocidade e qualidade. Com sua sintaxe agradável e componentes
independentes, o Framework (ou partes dele) acaba conquistando até mesmo
desenvolvedores mais céticos. Meu caso.

Animado com a revolução que algumas implementações trouxeram ao blog estático do
[PODEntender](https://podentender.com) e sedento para atualizar para o php 7.4
assim que sair, eu vim aqui te contar meus **X motivos para você NUNCA MAIS usar
arrays a partir do PHP 7.4**!

## Motivo \#1 - Arrays são uma *péssima* estrutura de dados
O termo `array` vem do Latim e significa `saco de bagulhos variados que você não
quer se dar o trabalho de armazenar propriamente`.

Mentira.

Mas veja, o tipo `array` é uma estrutura altamente permissiva que vai agregar
qualquer tipo de dado indiscriminadamente. Num mesmo array você consegue
armazenar inteiros, booleanos, strings, objetos...

Essa estrutura de dados permissiva te torna num(a) eterno(a) namorado(a)
ciumento(a) e tóxico(a) do seu código, tendo que avaliar cada passo pelo qual
ele passa. Não seja essa pessoa!

Veja isso:
```php
$numeros = ...;

$total = array_sum($numeros);
```

Não sei quanto a você. Mas eu não consigo confiar que `$numeros` possui apenas
tipos numéricos.
Me diga aí, sem executar o código, qual o resultado da soma se números fosse o
seguinte:
```php
$numeros = [0, 10, "1 maçã", false, "duas bananas"];
```

**Não consegue né, Moisés?**

Além disso os índices dos arrays também são muito permissivos. Num array é
possível armazenar um valor por chave numérica ou por string. Ou os dois!

```php
$arrayLindo = [
    5 => 'cinco',
    'um',
    'dois' => '3'
];
```

Digaí agora: em qual posição do array está o valor `um`?

Portanto a todo momento em que um `array` se apresenta pra mim, o meu código
fica automaticamente duas vezes mais defensivo. Para realizar um `array_sum()`,
por exemplo, eu costumo antes fazer um `array_filter()` que vá retirar todos
itens cujo retorno de `is_numeric()` seja `false`.

Verificações que eu não precisaria fazer se pudesse confiar nos tipos internos
de um array. Iterações que todos nós poderíamos evitar.

Assim chegamos ao segundo motivo...

## Motivo \#2 - Arrays oferecem performance reduzida em diversos casos
@todo -> Explicar:

- diferentes implementações de coleções
- benchmarks

O tipo `array` traz consigo diversas responsabilidades: iterar, contar,
armazenar e acessar por chave.

A analogia do pato se encaixa perfeitamente! Ele anda, voa e nada. Mas não faz
nenhum dos três direito. **O mesmo acontece com o nosso array**.

Olha bem o porquê de eu te dizer isso:

## Motivo \#3 - A API nativa de arrays é pouco legível e inconsistente
@todo -> Explicar:

- como a API é verbosa e ultrapassada
- array_filter vs. array_map
- mágicas estranhas com compact(), list()...

## Motivo \#4 - Existem abstrações muito mais legíveis e diretas

E aqui eu falo abertamento do pacote [Collection do Laravel](https://laravel.com/docs/5.8/collections).
Apesar de não ser o pedaço de código mais performático do mundo, ele apresenta
uma API muito agradável e é extensível. Portanto a parte de performance você
pode consertar se necessário.

Vamos dar uma olhada na diferença!

Eis aqui uma coleção contendo nomes de pessoas e queremos coletar somente
pessoas cujo nome tenha mais de 12 caracteres e transformar cada nome em uma
entidade `Pessoa` do nosso domínio.

```php
$nomes = ['Nome Curto', 'Um nome um pouco maior', 'Outro Curto'];

class Pessoa
{
    public function __construct(string $name)
    {...}
}
```

Este requisito se traduz em duas operações: `filter` e `map`. O nosso filter
precisa remover pessoas cujo `strlen($nome)` seja menor ou igual a `12`.
Enquanto o `map` precisa transformar uma `string` em instância de `Pessoa`.

Usando a API nativa, ficaria assim:

```php
$nomes = ['Nome Curto', 'Um nome um pouco maior', 'Outro Curto'];

// Utilizando short closures: php 7.4
$nomes = array_filter($nomes, fn(string $nome): boolean => strlen($nome) <= 12);
$nomes = array_map(fn(string $nome): Pessoa => new Pessoa($nome), $nomes);
```

Além da confusão da posição dos argumentos que faz qualquer programador sem
`autocomplete` pensar duas vezes sobre sua profissão, nós precisamos atribuir o
valor de `$nomes` três vezes.

Ainda de uma colher de chá e usei `array_filter()` e `array_map()`, mas eu sei
que quando se trata de arrays a gente gosta mesmo é de usar `foreach()`...

Mas veja só como o `Collection` do Laravel trata esse mesmo problema:

```php
// Isto é um exemplo! Não use collect()!! Me pergunta no twitter que eu te explico
$nomes = collect(['Nome Curto', 'Um nome um pouco maior', 'Outro Curto'])
    ->filter(fn(string $nome): boolean => strlen($nome) <= 12)
    ->map(fn(string $nome): Pessoa => new Pessoa($nome));
```

Com a API Collection fazemos uma única atribuição, a API é consistente, o código
fica claro de início e de quebra você pode optar por implementações diferentes
do seu mecanismo de lista que façam mais sentido e possam ser mais eficientes no
seu caso de uso.

E são exatamente os benefícios da API Collection que contrastam com o motivo 5 a
seguir:

## Motivo \#5 - A gente nunca sabe que diabos está dentro de um array

A implementação com Collection nos permite tornar a nossa coleção especializada
em determinado tipo sem muita dor de cabeça. Uma classe `PessoaCollection`, por
exemplo, nos permite esperar que seus elementos são do tipo `Pessoa` em vez de
precisarmos testar com `is_string`, `instanceof` ou afins cada um dos seus
elementos.

É justamente disso que o [Object Calisthenics](http://bit.ly/php-calisthenics)
fala no exercício de **First class collections**.

@todo -> Explicar:
- como extender Collection
- como ter várias estratégias diferentes da mesma collection
 - ex.: PessoaCollection, PessoaObjectStorageCollection, PessoaFixedArrayCollection...

Aqui eu comento sobre diferentes estratégias para sua collection porque se você
analisar bem, o Motivo 6 faz todo sentido:

## Motivo \#6 - A sua classe não precisa saber como funciona um array!

Será que a coleção precisa crescer? Qual o tamanho esperado? Eu preciso colocar
tudo em memória ou vou usar como stream? Eu acesso por chave numérica ou string?

@todo -> Explicar:

- interface de api
- testabilidade
- coleções especializadas
- mostrar como funciona no podentender

Ah! Mas eu vou ficar criando classe e forçar o php a carregar mais classes atoa?
Isso vai aumentar o tempo de execução por uma questão estética!

Não, não e não. Não é atoa, não vai aumentar o tempo de execução e não é uma
questão puramente estética.

Não é atoa: segregar responsabilidades e tornar sua classe testável são
princípios mais que consolidados na prática de desenvolvimento de software.

Não vai aumentar o tempo de execução: Ao menos não necessariamente. O php 7.4
traz consigo um mecanismo de preloading que vai permitir carregar pacotes antes
da execução do script e manter isto em cache para execuções futuras. Alguns
benchmarks preliminares mostraram **aumento de performance de cerca de 50%** no
Zend Framework 2.

Não é uma questão puramente estética: especializar seus componentes em busca de
alta coesão e baixo acoplamento são **princípios de design** que todo software
manutenível deve buscar.

## Conclusão

A versão 7.4 do php traz consigo diversas otimizações de performance e também de
linguagem. Existe um esforço conjunto da comunidade em tornar o seu código mais
legível e performático. Mas principalmente: tipado!

A utilização de arrays quando mal feita tende a condenar o seu código e a quem
mais tiver coragem de tocar nele. Seja em performance, legibilidade ou até mesmo
em decisões de design.

É claro que você não precisa esperar o php 7.4 sair pra parar de usar arrays. O
quanto antes você começar, melhor.

Sinta-se livre pra me perguntar no [Twitter](http://bit.ly/tw-nawarian) a
qualquer momento caso tenha ficado alguma dúvida.

Um xêro muito grande e até a próxima!

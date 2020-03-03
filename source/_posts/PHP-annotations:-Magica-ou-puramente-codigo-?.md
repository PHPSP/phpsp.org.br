---
createdAt: 2020-02-02
title: PHP Annotations - Mágica ou puramente código?
author: Joel Medeiros
authorEmail: jooelmedeiros+phpsp@gmail.com
---

Nós como desenvolvedores buscamos a melhor forma de escrever código, para isso, utilizamos ferramentas, bibliotecas e pacotes para auxiliar nesse processo, mas não buscamos entender o que acontece nas entranhas do código. 
Com a facilidade de um `composer require` ou `npm install` frameworks e bibliotecas estão prontos para uso e não precisamos nos preocupar em como uma funcionalidade está sendo abstraída, em contrapartida, essa artigo busca entender como annotations funcionam dentro do PHP.

### Antes de tudo, afinal o que é uma annotation? 

Uma definição que trago para computação é:

> "Alguma coisa que descreve o aspecto de um sujeito através de metadados em tempo de execução. Ou seja, os efeitos de uma annotation sobre uma classe, método ou objeto somente são apenas no tempo em que é execudado" — Baseado em ["Annotations in PHP: They Exist" - Rafael Dohms](https://www.slideshare.net/rdohms/annotations-in-php-they-exist/)

Dessa forma, diferente do que muitos pensam, podemos afirmar que annotations não são comentários e sim **metadados**.

### Qual o uso para Annotations?

Hoje é utilizado para duas coisas:
 1. Documentação
 2. Alterar o comportamento de um objeto em tempo de execução.

Para que uma linguagem de programação possa utilizar dos recursos de uma annotation é necessário que ela tenha uma **engine** rodando em seu servidor. Por exemplo a linguagem Java possui o JAPE (Java Annotation Patterns Engine) que baseado em expressões regulares traduz annotations em código. 

Já o PHP não tem uma engine nativa para leitura de annotations :(

Dentro do PHP Internals já houveram diversas discussões sobre incluir uma engine nativa para traduzir annotations, mas a comunidade acredita não ser necessária, houve inclusive em [2010 uma proposta de RFC](https://wiki.php.net/rfc/annotations) declinada que tratava exatamente deste tema.

**Então o PHP não tem annotations.**

**Fim do artigo.**

Pegadinha do malandro iê-ié!

 Engana-se quem pensou que com o PHP não é possível utilizar as "mágicas" das annotations pelo fato de não ter uma engine nativa rodando em seu servidor, o PHP utiliza reflactions para tal "mágica" e através de um parser consegue extrair os metadados.

### O que é uma reflection? 

> "É o processo na qual um programa de computador pode observar e modificar sua própria estrutura e comportamento em tempo de execução". — [Wikipédia](https://en.wikipedia.org/wiki/Reflection_(computer_programming\))

O PHP assim como em outras linguagens, tem três principais usos de reflactions:

#### Introspeção de tipo

É quando você precisa validar o tipo de um objeto ou variável estaticamente.

```php
public function test($a): void {
    if ($a instanceof MyClass) {
        // do something
    } 
}
```

```java
public void test(Object a) {
    if (a instanceof MyClass) {
        // do something
    }
}
```

```csharp
public void test(Object a) {
    if (a is MyClass)
    {
        // do something
    }
}

```

#### Informações de informações

Ou seja, dados sobre tipos, como por exemplo tipos parametrizados de classes, atributos, métodos e seus parâmetros, invocação dinâmica e etc ...


```php
/**
 * An example class with parametrized types 
 */
class MyClass {
    public array $a;
    
    /**
     * @param array $a
     */
    public  function setA(array $a):void {
        $this->a = $a;
    }
}
```

#### Visualização de metadata

Esse é o ponto onde o PHP utiliza para a leitura de metadados dos docblocks. 

```php
/** 
* A test class
*
* @param  foo bar
* @return baz
*/
class TestClass{}

$reflectionClass = new ReflectionClass('TestClass');
var_dump($reflectionClass->getDocComment());
```

O exemplo acima irá imprimir: 
```
string(55) "/** 
* A test class
*
* @param  foo bar
* @return baz
*/"
```

A partir disso, são aplicados parsers que através de expressões regulares podem transformar esse conteúdo em parâmetros: 

```php
$reflectionClassDocBlock = $reflectionClass->getDocComment();

preg_match_all(
    "#(@[a-zA-Z]+\s*[a-zA-Z0-9, ()_].*)#",
    $reflectionClassDocBlock,
    $matches,
    PREG_PATTERN_ORDER
);

var_dump($matches);
```

O exemplo acima irá imprimir:

```
array(2) {
  [0]=>
  array(2) {
    [0]=>
    string(15) "@param foo bar
"
    [1]=>
    string(12) "@return baz
"
  }
  [1]=>
  array(2) {
    [0]=>
    string(15) "@param foo bar
"
    [1]=>
    string(12) "@return baz
"
  }
}
```

O PHP possui diversas bibliotecas de parse de Docblock, eis algumas:

[Doctrine Annotations](https://github.com/doctrine/annotations)

[PHP Documentor](https://github.com/phpDocumentor/phpDocumentor)

[PHP Annotations](https://github.com/php-annotations)

### Mas afinal das contas, qual a diferença entre blocos de comentários e annotations?

Analisando o core do PHP vemos duas diferenças, quando escrevemos comentários em uma única linha é interpretado como `T_COMMENT`, este é ignorado pela engine de cache do PHP, o `opcache`.

`T_COMMENT:`
```php
// It is a comment
/* It is a comment */
```

Agora, quando temos um comentário multinível, é interpretado como `T_DOC_COMMENT`, este é lido e armazenado no cache do sistema, logo, pode ser lido em runtime. 

`T_DOC_COMMENT:`
```php
/*
 * It is a doc comment
*/
```
Bom agora que você entende o que é annotation e como elas funcionam, eis que surge a pergunta: 

### Por que usar annotations?

Prós

* Não afeta a semântica do programa, ou seja, você pode injetar comportamentos em um objeto sem ter que extender, implementar ou instanciar um novo objeto. 

* É performático pois usa o cache do sistema, como vimos anteriormente, como é interpretado em tempo de execução e é armazenado em cache, temos um ganho considerável de performance.

* É fácil de ler o código, pois sem querer (ou querendo) você cria uma documentação do seu código dentro dos docblocks, além de poder utilizar ferramentas que leem docblocks para gerar páginas de documentação como [PHPDocumentor](https://github.com/phpDocumentor/phpDocumentor).

* Ajuda em processos de refactoring segregando informações estáticas e ajuda a atingir algumas práticas de clean code.

Contras

* Por não afetar a semântica e poder injetar comportamentos em um objeto é mais difícil de debug e testes, devido ao fato de que se testa o objeto que usa as annotations e não é possível testar as annotations, portanto, tenha atenção de quais comportamentos você está inserindo em seus objetos para que no futuro isso não cause problemas de manutenabilidade.

### Quem usa annotations? 
[PHPUnit](https://github.com/sebastianbergmann/phpunit)
```php
use PHPUnit\Framework\TestCase;

/**
 * @backupGlobals disabled
 */
class MyTest extends TestCase
{
    /**
     * @backupGlobals enabled
     */
    public function testThatInteractsWithGlobalVariables()
    {
        // ...
    }
}
```

[Doctrine](https://github.com/doctrine/)
```php
/** @Entity */
class Message
{
    /** @Column(type="integer") */
    private $id;
    /** @Column(length=140) */
    private $text;
    /** @Column(type="datetime", name="posted_at") */
    private $postedAt;
}
```

[Symfony](https://github.com/symfony)
```php
// src/Controller/BlogController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog_list")
     */
    public function list()
    {
        // ...
    }
}
```

### Como usar annotations?

O PHP oferece apenas uma forma de consumo de metadata, o `doc-comments` como explicado anteriormente, mas há uma vasta quantidade de bibliotecas que são utilizadas para fazer o parser desses metadados e serem utilizados como por exemplo para representar mapeamento de objetos relacionados (ORM). 

Trago um exemplo simples utilizando a biblioteca doctrine annotations, para entender em detalhes como o PHP interpreta annotations e também como aplicar isso no dia-a-dia. O objetivo desse exemplo é, extrair informações de annotations de uma classe.


### Criando sua própria Annotation

De início, definiremos uma classe o qual será a annotation: 

```php
namespace App\Annotation;


/**
 * Class Template
 * @package App\Annotation
 * @Annotation
 */
class Template
{
    public $label;
    public $tag;

    public function __construct(array $values)
    {
        $this->label = $values['label'];
        $this->tag = $values['tag'];
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getTag()
    {
        return $this->tag;
    }
}
```

Na classe Template é definido que é uma annotation através do docblock `@Annotation` em seguida definimos que essa annotation recebe dois parametros `label` e `tag`.  

Após definir uma annotation é necessário outra classe que utilize suas annotations:
```php
namespace App\Template;

use App\Annotation\Template as TemplateAnnotation;


class AnimalTextTemplate
{
    /**
     * @TemplateAnnotation(label="Characteristic 1", tag="characteristic1")
     * @return string
     */
    public function getCharacteristic1()
    {
        return 'brown';
    }

    /**
     * @TemplateAnnotation(label="Characteristic 2", tag="characteristic2")
     * @return string
     */
    public function getCharacteristic2()
    {
        return 'lazy';
    }

    /**
     * @TemplateAnnotation(label="Animal 1", tag="animal1")
     * @return string
     */
    public function getAnimal1()
    {
        return 'fox';
    }

    /**
     * @TemplateAnnotation(label="Animal 2", tag="animal2")
     * @return string
     */
    public function getAnimal2()
    {
        return 'dog';
    }
}

```

O último passo é extrair os metadados dos atributos da classe (propriedades e métodos), para isso é utilizada a [ReflectionClass](https://www.php.net/manual/pt_BR/class.reflectionclass.php) que tem função de reportar as informações de uma classe, ou seja, trazer um relatório da classe em objeto, deixando acessível todos os metadados da classe.

```php
$reflectionClass = new \ReflectionClass(AnimalTextTemplate::class);
```

Para buscar os metadados de um método de uma classe, é utilizado o método `getMethods()`.
```php
$reflectionClass->getMethods();
```

Por fim, cada método pode possuir mais de uma annotation, a classe  `AnnotationReader` é utilziada para fazer a distinção de qual metadado(annotation) deve ser buscado.

```php
$annotationReader = new AnnotationReader();
$annotationReader->getMethodAnnotation($reflectionMethod, Template::class);
```

Juntando todas as partes temos o seguinte código:

```php
$reflectionClass = new \ReflectionClass(AnimalTextTemplate::class);
$annotationReader = new AnnotationReader();

$metatags = [];

foreach ($reflectionClass->getMethods(\ReflectionMethod::IS_PUBLIC) as $reflectionMethod) {
    if ($methodAnnotation = $annotationReader->getMethodAnnotation($reflectionMethod, Template::class)) {
        $metatags[] = [
            'tag' => "<%{$methodAnnotation->getTag()}%>",
            'label' => $methodAnnotation->getLabel()
        ];
    }
}

var_dump($metatags);
```

O resultado é:
```
array(4) {
  [0]=>
  array(2) {
    ["tag"]=>
    string(19) "<%characteristic1%>"
    ["label"]=>
    string(16) "Characteristic 1"
  }
  [1]=>
  array(2) {
    ["tag"]=>
    string(19) "<%characteristic2%>"
    ["label"]=>
    string(16) "Characteristic 2"
  }
  [2]=>
  array(2) {
    ["tag"]=>
    string(11) "<%animal1%>"
    ["label"]=>
    string(8) "Animal 1"
  }
  [3]=>
  array(2) {
    ["tag"]=>
    string(11) "<%animal2%>"
    ["label"]=>
    string(8) "Animal 2"
  }
}
```

#### Agora você deve estar pensando, para que raios eu irei utilizar esse pedaço de código?

Annotations como dito anteriormente, tem um vasto mundo de uso, em minha experiência, utilizei esse trecho de código para gerar campos dinâmicos em uma interface do usuário, e estes campos eram processados dinamicamente de acordo com a implementação do método o qual demarca a annotation, onde as annotations(`TemplateAnnotation`) eram os parametros dinâmicos e os valores o retorno dos métodos. Esse exemplo de uso será explicado a seguir.

#### Possibilidade de uso

Dada uma interface com um campo de texto livre, foi disponibilizado para o usuário diversos campos dinâmicos, esses, são o retorno do método anterior. 

```
array(4) {
  [0]=>
  array(2) {
    ["tag"]=>
    string(19) "<%characteristic1%>"
    ["label"]=>
    string(16) "Characteristic 1"
  }
  [1]=>
  array(2) {
    ["tag"]=>
    string(19) "<%characteristic2%>"
    ["label"]=>
    string(16) "Characteristic 2"
  }
  [2]=>
  array(2) {
    ["tag"]=>
    string(11) "<%animal1%>"
    ["label"]=>
    string(8) "Animal 1"
  }
  [3]=>
  array(2) {
    ["tag"]=>
    string(11) "<%animal2%>"
    ["label"]=>
    string(8) "Animal 2"
  }
}
```

Com isso o usuário pode digitar livremente o texto que quiser e incluir metadados no texto para que seja gerada uma nova string dinamicamente.

> A frase que será utilizada será a famosa frase escondida no Microsoft Word 2007:
>`The quick brown fox jumps over the lazy dog`

O campo preenchido pelo usuário com os metadados foi o seguinte:

`The quick <%characteristic1%> <%animal1%> jumps over the <%characteristic2%> <%animal2%>`

Como definido anteriormente, na classe `AnimalTextTemplate`, é necessário implementar que sempre ao encontrar as tags `animal1`, `animal2`, `characteristic1` e `characteristic2` seja retornado respectivamente `fox`, `dog`, `brown` e `lazy`. 

Através de um parser de código, são definidas as regras de como ler as annotations de uma classe. A regra utilizada será a expressão regular `"@\<\%(.*?)\%\>@"`, ou seja, será capturado todo o conteúdo que estiver dentro de `<%%>`.

```php
/**
 * @param string $input
 * @return array
 */
protected function getMetatags(string $input): array
{
    if (preg_match_all("@\<\%(.*?)\%\>@", $input, $match)) {
        return $match;
    }

    return [];
}
```

O resultado do método anterior, recebendo o input do usuário será o seguinte: 

```
array(2) {
  [0]=>
  array(4) {
    [0]=>
    string(19) "<%characteristic1%>"
    [1]=>
    string(11) "<%animal1%>"
    [2]=>
    string(19) "<%characteristic2%>"
    [3]=>
    string(11) "<%animal2%>"
  }
  [1]=>
  array(4) {
    [0]=>
    string(15) "characteristic1"
    [1]=>
    string(7) "animal1"
    [2]=>
    string(15) "characteristic2"
    [3]=>
    string(7) "animal2"
  }
}
```
No primeiro índice temos todas as metatags capturadas, no segundo, as tags nominadas. Com isso, é possível acessar a classe o qual definiu essas tags para extrair os metadados:

```php
/**
 * @param array $metadataKeys
 * @return ArrayCollection
 * @throws \Exception
 */
protected function getMetadata(array $metadataKeys): ArrayCollection
{
    $metadata = new ArrayCollection();

    foreach ($metadataKeys as $metadataKey) {
        $method = "get" . lcfirst(str_replace('_', '', ucwords(strtolower($metadataKey), '_')));

        if (!method_exists($this, $method)) {
            throw new \Exception("Method {$method} not implemented in " . get_class($this) . " class");
        }

        $metadata->set($metadataKey, $this->$method());
    }

    return $metadata;
}
```

O output desse trecho de código irá nos trazer um conjunto de dados associados pela tag e seu real valor:

```
object(Doctrine\Common\Collections\ArrayCollection)#2 (1) {
  ["elements":"Doctrine\Common\Collections\ArrayCollection":private]=>
  array(4) {
    ["characteristic1"]=>
    string(5) "brown"
    ["animal1"]=>
    string(3) "fox"
    ["characteristic2"]=>
    string(4) "lazy"
    ["animal2"]=>
    string(3) "dog"
  }
}
```

Com esses dados, podemos fazer uma simples regra de substituição de parametros e aplicar na string do usuário:

```php
$metatags = $this->getMetatags($input);
$findBy = $metatags[0];
$metadataKeys = $metatags[1];

/** @var ArrayCollection $metadata */
$metadata = $this->getMetadata($metadataKeys);

$output = $input;

foreach ($findBy as $key => $value) {
    $metadataKey = $metadataKeys[$key];
    if (!$metadata->containsKey($metadataKey)) {
        continue;
    }

    $output = str_replace($value, $metadata->get($metadataKey), $output);
}

var_dump($output);
```

Output:
```
string(50) "The quick brown fox jumps over the lazy dog typing"
```
### Conclusão

O *PHP não possui* uma engine nativa de Annotations, mas a necessidade de uma é dispensável visto que temos acesso a todos os metadados de uma classe através da `ReflectionClass`, a função dos parsers nesse contexto é vital para que esses dados possam ser utilizados em nossos códigos.
A vasta quantidade de bibliotecas para Docblock parsers disponíveis leva a compreender a decisão do PHP Internals de recusar a implantação de uma engine nativa para annotations.

O uso de annotations é amplamente discutido em diversas comunidades e difundido por diversas ferramentas, mas seu uso não se limita apenas a essas "magias" das ferramentas, entendendo o seu uso e aplicabilidade serve também para resolver problemas do dia-a-dia. 


O código desse artigo encontra-se disponível em:

https://github.com/joelmedeiros/useful-annotations


### Referências

[Rafael Dohms - PHP Annotations: They Exist!](https://www.youtube.com/watch?v=oDVspbFgDCo)

[PHP RFC: Annotations 2.0](https://wiki.php.net/rfc/annotations_v2)

[Understanding annotations
](https://php-annotations.readthedocs.io/en/latest/UsingAnnotations.html)

[Rafael Dohms - Annotations in PHP: They Exist](https://www.slideshare.net/rdohms/annotations-in-php-they-exist/138-Reflection)

[Should we use PHP Annotations?](https://medium.com/a-young-devoloper/should-we-use-php-annotations-4efafea23334)

[USING ANNOTATIONS IN PHP WITH DOCTRINE ANNOTATION READER](http://masnun.com/2012/08/12/using-annotations-in-php-with-doctrine-annotation-reader.html)
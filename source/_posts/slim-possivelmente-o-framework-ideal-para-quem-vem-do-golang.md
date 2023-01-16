---
createdAt: 2023-01-16
title: 'Slim, possivelmente o framework ideal para quem vem do Golang'
author: Joubert RedRat
authorEmail: eu+github@redrat.com.br
canonicalHref: 'https://blog.redrat.com.br/slim-possivelmente-o-framework-ideal-para-quem-vem-do-golang'
---

Eu trabalho com programação PHP há pelo menos 13 anos, já usei o PHP puro, frameworks como [CodeIgniter](https://codeigniter.com/), [Symfony](https://symfony.com/), [Laravel](https://laravel.com/), [Laminas/Zend](https://getlaminas.org/), [CakePHP](https://cakephp.org/), [Yii](https://www.yiiframework.com/), já fiz um framework próprio, o [Fox](https://github.com/joubertredrat/fox), já usei e criei várias bibliotecas também. Enfim, vi muita coisa no mundo do PHP.

Porém, eu sentia a necessidade de ter experiência com uma segunda linguagem de programação e escolhi o Golang como expliquei [aqui](https://dev.to/joubertredrat/porque-escolhi-o-golang-como-segunda-linguagem-5b8a).

Mas, depois de um tempo, acabei tendo saudades do PHP e como ele evoluiu nestes 4 anos que estive no mundo Golang, decidi fazer uns projetos para me manter atualizado na linguagem, mas aí veio o desafio.

## Como trazer a filosofia minimalista do Golang para PHP?

Uma das coisas que mais gosto no mundo do Golang é ter quase total controle sobre o código e queria ter o mesmo controle no PHP, então decidi pesquisar e estudar frameworks para este objetivo.

## Slim Framework

Logo de início, escolhi o [Slim](https://www.slimframework.com/) primeiro para fazer os testes, até porque eu me lembrava bem dele quando também estudei o finado Silex no passado para uso de um micro framework.

Nos primeiros testes eu usei o Skeleton do Slim e vi que ele utiliza somentes bibliotecas realmente necessárias para o funcionamento mínimo, como o [PHP-DI](https://github.com/PHP-DI/PHP-DI), [Monolog](https://github.com/Seldaek/monolog) e o próprio [Slim](https://github.com/slimphp/Slim) e a lib [PSR-7](https://github.com/slimphp/Slim-Psr7) do Slim, como pode ser visto [aqui](https://github.com/slimphp/Slim-Skeleton/blob/master/composer.json#L24). Com isto eu tenho um container para injeção de dependências, log, rotas, handlers, middlewares e pronto, tudo que eu preciso! Para conferir o Skeleton do Slim, basta acessar [este link](https://github.com/slimphp/Slim-Skeleton).

Com isso, todo o resto fica por minha conta, seja arquitetura em camadas, interfaces, repository, use cases, etc. Isto torna até mais fácil ter uma estrutura para testes unitários. Isto torna o projeto muito mais enxuto.

## Porque não Symfony?

Eu vi a evolução do [Symfony](https://symfony.com/) desde a versão 1 e vi como ele evoluiu de um grande e inchado framework para um micro framework, com o suporte de vários componentes da própria Symfony que você pode instalar opcionalmente e isto é muito bom, pois permite que você escolha somente o que irá precisar.

Um exemplo disto era que lembro que antigamente a gente fazia APIs no Symfony, mas o [Twig](https://twig.symfony.com/) era instalado como dependência, mesmo sem a gente precisar dele.

Confesso que embora eu seja um grande fã boy do Symfony, eu ainda considero um pouco chatinho lidar com o Kernel e configurações dele, principalmente por ficar em arquivos separados, embora eu entendo que isso é por conta dos bundles, que é algo excelente no ecossistema do Symfony.

Mas, o Symfony seria minha segunda escolha, caso Slim não atendesse minhas expectativas.

## Porque não Lumen?

Embora o [Lumen](https://lumen.laravel.com/) faça menos "mágica" que o Laravel, ainda sim eu não tenho o controle que eu gostaria do código, além dele ter muitas, muitas, muitas dependências, como pode ser visto [aqui](https://github.com/laravel/lumen-framework/blob/9.x/composer.json#L17).

## Conclusão

Por fim, minha escolha pelo Slim foi por conta da simplicidade e facilidade de implementação do seu código, deixando para ele algumas tarefas como injeção de dependências, rotas e middlewares, enquanto você fica com o resto, ao estilo "Do It Yourself".

Então é isto, até a próxima!

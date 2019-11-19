---
createdAt: 2019-11-19
title: Como o PHP funciona na verdade
author: Níckolas Silva
authorEmail: nickolas@nawarian.xyz
canonicalHref: 'https://thephp.website/br/edicao/como-php-funciona-na-verdade/'
---

[Read in English](https://thephp.website/en/issue/how-does-php-engine-actually-work/)
(Link externo!)

## TL;DR

PHP é uma linguagem de script que interpreta arquivos e os transforma
em opcodes, e executa estes opcodes para obter resultados. Opcache e
preloading ajudam PHP a remover a sobrecarga neste processo.

Em servidores web, PHP normalmente é utilizado com PHP-FPM, que traz
consigo uma capacidade incrível de escalabilidade.

# Então... o que é PHP?

@php
  $hoje = date_create('today');
  $dataLancamentoPhp = date_create('1995-06-08');
  $anosDesdeLancamento = $hoje->diff($dataLancamentoPhp)->y;
@endphp

Eu fico muito feliz em ver como o desenvolvimento moderno com PHP
requer cada vez menos conhecimento para construir produtos incríveis.
**Isso é muito massa!**

Numa pesquisa rapidinha a gente encontra a informação de que PHP
tornou-se público cerca de [{{ $anosDesdeLancamento }} anos atrás](https://groups.google.com/forum/#!msg/comp.infosystems.www.authoring.cgi/PyJ25gZ6z7A/M9FkTUVDfcwJ).

A forma como PHP começou é extremamente importante pra entender como
e por quê ele se tornou tão popular. Também torna muito mais fácil
entender a maior parte de suas características e decisões arquiteturais.

PHP nasceu como uma template engine. Era uma série de programas CGI
que permitia o desenvolvimento de páginas web como valores dinâmicos.

Sim, a ideia era justamente misturar HTML e PHP. Só que em 1995 isso
era revolucionário!

Como linguagem de script, PHP executa seus códigos sequencialmente
do início ao fim do arquivo e toda execução é 100% nova. Sem
compartilhamento de memória ou contexto.

Quando falamos de desenvolvimento web, isso pode mudar um pouco. Dado
que o PHP pode rodar como CGI ou módulo no servidor http. Vamos dar
uma olhada.

## Como o PHP funciona com servidores HTTP?

Em geral, servidores HTTP têm uma responsabilidade bem clara:
prover conteúdo de hipermídia usando o [Protocolo HTTP](https://tools.ietf.org/html/rfc2616#page-7).
Isto significa que **servidores http recebem uma request, buscam
um conteúdo do tipo string de algum lugar, e respondem com esta string**
baseando-se no Protocolo HTTP.

PHP veio para tornar este conteúdo de hipermídia dinâmico, permitindo
que desenvolvedores possam prover mais que arquivos `.html` simples e
estáticos.

Enquanto linguagem de script, num contexto de scripting, o PHP isola
toda execução. Portanto não compartilha memória ou outros recursos entre
execuções.

Já enquanto no contexto web, temos duas formas diferentes de executar
código PHP e cada uma possui seus prós e contras.

É possível conectar o PHP a servidores http utilizando uma conexão do
tipo CGI ou como um módulo. A maior diferença entre os dois modos é que
**módulos http compartilham recursos com o servidor HTTP** enquanto no
modelo **CGI, php faz uma execução nova a cada request**.

Utilizar o PHP como módulo costumava ser bem popular, por sua
comunicação com o servidor http ter menores barreiras. Ao passo que
um script CGI dependeria, por exemplo, de comunicação em rede entre
o servidor http e a execução do código.

**Isso costumava ser o gargalo em set ups PHP. Hoje em dia, é justamente
onde o PHP brilha!**

Com o [PHP-FPM](https://www.php.net/manual/en/install.fpm.php) um servidor
como nginx ou Apache podem facilmente executar código php como se fosse
um script CLI. Onde cada request é 100% isolada das outras.

Isto também significa que o servidor HTTP pode escalar independentemente
do executor de códigos PHP. Com as nossas tecnologias atuais, isso **é
incrível para nos permitir escalar verticalmente**.

Utilizar o PHP com CGI lhe permite atualizar sua aplicação rapidamente
sem precisar reiniciar o servidor HTTP a cada deployment. Com a moda
de utilizar load balancers isso não é tão crítico, mas vale mencionar.

Outro grande benefício de utilizar PHP-FPM é que sempre que um script
php quebrar, apenas aquela request está comprometida. O restante da
aplicação pode continuar executando normalmente, já que os recursos
não são compartilhados.

Então se a gente ignorar a utilização do PHP como módulo, a forma como
ele funciona na web é basicamente: **HTTP Server ⇨ PHP-FPM (Server) ⇨ PHP**.

E é por isso que nós dizemos normalmente que o PHP é extremamente
escalável por natureza.

Mas o PHP ainda é uma linguagem de script. E como no contexto CGI ele
possui uma execução isolada a cada request, isso também significa que
a sua característica mais escalável também é um dos seus mais relevantes
gargalos de performance.

## Como o scripting com PHP funciona?

A linguagem PHP é escrita em C e a forma como funciona é na real bem
massa.

O interpretador php lê arquivos contendo código php, analiza sua sintaxe,
transforma tudo que entende como código php em opcodes e mais tarde
executa esta lista de opcodes.

Em termos simplificados, o php: **interpreta, compila e executa**.

Toda as vezes novamente (a gente volta nesse ponto já já).

Então a cada vez que você tenta executar um script php, você encontrará
diferentes coisas em diferentes momentos:

**Erros sintáticos e verificações de linguagem acontecem durante a fase
de interpretação e compilação. Erros lógicos (como exceções) ocorrem apenas
durante a fase de execução.**

A forma como o PHP faz isso é através de uma [Árvore Sintática Abstrata (Abstract Syntatic Tree - AST)](https://wiki.php.net/rfc/abstract_syntax_tree)
para entender o que as coisas dentro do arquivo php significam.

Esta árvore sintática mapeia estruturas de linguagem em instruções de
compilação, que quando compiladas se transformam em opcodes da Zend VM.
Tais opcodes então podem ser [interpretados pela Zend VM](https://github.com/php/php-src/blob/master/Zend/zend_vm_def.h).

Então se você parar pra pensar, **a parte mais relevante na execução do código
PHP ocorre quando a Zend VM executa opcodes**. Isto é o que realmente
produz o resultado que esperamos.

Ao fim do dia, **ter uma execução isolada a cada request não parece tão
inteligente se precisarmos compilar a sintaxe php em opcode a cada nova
request**.

Por isso o [OPcache](https://www.php.net/manual/en/intro.opcache.php)
existe. Não existem soluções sem problemas.

Com OPcache o PHP pode tomar vantagem de um espaço de memória compartilhado:
ler/gravar scripts já interpretados e otimizar execuções futuras.

Na primeira vez que uma request toca `index.php`, por exemplo, o php
interpreta, compila e executa. Da segunda vez que a request toca `index.php`,
o php simplesmente busca o compilado do OPcache e o executa.

Isto está para mudar, porém. Desde o PHP 7.4 um [preloader de opcache foi adicionado ao PHP](https://wiki.php.net/rfc/preload).
Esta funcionalidade permite uma série de arquivos php serem pré-carregados
ao subir o servidor. Desta forma, da primeira vez que uma request tocar
`index.php`, o php irá buscar o compilado diretamente no opcache. **Sem
precisar interpretar o arquivo durante a request**.

## E pra quê tu tá me dizendo tudo isso?

Eu sinto que engenheiros(as) PHP (assim como python) normalmente possuem
grande conhecimento sobre como os componentes se conectam no back-end,
dado que nossas linguagens normalmente não provém muita mágica ou
software caixa preta de terceiros.

Eu também sinto que isto vem mudando com o tempo, dado que o software
Open Source se mostrou mais que somente um Hype, mas um ótimo modelo
econômico. Mais linguagens precisam que seus(uas) engenheiros(as)
entendam como as coisas se encaixam e estão se tornando cada vez mais
vendor agnostic.

Mas ainda não estamos lá, e dominar o ecossistema PHP é necessário
para investir esforços em performance e segurança corretamente. Saber
quando e onde as coisas acontecem irá lhe dar suporte em otimizar
como elas devem acontecer.

Eu espero que este texto tenha lhe ajudado a entender melhor como a
engine PHP funciona por baixo dos panos, o ferramentário que utiliza e
palavras chave importantes que você provavelmente irá encarar em algum
momento.

Se você tiver alguma pergunta que eu não tenha respondido aqui ou
crê que cometi algum erro neste texto, sinta-se livre para entrar
em contato e, se eu entender que se encaixa aqui, vou manter este post
atualizado para que possamos aprender juntos.


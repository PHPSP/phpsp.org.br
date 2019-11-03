---
createdAt: 2019-10-29
title: 'Olá, PHP. Eu sou um Engenheiro.'
author: Níckolas Silva
authorEmail: nickolas@nawarian.xyz
canonicalHref: 'https://thephp.website/br/edicao/ola-php-eu-sou-um-engenheiro/'
---

[Read in English](https://thephp.website/en/issue/hello-php-i-am-an-engineer) (link externo!)

Eu escrevi este post pra você poder compartilhar toda vez que
alguém lhe perguntar algo como:

> _"As pessoas ainda usam PHP?"_

## TL;DR

**Você soa extremamente inexperiente quando ataca o PHP** a cada
oportunidade. Se você o faz, é melhor investir seu tempo tornando-se
um(a) engenheiro(a) melhor. Provavelmente ainda há um looongo caminho
a ser percorrido.

Leia abaixo.

# Olá, PHP. Eu sou um Engenheiro.

Eu escrevo este post um pouco depois da `CVE-2019-11043` ter se
tornado popular. Sim, popular.

Veja, tem uma enorme diferença entre desenvolvimento mainstream e
desenvolvimento de software de verdade.

`CVE-2019-11043` na realidade é [bug #78599](https://bugs.php.net/bug.php?id=78599),
reportado em setembro deste ano. O problema e sua prevenção estavam
explícitos desde o começo, a correção e release vieram pouquíssimo
depois. Na verdade, desenvolvedores(as) PHP já viram isso em 2010.
Nós já sabíamos como evitar este bug.

Por que eu cito este caso? **Porque a internet é simplesmente muito
barulhenta**.

Dá uma buscada por "websites afetados pelo CVE-2019-11043". Vai lá!

Algumas páginas inclusive descrevem o problema como uma falha
baseada em "buffer **overflow**".

Parece a galera do RH tentando lembrar algumas palavras chave pra
soar convincente o suficiente e chamar a gente pra tomar um café.
(A propósito, muito agradecido, viu?)

Fato é que, até o presente momento, pouquíssimos (ou nenhum) sites
vieram a público reportar o quão horrível essa falha de segurança
foi para eles. Na realidade, eu não ouvi falar de nenhum.

Sabe por quê? **PHP não é mainstream**.

Programadores(as) PHP são, de fato, capazes de fazer todo tipo de
maluquisses com a linguagem. Bem como qualquer progrador(a) de
qualquer outra linguagem.

É só que depois de **25 anos de PHP** a gente aprendeu que não
devemos.

Em vez de somente aprender como escrever código ruim em diversas
linguagens (que a gente também faz), optamos por formar o PHP e
todo seu ecossistema a ficar um pouquinho melhor todos os dias.  

## PHP é, de fato, uma linguagem pirata

Uma vez eu ouvi que PHP é uma linguagem pirata. E eu gosto demais
dessa metáfora.

PHP junta as melhores coisas de várias linguagens, compacta tudo
num **ambiente simples e de fácil utilização** e aproveita seu
poder entregando produtos incríveis de forma indescritívelmente
rápida!

Tantas palavras chave aqui, os(as) hipsters não vão entender de
primeira. Deixa eu reorganizar pra eles(as).

**Fácil. Entrega. Incrível. Produto. Rápido.**

A coisa é que o PHP não está sendo vendido para as pessoas como
a última bolacha do pacote. Mas sempre que tu pensa em
desenvolvimento web, o **php é simplesmente bom demais pra ser
ignorado**.

Da prototipação à produção, o php é direto, fácil de entender e
de encontrar/solucionar problemas. Sua comunidade é incrivelmente
ativa, útil e esperta!

**A comunidade PHP é FODA!**

_A sua linguagem favorita põe seu time a discutir por horas sobre
os milhares coding styles proprietários ou a criar o próprio?_

A minha não. [PSR-1](https://www.php-fig.org/psr/psr-1/),
[PSR-2](https://www.php-fig.org/psr/psr-2/),
[PSR-4](https://www.php-fig.org/psr/psr-4/),
e [PSR-12](https://www.php-fig.org/psr/psr-12/) vieram da
comunidade pra normalizar a forma como a gente escreve código
e pronto. Junto de várias ferramentas maravilhosas pra reforçar
e ajudar a manter essa forma unificada de escrever código.

A gente tende a gastar menos tempo/dinheiro falando sobre onde
colocar os nossos colchetes, e investimos melhor este tempo falando
sobre produto, problemas e soluções.

_Quantos pacotes você instala pra conectar ao seu banco de dados?_

Quantos eu instalo? Um. O PHP.

PHP vem com drivers oficiais e muito bem testados pra se conectar
com vários bancos de dados relevantes e, se não for suficiente,
extensões em C ou PHP estão também disponíveis.

**Ah, mas PHP não consegue fazer isso ou aquilo**.

Tá, tô sabendo. A pergunta é: deveria? Deveria o PHP realmente
entrar de vez com multi threading sem extensões, async/await
direto na STDlib e annotations?

**Será que realmente faz sentido?** Pense no ecossistema PHP,
no ciclo de vida, no foco e na audiência. É tão ruim assim que
o PHP não venha com essas funcionalidades?

A resposta, queridos(as) hipsters, é simplesmente: deixa a
comunidade decidir.

A principal ideia guiando o desenvolvimento da linguagem é que
**a gente sabe mais**. Não eu, não os(as) desenvolvedores(as) php,
não a comunidade PHP. **Nós, comunidade, sabemos mais**.

Seja uma ideia, ferramenta ou configuração, a comunidade sabe mais.
E para desenvolvedores(as) PHP isto é tão óbvio que eu me sinto
desconfortável repetindo tanto. 

Digo, olha esse site! Totalmente criado com código da comunidade.
Eu praticamente não escrevi nada, exceto pelo texto.

Enquanto alguns tentam provar sua capacidade falando mal de
outras linguagems, **eu tô entregando valor com baixíssimo
atrito.**

Contribuidores(as), de qualquer linguagem de programação, são
capazes de tornar este website melhor.

Se você vier me dizer que o PHP é extremamente lento, eu não tenho
nenhuma resposta melhor que "vai aprender PHP". Eu posso até lhe
oferecer ajuda se tu for bacana.

Sabendo apenas o suficiente já lhe levaria a concluir o quão bobo
é dizer sobre a performance da linguagem sem entender qual problema
tu precisa resolver.

**Não existe solução para problemas que não foram compreendidos.**

> Tá, mas tipo, PHP é extremamente lento enquanto linguagem.
> Pensa no conceito, php é simplesmente lento.

\* suspiro *

## PHP é só mais uma ferramenta. É o _SEU TRABALHO_ entender se é a adequada

Sério, se tu puder tomar pelo menos uma ideia desse texto contigo,
escolhe essa daqui: **como engenheiro(a), seu trabalho é encontrar
o problema, identificar soluções e adotar a que se encaixa melhor**.

Não a melhor, não a cheia de firulas. A que se encaixa melhor!
Tempo, dinheiro, recursos, manutenção, facilidade de aprendizado,
performance...

Aquela animação de transição é tão importante, ou o SEO fala mais
alto para o seu negócio? Você realmente precisa manter estado pra
mostrar um alerta pop up?

Um software escrito em 20 dias que deverá ser reescrito em 12 meses
soa melhor que outro escrito em 4 meses e reescrito em 2 anos?
As vezes sim, as vezes não. As vezes refatoração constante é bem
melhor. Conheça seu problema primeiro!

**Isso também vale para engenheiros(as) php que fazem piada dos(as)
especialistas Laravel.** Eles estão construindo ferramentas incríveis,
incrivelmente rápido e entregando um valor enorme. Eles também estão
aprendendo a partir de seus erros e tornando seu ferramental muito
melhor todos os dias!

**Encontre a ferramenta pra resolver seu problema. Não o problema a
ser resolvido pela sua ferramenta**.

Até o momento, em minha carreira, eu tenho a fortíssima convicção de
que **escrever código é a parte MAIS FÁCIL**.

Eu também já lutei por conta de linguagem de programação, mas não o
faço mais. E espero que eu tenha lhe ajudado a chegar a mesma
conclusão que eu cheguei:

> A boa engenharia de software acontece antes do software ser escrito.
> De preferência, sem sequer escrever software.

Me levou um tempo pra perceber isto, mas a minha capacidade de analisar
sistemas é extremamente importante pra evitar gastar recursos e a
saúde das pessoas envolvidas. Eu simplesmente não consigo evoluir como
engenheiro sem sequer tentar entender o impacto das minhas decisões
enquanto engenheiro.

Não é sobre sentimento, intuição ou gosto. É sobre solucionar problemas.
Se você escuta "PHP" e tem imediatamente esse sentimento de que deve
falar mal da linguagem, você ainda tem muito o que aprender.
Você sabe disso, desenvolvedores(as) sênior sabem disso e o seu
atual/futuro(a) chefe também sabe disso.

Nós poderíamos ser uma grande e maravilhosa comunidade, movendo cada
um em direção ao sucesso e falando sobre suas qualidades em vez de
indivíduos suando para crescer tentando apontar os defeitos dos
outros.

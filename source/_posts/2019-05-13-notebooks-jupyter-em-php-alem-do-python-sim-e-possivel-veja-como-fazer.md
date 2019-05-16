---
createdAt: 2019-05-13
title: 'Notebooks Jupyter em PHP, além do Python? Sim, é possível: veja como fazer!'
author: Rogério Prado de Jesus
authorEmail: rogeriopradoj@gmail.com
---

<figure>
    <img title="Sim, é possível!" src="/assets/images/posts/2019-05-13-notebooks-jupyter-em-php-alem-do-python-sim-e-possivel-veja-como-fazer/13-notebooks-jupyter-em-php-alem-do-python-sim-e-possivel-veja-como-fazer-01.png" alt="Sim, é possível!">
    <figcaption>Sim, é possível!</figcaption>
</figure>

Fala pessoal, tudo bem?

É muito comum durante nossa jornada de cursos no tema de Big Data, Analytics, Data Science, IA e afins sermos apresentados à plataforma Jupyter e aos seus notebooks, não é mesmo?

> [Jupyter](https://jupyter.org/): The Jupyter Notebook is an open-source web application that allows you to create and share documents that contain live code, equations, visualizations and narrative text. Uses include: data cleaning and transformation, numerical simulation, statistical modeling, data visualization, machine learning, and much more.

E, acredito que se você já mexeu nessa plataforma, o padrão é usar a linguagem de programação Python, certo? Talvez R também? E se te disser que é possível usar várias outras também? Sim, durante a escrita deste artigo, 2019/MAI, já são mais de 40 linguagens suportadas. E o mais impressionante: o PHP é sim uma dessas linguagens suportadas no Jupyter Notebook!

Vamos conhecer então como fazer?

### Primeiro: tenha o Jupyter disponível

A maneira mais simples que conheço no Windows é tendo o Anaconda disponível. Você consegue mais informações acessando o site oficial: https://www.anaconda.com/distribution/

> [Anaconda](https://www.anaconda.com/): The World's Most Popular Python/R Data Science Platform

### Tenha o PHP e o Composer com as dependências instaladas

Em <https://windows.php.net/> você consegue pegar a última versão disponível do PHP. Para as coisas funcionarem você precisa pelo menos da versão PHP 7.2+. Vale a pena colocar a pasta do binário do php.exe na sua variável de ambiente PATH, assim, você pode chamar o comando php de qualquer terminal. Talvez te ajude: a versão que usei aqui no meu computador é a PHP 7.2.7 NTS x64.

É necessário também ter instalado o gerenciador de dependências Composer. Mais informações no site oficial, <https://getcomposer.org/>. Se instalar ele certinho, vai poder ter o comando composer disponível de qualquer terminal.

E, por último, é necessário que você tenha no PHP a extensão ZMQ. Para isso:

* baixe no site da extensão PECL, <https://pecl.php.net/package/zmq/1.1.3/windows>, a versão correspondente ao que você tem no seu computador (no meu caso, baixei a "7.2 Non Thread Safe (NTS) x64"). Quer saber qual sua versão do php? É fácil: no terminal, digite: `php -v`.
* na mesma pasta onde tem o arquivo php.exe, descompacte o arquivo libzmq.dll
* na pasta ext, descompacte o arquivo php_zmq.dll
* inclua no fim do seu arquivo php.ini a declaração `extension=php_zmq.dll`

Não sabe onde fica o arquivo php.ini? É fácil descobrir: só digitar no terminal: `php --ini`. 

Foi na pasta e não achou um arquivo php.ini? Tranquilo: faça uma cópia do arquivo php.ini-development como php.ini. E depois edite esse php.ini.

Quer confirmar se a extensão ZMQ está instalada? Na linha de comando, pode executar o seguinte comando para mostrar todas as extensões disponíveis: `php -m`.

### Instale o componente Jupyter-PHP (o kernel de PHP para o Jupyter)

No site oficial, <https://litipk.github.io/Jupyter-PHP-Installer/>, tem mais informações. Em resumo:

* baixar o instalador .phar, <https://litipk.github.io/Jupyter-PHP-Installer/dist/jupyter-php-installer.phar>;
* entrar na pasta onde baixou, pelo terminal, e executar: `php jupyter-php-installer.phar install`.

<figure>
    <img title="Resultado da instalação do Juptyer-notebook" src="/assets/images/posts/2019-05-13-notebooks-jupyter-em-php-alem-do-python-sim-e-possivel-veja-como-fazer/13-notebooks-jupyter-em-php-alem-do-python-sim-e-possivel-veja-como-fazer-03.png" alt="Resultado da instalação do Juptyer-notebook">
    <figcaption>Resultado da instalação</figcaption>
</figure>

E é isso! Se tiver problemas com o Composer não acessando a URL do Packagist, pode dar uma olhada nesse projeto aqui, <https://github.com/rogeriopradoj/cntlm-proxy-windows>, lá tem mais instruções!

### Agora é só usar!

Pronto, é só reiniciar o seu Jupyter, e quando for criar um Notebook, vai ter lá a opção de escolher PHP também (além dos outros que você já tinha, tipo o Python 3).

Aqui vai um exemplo:

<figure>
    <img title="Um exemplo de Jupyter Notebook usando o kernel PHP" src="/assets/images/posts/2019-05-13-notebooks-jupyter-em-php-alem-do-python-sim-e-possivel-veja-como-fazer/13-notebooks-jupyter-em-php-alem-do-python-sim-e-possivel-veja-como-fazer-02.png" alt="Um exemplo de Jupyter Notebook usando o kernel PHP">
    <figcaption>Um exemplo de Jupyter Notebook usando o kernel PHP</figcaption>
</figure>

Se quiser testar no seu próprio ambiente, é só baixar em <https://gist.github.com/rogeriopradoj/75a7e8ba3f58734c8510bd8f42d3e335>.

É isso, pessoal!

### Mas por que usar PHP nesse mundo??? Não era para estarmos focando mais em Python, R e outras?

Acho muito que é questão parecida com o que eu via no passado quando estava bastante envolvido com comunidades e Meetups, e já ouvia assim: "poxa, Golang seria uma opção muito melhor para IA, por ser mais rápida, etc etc". Mas o Python já tinha ganhado a briga pois os algoritmos matemáticos todos já tinham sido implementados nele, e em Golang não".

Hoje, pela pesquisa rápida que fiz, Golang ainda não tem ecossistema que se compara ao de R ou Python... <https://news.ycombinator.com/item?id=16883877>. Mas, não quer dizer que não tenha suas vantagens, né?

Especificamente do PHP, quais pontos positivos acredito em também usá-lo para ML e afins, aqui lá no "Banco X":

* linguagem madura, e cada vez mais rápida desde a versão 7.0 (hoje está na 7.3): <https://kinsta.com/pt/blog/benchmarks-definitivos-do-php/>
* ótimo ecossistema, ainda ativa (e muito! ) , utilizada por diversas grandes empresas, suporte da comunidade e de muitos players, seja para integrações e também para infra
* ainda é a mais usada de toda a web (79% em 2019/MAI, <https://w3techs.com/technologies/overview/programming_language/all>)
* é uma das plataformas oficialmente homologada no "Banco X"
* tem suporte em toda a infra do "Banco X" atual (desde os servidores IIS com Fastcgi ou Linux Apache nos ambientes descentralizados, ou mesmo da infra de Openshift, Docker etc. do ambiente centralizado)
* vai permitir que os colegas que já tenham um certo domínio do PHP e seu ecossistema de usar esse conhecimento para esse novo mundo do Data Science, Analytics, IA, Machine Learning etc.

E você, o que anda fazendo aí na sua área? Bora testar mais essa opção?

O mais importante é: compartilhe o que está fazendo, assim todos podemos ganhar e a empresa também!

Até a próxima, e podem me chamar para conversar em todos os canais, ok!

Abraços!

---

Este artigo foi publicado originalmente em [RogerioPradoJ.com](https://rogeriopradoj.com/).

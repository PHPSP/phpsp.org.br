---
createdAt: 2018-10-24
title: 5 coisas que um programador PHP precisa
author: Augusto Pascutti
authorEmail: augusto.hp@gmail.com
---

Se você ganha a vida com PHP sabe o quanto sofremos por conta dos chamados "sobrinhos", se você não sabe o que estou falando, termine de ler esse post e procure no Google que você vai entender do que estamos falando! Quem foi ao "I Encontro|PHPSP" sabe que um objetivo tão importante quanto unir a comunidade é levar mais conhecimento a ela, deixando claro que o PHP deixou a muito tempo de ser uma linguagem de programação para sites e entrou no ramo enterprise! 

Onde queremos chegar com tudo isso? Simples! O mal dos sobrinhos é que logo após seu "Hello World!" eles já se consideram programadores, e logicamente, as coisas não funcionam bem assim. Inspirado [num post do Cal Evans](http://blog.calevans.com/2009/02/09/5-tools-every-php-developer-should-master/) (se você nunca ouviu falar nesse nome, google-for-it ! agora!) em que ele diz 5 ferramentas que um programador PHP precisa conhecer, nós dizemos mais: considere-se um programador somente se você conhecer PELO MENOS as cinco ferramentas abaixo! 

##5: Testes Unitários
Todo mundo bate nesta tecla, hoje temos ótimas soluções ( [PHPUnit](http://www.phpunit.de/) e [SimpleTest](http://www.simpletest.org/) ) para isso, todas muito maduras e largamente utilizadas. A vantagem de se desenvolver com o apoio dos testes de unidade ou até mesmo utilizando TDD (Test Driven Development) é notável e díficil de apresentar a quem nunca utilizou. No começo tudo pode parecer muito trabalhoso e inútil, mas com o tempo os testes unitários que você (teoricamente) "perdeu tempo" escrevendo se provam fiéis amigos do programador.

##4: Debug
Debugar um código está bem longe de sair dando "echo" pelo código ! Isso vale para as mais rebuscadas técnicas que variam dessa, como por exemplo escrever uma função específica pra isso ou controlar isso através de alguma constante e/ou variável. O debug de um código consiste em ver o que existe na memória de execução do PHP em determinado momento do script, além de possíbilitar controlar o interpretador, parando, avançando a medida que for necessário ao programador. Existem - pra variar - muitas ferramentas pra isso: [xDebug](http://www.xdebug.org/), [dbg](http://www.nusphere.com/products/php_debugger.htm), [Zend_Debug](http://www.zend.com/en/community/pdt), etc ...

##3: Modelo ER
Trabalhar com PHP invariavelmente significa trabalhar com um Banco de Dados assim como trabalhar com desenvolvimento de sistemas implica invariavelmente em constantes mudanças; é muito lógico no momento de criação de uma nova tabela a modelagem dela e os relacionamentos que ela possui dentro do sistema, mas e depois de 1 ano ? As pessoas mudam, amadurecem (ou não) e mudam o jeito de conceber as coisas, mas o banco de dados continua o mesmo e toda a lógica vai pro saco ! Por isso ter um diagrama de entidade-relacionamento do seu banco de dados pode ser crucial para o andamento de um projeto durante muito tempo, você não perde muito tempo fazendo isso e existem ainda várias ferramentas para ajudar!
( Vamos atualizar a listagem das ferramentas para auxiliar na produão de MERs com o tempo ... )

##2: Sistema de Controle de Versões
Não vamos perder muito tempo discutindo isso aqui, se você trabalha em equipe ou não, seja seu projeto gigante ou não: use! Além de manter todas as versões do seu projeto você têm um backup do código. Trabalhar com um sistema de controle de versão se equipara aos Testes de Unidade: você pode passar uma vida inteira sem eles, mas uma vez com eles, nunca mais sem eles!
Existem diversas opções, as mais famosas: [CVS](http://ximbiot.com/cvs/wiki/) (utilizado no desenvolvimento do PHP mas sendo migrado pro Subversion), [Subversion](http://subversion.tigris.org/) (mais novo que o CVS e muito semelhante a ele), [GIT](http://git-scm.com/) (feito pelo Linus Torvalds para o desenvolvimento do kernel do Linux)

##1: (Um) Framework
Esse aqui vai gerar briga, mas a briga vale a pena. Primeiro: um CMS (Joomla, Drupal, etc) não é um framework ! Nunca foram e nunca serão, este não é o propósito deles. Um framework é um conjunto de ferramentas genérico que deve servir bem um programador fazendo um site e um fazendo um sistema de gerenciamento logístico de entrega de camisinhas musicais no sertão brasileiro!
Você não precisa utilizar um framework em seus projetos, mas conhecer um ou mais frameworks ajuda em muito seu nível de desenvolvimento! Acredite: você não é o melhor programador que existe ! Existem muitos outros que pensam a mesma coisa! Um fato é que um framework possui muito conhecimento alheio agregado dentro do código, assim como muito teste em ambientes reais.
Muitos pregam que a curva de aprendizado custa demais a empresa. Ora, se a empresa fizer um sistema a partir do zero, novos desenvolvedores também terão que aprender a utilizar as coisas existentes que provavelmente terão menos padrão, menos qualidade e muito menos teste. Outro motivo latente é a performance, uma besteira nós dizemos! Existem muitas formas de se obter performance sem ao menos mexer em uma linha de código, além de que a probabilidade de um framework criado por você ser mais lento do que um existente é bem grande!
Enfim, utilizando ou não um framework no dia-a-dia; conhecer um ou mais é fundamental para o desenvolvimento profissional do programador! Existem MUITOS frameworks em PHP, vamos citar alguns:

*   [CakePHP](http://www.cakephp.org/) (Rails do PHP)
*   [Zend Framework](http://framework.zend.com)
*   [Kohana](http://www.kohanaphp.com) (baseado no [CodeIgniter](http://www.codeigniter.com) mas somente para PHP5)
*   [Symphony](http://www.symfony-project.org/)
*   [Prado](http://www.pradosoft.com/) (Event Driven Framework)

##Conclusão
Programar vai muito além de simplimente saber escrever códigos. Um programador não é a pessoa que simplismente escreve o código para máquina interpretar e executar o que ele deseja, ele precisa fazer isso de forma legível para os demais programadores além de garantir que tudo continue funcionando perfeitamente. Todos os cinco itens citados acima contribuem exatemente pra isso!
Tenha sempre em mente o que foi dito acima: você escreve para os outros e não para você! Raramente você vai escrever algo para esconder do resto do mundo, ou que não vá precisar da mão de alguém no código, mas se nada disse te convenceu, escreva os códigos pensando que o próximo que for dar manutenção no seu código pode ser um serial killer que sabe onde você mora! E outra; não existe nenhuma medida que diga seu nível em PHP. Atualmente a melhor delas é a Certificação da Zend, mas excluindo ela da lista, o que vai dizer se você é ou não é um bom programador é a opinião dos outros sobre seu código. Pense nisso na próxima vez em que você for programar!
Notem também que IDEs nem entraram nos pontos, uma porque isso é uma discussão infindável e outra porque uma IDE não vai tornar você um melhor programador, ela com certeza vai te tornar um programador mais produtivo! Então escolha bem a sua!
Contamos com suas opiniões sobre os asssuntos acima! E vamos indo rumo a des-sobrinhação  do PHP!
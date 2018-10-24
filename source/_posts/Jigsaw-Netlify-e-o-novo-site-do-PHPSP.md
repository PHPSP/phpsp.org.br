---
createdAt: 2018-10-08
title: Jigsaw, Netlify e o novo site do PHPSP
author: João Paulo
authorEmail: joao.paulo@phpsp.org.br
---

##Introdução
Recentemente fui ao [meetup](https://www.meetup.com/PHP-Dublin/) da comunidade de [PHP de Dublin](https://phpdublin.com/) onde o [Daragh O'Shea](https://www.daraghoshea.com/) fez uma interessante apresentação sobre sites estáticos.

Com a ideia de modernizar um pouco o site do PHPSP decidimos simplificar o site, tornando-o estático e tendo seu conteúdo "gerenciado" diretamente pelo GIT com todo seu conteúdo sendo feito por meio de arquivos no formato MarkDown.

Acreditamos que com isso o site ficará mais rápido e mais fácil de ser gerenciado por toda a comunidade. Não há mais a necessidade (nem a barreira) de ter conta para gerenciar o conteúdo e nem conhecimentos profindos no template utilizado para conseguir introduzir novas áreas no site.

##Site Estático?
O novo site, como mencionado, é estático. Isso significa que no momento de deploy todo o conteúdo é "convertido" em HTML e o conteúdo gerado que fica disponível para todos que acessarem o site. Ou seja, não há conexão ao banco de dados, não há um "backend", o site todo esta disponível no GitHub da comunidade e pode (e deve!) ser atualizado por todos através de um PR.

##Gerador de site estáticos - Jigsaw
Por ser uma comunidade de PHP nós optamos por utilizar um gerador de site estáticos feito em PHP, a escolha foi simples e direta! Escolhemos pelo [Jigsaw](http://jigsaw.tighten.co/), que por sua vez é baseado no [Laravel Framework](https://laravel.com/).

O Jigsaw é ao mesmo tempo simples e completo. A curva de aprendizado é rápida e o resultado fantástico.

##Servidor - Netlify
Mundialmente conhecido como uma excelente ferramenta para deploy de sites estáticos o [Netlify](https://www.netlify.com/) é super intuitivo e possui a funcionalidade de "escutar" as mudanças no repositório do site e fazer o deployment sempre que pertinente.

O Netlify ainda possui a funcionalidade de gerar previews para todos os PRs, possibilitando que o resultado final possa ser analisado antes do conteúdo se tornar "oficial".

##Exemplo
Acho que o melhor exemplo é o próprio site do [PHPSP](https://github.com/PHPSP/phpsp.org.br), veja o repositório e se tiver alguma dúvida entre no nosso [Slack](http://bit.ly/vemproslackphpsp)!

Abraços
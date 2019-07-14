---
createdAt: 2019-05-01
title: 'Case: O que fez o PODEntender migrar do Wordpress para o Jigsaw'
author: Níckolas Silva
authorEmail: nickolas@nawarian.xyz
---

Quem me acompanha sabe que há alguns meses passei a integrar a equipe do _Maior Podcast em Linha Reta da América Latina e
quiçá de Pernambuco_, o podcast de divulgação científica [PODEntender](https://podentender.com).

Este podcast - como quase todos os outros - é um projeto independente e, naturalmente, de **budget reduzido**. Que me
trouxe a encontrar um website todo fulêro em cima de **Wordpress**, vários **plugins** estranhos, um **template muito
limitado** e uma **hospedagem barata** que permitia o site cair com **15 usuários simultâneos**.

Para quem quer salvar a produção científica de um país de quase 210 milhões de habitantes, **15 usuários
simultâneos não é bem o que podemos chamar de "limite confortável"**.

# Início da análise

O site já estava pegando fogo, **nenhuma falha era novidade**. Então em vez de aplicar várias das possíveis medidas
urgentes eu resolvi primeiro observar quais eram os problemas e oportunidades que existiam.

A minha maior missão naquele momento era **evitar que o site caísse com apenas 15 usuários**. Com isto em mente
encontrei algumas falhas interessantes no site que poderiam ser rapidamente corrigidas:

- Os arquivos não eram minificados
- O template carregava 8 arquivos CSS diferentes
- Várias fontes diferentes de JS sendo carregadas
- Um dos arquivos CSS era dinâmico, gerado pelo Wordpress (e levava 3 segundos para ser gerado)
- Não havia um mecanismo de caching para as páginas geradas
- Imagens de dimensões continentais e tamanho em média superior a 1 mega-byte
- JavaScript abusivamente pesado, diversas versões de jQuery na mesma página
- Nenhum dos recursos estava num CDN e todos eram processados pelo PHP antes de serem enviados ao browser

**O site parecia um daqueles exemplos bizarros que o PokemãoBR dá em seus stand-ups**.

As tentativas de corrigir o cenário, porém, falharam miseravelmente.

**Limitações de hospedagem**, **Wordpress**, **template**, falha (falta) de **processos da equipe** interna que por
vezes atualizava o template quando atualização ficava disponível, gerando um wipe em todas as alterações manuais.
**E é claro, não havia um sistema de versionamento...**

### Primeira proposta: Utilizar o Cloudflare para caching e distribuição global

O serviço Cloudflare é muito bacana para projetos de baixo custo, pois mesmo a versão gratuita oferece funcionalidades
incríveis como minificação de arquivos, caching, gerenciamento de DNS e por aí vai.

**A intenção aqui era adicionar uma camada de caching** nos recursos `css` e `js` do site para **evitar** que todas as
bizarrices acima mencionadas **fossem requisitadas mais de uma vez ao servidor**. Desta forma eu **esperava**
que a carga no servidor diminuísse e a gente conseguisse ao menos **ver o site cair com menor frequência.**

A migração levou 10 minutos no total. E para todo IP **europeu** que utilizei pra testar em diversas ferramentas, **as
métricas estavam incrivelmente boas**. Foi felicidade instantânea!

Minutos depois recebo a **reclamação** de usuários **brasileiros** que **o site estava chorosamente lento**. Desfazer a
integração levou alguns segundos apenas, mas nada parecia fazer sentido!

**Por que cargas d'água o site ficou mais lento no país onde o servidor está!?**

Naturalmente eu não tinha acesso ao `ssh` do servidor para monitorar os logs de acesso e performance, mas pude notar que
algumas páginas foram cacheadas com o conteúdo de resposta `erro 503` padrão da hospedagem.

**O servidor provavelmente não aguentou sequer a negociação de conteúdo com o Cloudflare.**

Além disso ao acessar o painel de administração do Wordpress uma barra preta é adicionada ao topo do site normal na
navegação. Acabamos adicionando também esta barra preta no cache por acidente.

Lições da vida...

### Segunda proposta: Prover páginas estáticas para diminuir a carga e tempo de resposta

Ora, se **o processamento está condenando a nossa infraestrutura** vamos então acabar com ele! E foi com sangue nos
olhos e muita força de vontade que eu comecei a desenvolver o primeiro protótipo do projeto
[Estatista](https://github.com/podentender/estatista-deprecado).

A intenção aqui era criar um _spider_ que iria **baixar o site inteiro** e seus recursos, organizar em diretório físico
e enviar ao Github Pages para que pudessemos oferecer este conteúdo num **servidor gratuito**, de **ampla distribuição**
e que tinha **chances bem menores de cair**.

Foi um projeto de final de semana interessante e que mudou de estrutura duas vezes por uma razão simples: **péssimas
decisões de design**.

Arrastando já há algumas semanas e sem resultados concretos, **a situação do site começou a ficar cada vez mais
crítica** e quase todas **as medidas de _branding_ e _SEO_** que queríamos aplicar **estavam bloqueadas pela situação**.

### Foi quando eu revisitei o repositório do [phpsp.org.br](https://phpsp.org.br)...
O novo site do PHPSP estava não somente de cara mas de [corpo novo](/artigos/jigsaw-netlify-e-o-novo-site-do-phpsp/) e
esta nova infraestrutura do website trazia consigo um potencial de performance muito grande.

Usando como base o [Jigsaw](http://jigsaw.tighten.co/) para fazer o server side rendering o site passaria a ser gerado
já de forma estática.

Com arquivos `.html` em mãos eu poderia simplesmente publicar tudo com Github Pages e **reduzir a zero o custo de
infraestrutura** com o site, **diminuir o tempo de resposta**, distribuir o site em diversos continentes com **alta
performance** e voltar a **utilizar o Cloudflare** sem problemas.

O potencial se confirmou para mim ao testar o site do phpsp com o **Google Lighthouse**:

Uma pontuação de **93/100** no Google Lighthouse é um tanto impressionante. Considere que, no momento em que escrevo este
post, o **Facebook** atinge um score de **76/100** no mesmo teste e categoria. O **PODEntender** estava em **9/100**,
tadinho.

![Resultado do Lighthouse apresentando 93/100 em Performance](/assets/images/posts/Case-O-que-fez-o-PODEntender-migrar-do-Wordpress-para-o-Jigsaw/lighthouse-phpsp.png)

## Terceira proposta: vamos sair do Wordpress e gerar páginas estáticas!

Não me entenda mal: eu tenho várias ressalvas quanto ao Wordpress mas o vejo como uma ferramenta incrível **se bem
utilizada**.

O nosso contexto exigia uma solução menos robusta, com maior performance e custo reduzido. E de longe **não estávamos
fazendo bom uso do Wordpress**.

Inspirado pelo phpsp.org.br **decidi migrar para um gerador estático** de páginas e para uma hospedagem web que
aguentasse o tranco.

A decisão natural seria utilizar o Github Pages e, com ele, o gerador de sites `Jekyll` (ruby),
pois já possui diversas integrações interessantes com este serviço.

Ao mesmo tempo, o site do phpsp estava iniciando sua reformulação e precisaria de auxílio. O site acabou optando por uma
ferramenta em php **menos integrada** e com **menor variedade** (por enquanto) **de plugins** disponíveis: o Jigsaw.

Sem sombra de dúvidas decidi então seguir a deixa: o que eu desenvolver ao PODEntender será potencialmente útil
ao phpsp. E assim a gente caminha juntos. 😉

# E assim seguimos

Quatro meses depois renovando layout, migrando conteúdo, ajustando bugs, tomando certeza de que todas nossas integrações
continuariam funcionando e um mês de beta testing, o [novo site do PODEntender](https://podentender.com) está no ar.

Os desafios que encontramos pelo caminho foram um tanto interessantes: de recuperar links do Google que apontavam a
páginas antigas até manter o feed compatível com a versão anterior para o iTunes e Spotify. Com total certeza irei
apresentar os problemas e soluções encontradas!

Como não poderia deixar de ser, preciso encerrar este texto com métricas felizes!
O site saiu de beta e entrou em produção há uma semana, coletou apenas elogios e atingiu a marca de **98/100** na
métrica de performance do Lighthouse. Além de termos tido a oportunidade de corrigir o template para alcançar
**100/100** em todas as outras métricas: Acessibilidade, Melhores Práticas e SEO. O _First Contentful Paint_ que antes
batia 15 segundos, agora se resolve em 0,8 segundos. 

![Resultado do Lighthouse apresentando 98/100 em Performance](/assets/images/posts/Case-O-que-fez-o-PODEntender-migrar-do-Wordpress-para-o-Jigsaw/lighthouse-podentender.png)

Com total certeza ainda temos muito o que melhorar no projeto do podcast: funcionalidade, layout, seo. Mas o primeiro
passo foi concluído e agora, sem que o website esteja em chamas, o PODEntender passa a caminhar junto do phpsp.org.br,
propondo, desenvolvendo e compartilhando plugins e corrigindo problemas específicos da nossa plataforma.

Se você estiver curioso(a) em como os nossos sites foram desenvolvidos ou tiver qualquer sugestão de melhoria, dá uma
olhadinha no novo [repositório do estatista no PODEntender](https://github.com/podentender/estatista) e no
[repositório do blog phpsp.org.br](https://github.com/PHPSP/phpsp.org.br). Ambos projetos estão abertos no Github e
contentes em receber a sua contribuição.

Um xêro muito grande a todos e até a próxima!

---
createdAt: 2020-03-03
title: PHPSP + PUB Fevereiro 2020
author: José Filho (Zé)
authorEmail: jose.filho@phpsp.org.br
---

Pra quem não conhece o PHPSP + Pub é o evento mais antigo da comunidade PHPSP, acontece (sem falta!) toda segunda quinta-feira do mês e já estamos indo para o oitavo ano de evento o/

No dia 13/02/2020 aconteceu a segunda edição do PHPSP + Pub do ano, no bar Laje 795, onde há aproximadamente 2 anos temos hosteado nosso evento numa parceria muito massa com o João! Tivemos casa cheia mais uma vez graças a uma galera maravilhosa que tornou o evento muito produtivo!

O PHPSP + Pub segue a dinâmica do  [Shark Bowl](https://github.com/duodraco/shark-bowl)  onde a ideia é coletarmos assuntos com os participantes, organizar um bate-papo interativo onde cada assunto tem um tempo pré determinado para ser discorrido e a ideia é que todos consigam participar das discussões, sem certo ou errado, sem júnior ou sênior!

O objetivo é compartilhar a experiência e enriquecer a dinâmica. Nesta edição tivemos assuntos muito bacanas e que vale a demais ser compartilhado.

Cada assunto que rolou, sem sombra de dúvidas, valeria por sí só um post dedicado! A ideia é trazer um resumão (bem resumão mesmo) do que rolou, não vou conseguir entrar a fundo em nenhum assunto aqui mas assim quem não pôde ir pode ao menos levantar os tópicos que a comunidade vem discutindo, quem não conhece pode ter uma idéia de como é o evento e quem conhece e faltou pode se arrepender de ter perdido uma roda de discussão muito massa!

**Espero te ver no próximo!**

## Trabalho remoto

Um dos assuntos mais hypdos do momento é o trabalho remoto e é claro que nós da comunidade PHP também estamos bem por dentro disso! Um camarada que não se identificou (caso você não saiba, se por algum motivo alguém tiver com vergonha ou coisa do gênero permitimos que contribuam para a discussão de forma anônima! E neste caso em especial me lembro que foi um homem que depois se identificou) lançou a seguinte pergunta para inicar nossa dinâmica nesta edição de fevereiro: **Prós e contras de trabalhar remoto. Pra empresa e pro funcionário.**

A parte bacana dessa pergunta é que nesta edição tinhamos algumas pessoas que trabalham 100% remoto, algumas que trabalham remoto parcial e também tinhamos gente de RH no evento! Então já deu pra ver que a discussão foi bem rica, né?

Aqui tivemos pontos bem diversos, um dos amigos que colaborou com a discussão contou como pra ele foi ruim não trabalhar remoto (ele sempre trabalhou remoto na carreira de TI) e como estar no escritório o tornava menos produtivo. Houve quem defendeu que o ideal seria trabalhar parcialmente remoto e apontaram algumas vantagens dessa abordagem como *flexibilidade para escolher não ir para o escritório em dias difíceis (como os de chuva intensa que temos tido por exemplo)*, *flexibilidade de  horário* entre outros. Um ponto bacana é que ao mesmo tempo que alguns defendiam que home office os ajudavam na questão da concentração outros acreditavam que home office piora a concentração... Ou seja, não tem bala de prata! O que funciona pra um não funciona pra outro e isso é totalmente normal, na minha opinião essa divisão foi o que tornou o papo mais rico!

## Microserviços

Já que o negócio é hype, esse não poderia faltar, certo? 

Nosso amigo *Davi* introduziu o assunto **por quê NÃO usar microserviços?** E a parada ficou muito legal daqui pra frente!

Para alguns pode não estar muito clara a real necessidade de implementar uma arquitetura baseada em microserviços e ultimamente temos visto muito conteúdo sobre como X, Y e Z e teremos microserviços no ar. Este assunto foi muito interessante pois proporcionou uma visão do outro lado da parada e explicar os motivos de não se utilizar essa abordagem.

O pessoal engajou bastante no assuto, citaram os [doze fatores]([https://12factor.net/pt_br/](https://12factor.net/pt_br/)) como *guideline* e enfatizaram bastante a utilidade da arquitetura monolítica bem como as dores de cabeça que podem ser criadas sem necessidade ao migrar de uma arquitetura para a outra sem um bom motivo aparente.

Essa foi uma discussão que durou bastante e com certeza vale um artigo só pra isso com os *insights* que a galera deu então  não vou me estender muito por aqui, mas se tu não foi já deu pra ver que perdeu uma baita aula de arquitetura!

## Sobre a contribuição de um júnior para a equipe

Nas últimas edições temos tido um público novo na área atendendo ao evento e essa galera nova tá muito na pegada! Sempre trazendo assuntos bacanas e dá pra ver que o pessoal tá evoluindo muito rápido e aproveitando pra ter apoio da comunidade. Uma pessoa que não se identificou deixou uma pergunta que levantou uma discussão muito legal: **Como um júnior pode contribuir melhor a uma equipe?**

No começo o pessoal estava muito apegado a palavra "júnior" e lançaram umas dicas mais gerais de evolução na carreira (não que isso não seja importante) mas logo desapegaram desse contexto de cargo e passaram a discutir sobre contribuição de forma geral.

Foi legal ver a galera com mente mais aberta explicando que não deveria importar o nível técnico de uma pessoa para que faça uma contribuição com as equipes e que não existe "melhor ou pior" neste momento e toda contribuição é válida. O papo foi pendendo mais para o lado organizacional, onde a organização no geral deveria fornecer espaço para que todos se sentissem iguais ao apresentar qualquer tipo de solução seja ela técnica ou não.

Eu particularmente concordo muito com essa ideia e todos deveriam ter espaço pra dar seus pitacos e receber feedback sobre eles ao invés de serem reprimidos por conta de tempo de experiência. Já vi júnior com muito mais vontade de fazer acontecer que vários sêniors por aí e a organização não vai ganhar nada reprimindo essa pessoa e na real é bem o contrário, só tem a perder.

Pra fechar o pessoal elogiou o fato de alguém mais "júnior" estar preocupado assim com a equipe e querer fazer mais parte -pra melhor- dela. Que sirva de exemplo pois todos só têm a ganhar!

## Banco de dados

Com tanta abstração por aí, sejam elas ligadas a frameworks ou não, nem sempre nos preocupamos com o banco de dados já que tudo pode ser feito "por baixo dos panos" pra nós ao escrevermos algumas linhas de código. Acontece que quando estamos falando de banco de dados a coisa pode ficar feia se não dermos uma atenção aqui e foi neste sentido que uma pessoa lançou a dúvida **(ORM) Query Builder ou Query RAW ? Otimização de queries complexas.**

Um dos pontos específicos da dúvida era que muitas vezes o query builder por ser mais genérico pode ser que não monte a query da forma mais performática ou que podemos cair no conhecido problema do [N+1]([https://pt.stackoverflow.com/questions/307264/o-que-%C3%A9-o-problema-das-queries-n1](https://pt.stackoverflow.com/questions/307264/o-que-%C3%A9-o-problema-das-queries-n1)) ao utilizá-los. O pessoal discutiu bastante sobre isso mas alguns pontos importantes foram levantados como por exemplo que a maioria dos problemas de performance serão resolvidos no lado do banco e não no código backend, como indexes bem definidos, tabelas normalizadas etc. Sobre o problema do N+1 foi citado que hoje os ORM de mercado possuem soluções nativas para este problema, basta que saibamos quando estamos enfrentando o mesmo. Houveram também os que defendessem as raw queries por questão de se ter mais controle sobre como as coisas estão sendo executadas no banco, sem passar por "mágicas" que passam desapercebido.

Ambos os casos tem seus prós e contras, a discussão correu bem em torno disso e geral curtiu bastante. Eu particularmente acho bacana para mostrar pra galera o que as vezes os frameworks escondem pra gente mas em determinado momento será importante saber como tocar nisso e é mais bacana ainda ver a comunidade bem engajada!

## Foco e concentração

Vejo muito artigo por aí falando sobre técnicas para nos mantermos focados, como comer, como dormir, como pessoas bem sucedidas devem seu sucesso ao foco que têm mas e nós? Como nós mortais ficamos no dia-a-dia?

É muito comum encontrar material de pessoas que atingiram a fórmula para o "foco absoluto" que só funcionam pra elas, é mais comum ainda ouvir relatos do quão performático fulano é utilizando de X técnica mas quando vamos ver só obtemos o contrário.

Neste sentido eu introduzi uma pergunta pra galera sobre **Blackouts, perda de foco etc. Algo comum ou corpo mole?** E minha ideia era ver como a galera lidava com isso, eu particularmente sofro com muitos blackouts no dia enquanto estou na frente do editor de texto e queria saber se a galera acha comum ou corpo mole.

O objetivo principal -que era mostrar que é normal perder o foco durante a jornada de trabalho- foi atingido logo de cara quando muita gente se identificou com o cenário e disse ser normal. Quando o assunto foi progredindo surgiram ideias de que apesar de ser normal, é normal até certo ponto... Foi falado sobre como a motivação no que estamos fazendo, o stress do dia-a-dia e o conhecimento técnico sobre aquilo somos designados a fazer afeta no foco.

É claro que existem casos em que realmente a pessoa pode vir a ter um problema de concentração mesmo (como quem tem TDAH por exemplo) e se for muito recorrente é bom visitar um médico e entender melhor. Mas num geral foi bem bacana porque vejo muito o pessoal falando em como ser super-heróis e atingirmos super resultados mas poucos falam sobre como sermos reles mortais que sofrem com falta de foco as vezes.

## Processos seletivos

Nesta edição tivemos a felicidade de contar com pessoas não desenvolvedoras e isso é massa demais pois enriquece ainda mais as discussões e nos traz uma perspectiva diferente de "fora da nossa bolha" para as coisas. A Thais que é responsável pelo RH de sua organização se fez presente nesta edição e como ela (assim como muita empresa) está contratando pessoas desenvolvedoras e com uma certa dificuldade de encontrar essas pessoas, lançou a pergunta **Qual a sua motivação para participar de um processo seletivo?**

Aqui ouvimos de tudo e quando digo de tudo é de tudo mesmo!

Foi bacana ver que boa parte da comunidade está bastante preocupada com os desafios e cultura das organizações acima de salário, localidade e liberdade com horário e home office foi um ponto bastante levantado também mas também houveram os que defendiam salários mais altos.

O importante foi mostrar que não há certo nem errado e está no lado da organização ponderar o que ela (a organização) pode ou não fazer no momento. Foi interessante mostrar que é totalmente normal aquele profissional que está num momento mais interessado em aumento de capital e que provavelmente largará sua organização quando receber uma proposta maior que lhe faça sentido e também que é normal um candidato não querer ir pra sua empresa por esbarrar em questões de cultura. O mercado está olhando e dando espaço pra todos esses pontos.

Pode parecer mais simples mas esse tipo de questionamento é muito importante para a comunidade como um todo e seria interessante que mais pessoas desta área (recrutamento, rh etc) participarem mais dos eventos e se aproximarem mais da comunidade pois todos têm a ganhar muito com isso. A comunidade está sempre aberta para este público e de qualquer outra área também!

## Testes automatizados

Como não poderia faltar em uma boa roda de discussão sobre desenvolvimento de software eu introduzi a seguinte pergunta referente a testes: **Por que você não testa sua aplicação de forma automatizada?** E aqui minha ideia era muito na linha de entender os motivos de a galera não utilizar técnicas de automação de teste.

Foi bom porque muita gente quis participar (se não me engano quase todo mundo falou presente falou) e o ponto mais levantado foi que *testes automatizados aumentam o tempo de desenvolvimento*, houveram também os que defenderam que não o faziam por questão de nível técnico mesmo como não conhecer ferramentas e também as pessoas que não viam a necessidade de tal prática.

A conversa foi caminhando para um lado bem legal e o pessoal explicou sobre o que seriam testes automatizados, os tipos de testes mais comuns e sobre a pirâmide de testes (unitários > services > ui). Houve tempo (mesmo que breve) para explicar algumas vantagens de tal prática e a parte que eu mais queria chegar que era sobre testes não aumentarem o tempo de desenvolvimento e sim que eles são parte do tempo de desenvolvimento.

Com certeza essa é uma das questões mais discutidas nos nossos eventos e nessa edição em especial o papo foi muito rico e espero que bastante gente tenha aproveitado. Caso queira saber um pouquinho sobre uma das práticas de desenvolvimento com testes temos um artigo bem legal [aqui]([https://phpsp.org.br/artigos/tdd-com-php-na-vida-real/](https://phpsp.org.br/artigos/tdd-com-php-na-vida-real/)) no nosso blog além de bastante conteúdo já feito pela comunidade em alguns eventos gravados e que estão no youtube!

## Menções honrosas

Infelizmente nosso evento tem hora pra acabar =/

Ainda tínhamos bastante assunto interessante mas chegou a hora de encerrar, só pra você ter ideia, a galera ainda queria falar de:

-   SOLID, como vocês aplicam nos seus times?
- Métricas de qualidade de entrega, o que usar?
- Como funciona o feedback na sua empresa? Tem ? Não tem? Como deveria ser?
- Como ser feliz trabalhando com programação? Quais variáveis fazem um Dev feliz em uma empresa?
- Como é o processo de code review na empresa de vocês?
- Como você Dev está se preparando para o LGPD? 
- O que é PHP Internals? E como contribuir com o PHP Core?

É tanto assunto massa que dá até vontade de ter mais de uma edição por mês, falaí!?

Vale lembrar que os assuntos são ordenados pelas pessoas que estão atendendo ao evento, no aplicativo do sli.do o pessoal vai votando nos assuntos e os chamamos para discussão da ordem do mais votado pelo menos votado então por isso alguns assuntos ficam de fora.

Com certeza no próximo encontro teremos assuntos tão bacanas quanto e tentaremos encaixar alguns que ficaram de fora de edições anteriores mas que são super interessantes.

Nossa próxima edição tem  [data](https://www.meetup.com/pt-BR/php-sp/events/qsnlkrybcfbqb/) confirmada e tomara que depois dessa tu não queira ficar de fora. Então corre lá e se inscreve!

Em nome da comunidade gostaria de agradecer a todos que participaram do evento e dizer que vocês são  **foda demais**  e tornaram o encontro um sucesso!

Até a próxima.
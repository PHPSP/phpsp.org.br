---
createdAt: 2018-10-17
title: Ágil passado a limpo
author: Anderson Casimiro
authorEmail: duodraco@gmail.com
---

Salve! Já ouviu falar de Scrum? E XP? Kanban? Estes são nomes de práticas ágeis de desenvolvimento de software. A bem da verdade alguns nasceram bem antes de começarmos a usar o termo Ágil para tal. Já havia a preocupação de otimizar os processos de desenvolvimento de software desde 1959 com os Métodos Iterativos e Incrementais e posteriormente com o Desenvolvimento Adaptativo. Várias práticas foram criadas, aprimoradas e discutidas que culminaram no Manifesto para o Desenvolvimento Ágil de Software em 2001.

Autores de diversas práticas já comuns à época, como Jeff Sutherland, Ken Schwaber e Bob Martin assinam essa declaração pública sobre das bases comuns de seus próprios métodos. O Desenvolvimento Ágil tem por definição quatro valores nos quais os autores descrevem de maneira simples a importância de cada peça no processo de desenvolvimento, denotando a valorização dos itens marcados com ênfase a seguir:

* **Indivíduos e interações** mais que *processos e ferramentas*: embora seja importante que as equipes de desenvolvimento trabalhem com processos bem definidos e possuam ferramental adequado, de nada adianta se não houver pessoas motivadas a trabalhar no projeto e que a comunicação entre as mesmas não seja a mais fluída e transparente possível
* **Software em funcionamento** mais que *documentação abrangente*: documentação é importante sim, mas é inútil sem o software descrito nela. O que muitas equipes ignoram é o fato de que existe alguma possibilidade de uma documentação estar de fato completa sem o projeto ter sido aplicado — principalmente considerando o movimento imprevisível do mercado.
* **Colaboração com o cliente** mais que *negociação de contratos*: este é um dos pontos mais polêmicos do manifesto. Enquanto que para gestores de projetos tradicionais os contratos bem estabelecidos sejam a garantia de “entrega do que o cliente pediu” é a contínua colaboração entre o time de desenvolvimento e a representação do cliente, seja por meio de uma pessoa nesse papel, seja por constantes pesquisas ou qualquer outro meio, que de fato permite a geração de valor no projeto.
* **Responder a mudanças** mais que *seguir um plano*: ter um norte é fundamental. Mas, considerando o avanço tecnológico e o já citado movimento de mercado, é impossível ter um plano seguro e imutável de longa data. Por isso, os agilistas preferem ciclos curtos de entregas para repriorizarem e replanejarem seus projetos a fim de adaptarem-se melhor a essas mudanças.

Você pode vislumbrar estes valores nos 12 princípios que fundamentam o Manifesto Ágil:

* Nossa maior prioridade é **satisfazer o cliente** através da entrega contínua e adiantada de software com **valor agregado**.
* **Mudanças nos requisitos** são bem-vindas, mesmo tardiamente no desenvolvimento. Processos ágeis tiram vantagem das mudanças visando **vantagem competitiva** para o cliente.
* **Entregar frequentemente** software funcionando, de poucas semanas a poucos meses, com preferência à menor escala de tempo.
* Pessoas de negócio e desenvolvedores devem **trabalhar diariamente em conjunto** por todo o projeto.
* Construa projetos em torno de **indivíduos motivados**. Dê a eles o ambiente e o suporte necessário e confie neles para fazer o trabalho.
* O método mais eficiente e eficaz de transmitir informações para e entre uma equipe de desenvolvimento é através de **conversa face a face**.
* **Software funcionando** é a medida primária de progresso.
* Os processos ágeis promovem **desenvolvimento sustentável**. Os patrocinadores, desenvolvedores e usuários devem ser capazes de manter um ritmo constante indefinidamente.
* Contínua atenção à **excelência técnica** e **bom design** aumenta a agilidade.
* **Simplicidade**, a arte de maximizar a quantidade de trabalho não realizado, é essencial.
* As melhores arquiteturas, requisitos e designs emergem de **equipes auto-organizáveis**.
* Em intervalos regulares, a equipe reflete sobre **como se tornar mais eficaz** e então refina e ajusta seu comportamento de acordo.

Obviamente essa iniciativa também aprimorou os métodos existentes por meio da colaboração entre seus autores e abriu espaço para que mais práticas fossem criadas, baseadas no manifesto ágil. De longe o maior expoente dentre os diversos métodos ágeis é o Scrum, seguido pelo Kanban.

---

## Scrum
O Scrum, criado em 1995 por Ken Schwaber e Jeff Sutherland, coautores também do Manifesto Ágil. O nome veio de um movimento do jogo de Rugby onde o time se concentra antes do próximo avanço em campo e foi atribuído pela primeira vez ao desenvolvimento de projetos ainda em 1986. É considerado por seus entusiastas um framework que, com a experiência em sua utilização, possibilita a própria evolução ao longo do tempo, adaptando-se a realidade do time, empresa, mercado e época. Este método é descrito hoje como ferramenta para evolução contínua de produtos, não especificamente de software, o que abre sua utilização a um leque mais extenso de aplicações.

Basicamente, o Scrum elenca que todos os itens que compõe o valor do produto devem ser descritos o mais atomicamente possível formando o que chamamos de Product Backlog. As pessoas no papel de Product Owner (P.O. ou Dono do Produto) são responsáveis por manter essa lista atualizada e priorizada, levando para o topo os itens mais importantes e mais ricos em detalhes. Em ciclos regulares, normalmente de duas semanas, o Time de Desenvolvimento se reúne com o Scrum Master para elencar quais dos itens no Product Backlog eles se comprometem a adicionar no produto até a próxima reunião — chamada de Sprint Planning. Sprint, que também é um nome vindo do Rugby, é exatamente esse período no qual o time desenvolve um conjunto de itens que agregam valor ao produto. Durante o Sprint o P.O. trabalha no refinamento do Product Backlog priorizando os itens que o projeto deveria receber no próximo Sprint. O Scrum Master é responsável para que esse processo ocorra mantendo P.O. e Time alinhados, garantindo que o P.O. entenda o progresso do produto, que o time saiba bem o que deve ser feito e que o processo torne-se cada vez melhor a cada iteração.

Essa prática é amparada por duas entidades: a Scrum Alliance e o Scrum.org no que diz respeito a treinamentos e certificação oficiais. Enquanto que a primeira enfoca em uma “carreira” na educação do Scrum a segunda é focada na constante atualização e certificação. Nenhuma delas representa, de fato, o Scrum, ficando os autores de fato com esse papel.

## Kanban
Aqui precisamos fazer uma desambiguação, pois Kanban hoje é um nome para muitas coisas:

1. 看板: palavra em japonês que significa quadro de avisos ou outdoor
2. Metodologia criada por Taichi Ohno que intenta em mostrar de maneira clara e visual o processo produtivo e onde cada novo produto, ou parte dele, se encontra no fluxo; sim, como você deve bem ter imaginado é usado um Kanban como o do item 1 para tal.
3. Aplicação dessa metodologia no contexto de desenvolvimento de software. Em seu livro de 2010, Kanban, David Anderson descreve a evolução da aplicação do método de Taichi em projetos nos quais trabalhou
Kanban, no contexto de desenvolvimento de software, tem por objetivo fundamental manter de maneira clara e objetiva para qualquer pessoa interessada no projeto o status corrente do mesmo. O famoso quadro, usado de maneira simplista por alguns praticantes do Scrum, deve apresentar de maneira tabular todo o processo de desenvolvimento, desde a concepção de ideias, passando pelo refinamento, design, codificação e testes até a publicação (deploy) do mesmo. Dentre os itens mais importantes está a definição de represas: as diferentes fases, representadas pelas colunas no quadro, não devem exceder um determinado número de itens, representados pelos famosos cartões adesivos, para que justamente as pessoas responsáveis naquela fase não se sobrecarreguem. Quando a tarefa em determinada fase é concluída, ela é movida para a coluna correspondente na sua nova fase no fluxo.

---

Metodologias Ágeis, apesar do nome ser ligado a velocidade, muito pouco tem a ver com ela. O Manifesto basicamente descreve itens (ou mantras) que nos tornam mais preparados para possíveis mudanças, evitam impactos negativos causados por conflitos e nos permitem evoluir como parte do processo, como profissionais e como pessoas. Tanto que justamente essa preparação para mudanças nos traz as melhores práticas de trabalho, por vezes alcançadas pela mistura de mais de um método: Um time pode trabalhar em Scrum, usando Kanban, em regime de Pair Programming (uma das práticas do eXtreme Programming, outro método ágil) e descrevendo seus entregáveis numa linha de Conversational Development (assunto para outro dia ;) ).

—

(este post foi publicado originalmente na Biblioteca TOTVS com o título [Entenda o desenvolvimento ágil de software](https://www.totvs.com/biblioteca/artigos/metodologia-agil)).

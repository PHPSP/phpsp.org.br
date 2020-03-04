---
createdAt: 2020-02-03
title: Ciclo de Feedback no Desenvolvimento de Software Guiado a Testes
author: José Filho (Zé)
authorEmail: jose.filho@phpsp.org.br
---

Ciclo de Feedback para desenvolvimento de Software guiado a Testes

Feedback apesar de ainda -ao meu ver- não ser tão praticado no mercado brasileiro de desenvolvimento de Software
é o ponto chave para um desenvolvimento com qualidade, seja ele a nível técnico, de gestão ou pessoal.

Hoje vamos falar sobre os feedbacks que nosso próprio código pode nos dar sobre nosso trabalho enquanto pessoas desenvolvedoras de Software.

Bom, muito provavelmente não fui eu quem inventou o nome *Ciclo de Feedback para desenvolvimento de Software* mas estou adicionando o *guiado a Testes*. Legal mas o que isso quer dizer? Quer dizer que, quando trabalhando no desenvolvimento de uma tarefa qualquer, que seja guiada a testes, nós temos que trabalhar em cima do feedback que os testes nos trazem e não com o pensamento de que temos apenas que codar a feature e adicionar testes para garanti-las. Realizar uma tarefa guiada a testes com esse pensamento é disperdiçar boa parte do potencial da abordagem do TDD.

## Benefícios do TDD

Desenvolvimento guiado a testes tende a trazer diversos benefícios a nossa code base, por exemplo:

I) Melhor design da nossa aplicação:
 - Quando estamos falando de OOP, aplicar TDD irá guiar o design das nossas classes/interfaces. Se por acaso está difícil testar aquele método safado que você queria colocar um `new Classe()` dentro do método, é o seu teste te dizendo: tira esse `new` daí, rapaz! E a partir daí você irá refatorar (espero eu!) seu método para algo menos acoplado.
Viu só? O teste guiou nosso design!

II) Documentação viva:
-  Seus testes, em teoria, deveriam formar uma espécie de documentação para seu software. E porque "viva"?
Bom, eu particularmente nunca vi morto dar feedback muito menos quebrar! E pode ter certeza que hora ou outra seus testes irão fazer ambos!

III) desenvolvimento guiado a testes pode antecipar desastres e provem feedback contínuo:
 - Rodar sua suíte de testes toda vez que você termina de escrever sua última linha de código (e seus testes atuais estão passando) podem antecipar desastres como: exibir interfaces que foram violadas com a nova implementação; apontar falsos positivos (eu falei pá tu não confiar naquele teste!) etc...
Neste artigo a ideia é focar justamente nos feedbacks que seus testes trazem continuamente, por isso proponho a fase de planejamento ao final de cada ciclo de iteração do TDD.

O que seria esse ciclo? Ótima pergunta!

Bom, um ciclo é definido pelo ato de realizar tarefas e quando atingimos o ponto de final desta tarefa iniciamos novamente o movimento do começo, realizando
movimentos cíclicos.

Para falar bonito, vamos pegar um gancho com o nosso amigo **Kris Philippaerts** logo em sua primeira resposta a uma entrevista concedida à *infoQ* em maio/2015.
```
InfoQ: Você pode nos explicar o você que quer dizer com ciclos de feedback no Scrum?

Kris Philippaerts: Ciclos de feedback no Scrum, ou em qualquer outro processo empírico, 
são períodos curtos de tempo recorrentes em que uma quantidade limitada de trabalho/informação é processada.
Ao final de cada ciclo, paramos de trabalhar e nos permitimos inspecionar o trabalho e melhorar o processo para o próximo ciclo. 
Um exemplo típico de ciclos de feedback é o ciclo de qualidade de Deming: Plan-Do-Check-Act (PDCA).
```
*Pô Zé, mas aí você está falando sobre Scrum e eu vim ler sobre testes, cara!*

Calma rapaz, vamos transpor isso para nosso cenário de pessoas praticantes de TDD!

**PS: Recentemente nosso amigo [@nawarian](https://twitter.com/nawarian) escreveu sobre TDD [aqui](https://phpsp.org.br/artigos/tdd-com-php-na-vida-real/) no nosso blog! E lá ele explica muito bem sobre o ciclo do TDD, então não irei me repetir aqui, corre lá e vorta cá depois!

Vamos focar nesta parte *"...períodos curtos de tempo recorrentes em que uma quantidade limitada de trabalho/informação é processada.
Ao final de cada ciclo, paramos de trabalhar e nos permitimos inspecionar o trabalho e melhorar o processo para o próximo ciclo..."*

Fez mais sentido agora? Vamos usar o ciclo PDCA aplicado ao TDD então.

## O ciclo PDCA e sua aplicação no TDD

Quando seguimos os passos do TDD (red -> green -> refactor) estamos nos encaixando em Do (fazer), Check (conferir), Act (refactor). E a partir de agora, ao invés de sairmos escrevendo testes igual doido, só pra passar aquele pedacinho de código que pensamos em implementar, vamos usar o **Plan** antes (e consequentemente depois também, afinal, é um ciclo).

*Não vou entrar na questão de planejamento de tasks pois não é o foco do artigo mas recomendo fortemente ao menos uma leitura sobre o assunto*

Ao planejar nossa task, vamos tentar pensar em como ela se comportará em acordo com nosso ecossistema, quais efeitos colaterais posso estar produzindo ao escrever esse trecho de código, se estou fazendo uma manutenção como vou facilitar para o próximo a manter esse código etc etc.

Feito isso passamos para o planejamento do nosso código em sí e no nosso caso começando pelos testes. O ciclo red -> green -> refactor não mudará em nada, minha proposta é:
a cada iteração deste ciclo - ao invés de apenas voltar para o testes na hora do refactor - pare um pouco e planeje novamente, tente olhar um pouco mais de fora e entender o que essa adição de código fez com seu sistema e NÃO RODE APENAS O TESTE DAS CLASSES QUE VOCÊ ESTÁ IMPLEMENTANDO AGORA! Ao fazer isso você está atrasando o feedback de alguma merda que deu!

Neste planejamento desconfie dos seus testes e dos testes da sua suíte! Passou tudo? Tente dar uma olhada ao redor e veja se a cobertura e testes está realmente cobrindo possíveis casos de bug ou estão só testando aquele ```$this->assertEquals(1, 1)```.

Na fase de planejamento é onde podemos aproveitar todo o potencial do TDD pois podemos olhar com calma os resultados das fases anteriores e começar a agir novamente (neste caso: Do): Será que preciso refatorar este namespace? Será que ficou claro o que estou fazendo aqui? Meu teste está de alguma forma documentando essa parte do sistema? Faça esse tipo de pergunta na fase de planejamento e serás mais feliz futuramente.

## Por que adicionar mais uma etapa a um ciclo já "bem definido"?

Mas porque trazer esta abordagem para o desenvolvimento guiado a testes? Simples!

Nos últimos anos tenho visto muito conteúdo sobre testes e pouco sobre os reais benefícios do testes... Isso me fez perceber que tem muita gente fazendo testes por fazer, para cobrir aquele trecho de código que nem ele mesmo acredita que tá certo e precisa de um teste pra dizer isso!

Parece grosseria mas é verdade, o desenvolvimento guiado a testes não é apenas para adicionar no seu CI um relatório com gráfico bonitinho de coverage alto e sim pra guiar seu desenvolvimento, caraio! Então use este potencial!

O ciclo mais conhecido como red -> green -> refactor (na minha opinião) ficou muito viciado e estamos apenas "codando igual loucos", quando vemos o teste ficando verde ao invés de voltarmos ao refactor e fazer a parada direito muitas vezes deixamos lá daquele jeito pra não ter mais trabalho.

## Conclusão

Adicione uma fase extra de planejamento no seu ciclo de desenvolvimento guiado a testes e melhore de fato sua code base!

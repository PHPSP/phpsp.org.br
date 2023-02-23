---
createdAt: 2020-02-20
title: 5 dicas para escrever um bom bug report
author: José Filho (Zé)
authorEmail: jose.filho@phpsp.org.br
---

No artigo anterior comentei sobre adicionar a cultura de QA em uma organização, caso não tenha visto da uma conferida [lá]() e espero que possa ter te ajudado em algo!

Uma coisa que comentei no artigo anterior mas que pode ser explorada melhor é a questão do bug report. Então além de explicar rapidamente o que é um bug report, aqui vão 5 dicas para escrever um bom bug report e diminuir suas tretas com o desenvolvimento!

**Lembrando que não é só porque você não é um QA que não deva saber escrever um bom bug report! Na nossa jornada em TI os bugs serão sempre presentes e nada melhor que algumas diretrizes pra qualquer um poder lidar melhor com a forma que esse bug deve ser apresentado.

## O que é um bug report

Um bug report (relatório de erro) nada mais é que um descritivo sobre alguma anomalia encontrada durante a utilização de uma ferramenta qualquer. Nele estarão contidas as informações necessárias para reprodução do bug, cenário esperado e possível correção.

Neste documento (teoricamente) estarão contidas todas as informações necessárias para sua trativa além de servir como uma documentação do estado de saúde da aplicação, ou seja, este documento é importante não só para elaborar uma tratativa mas também para manter status de qualidade, reter métricas e prover rastreabilidade.

Agora que você sabe o que é (ou deveria ser) um bug report, se liga nas dicas para escrever um bom report!

1.  Um report deve ser reproduzível

> Não servirá de muita coisa um report ser feito e o time de desenvolvimento não conseguir reproduzir o comportamento para poder pensar em tratativas. Defina com a equipe de qualidade como estruturar o passo-a-passo para a reprodução do bug encontrado e uma vez definido escrevá-lo sem no report sem dó!
> É importante que neste momento seja descrito com detalhes o estado da aplicação, como o erro aconteceu, detalhes da versão dos dispositivos em que o bug acontece (ex: IE 9, android 4.4 etc)

2. Relate o comportamento atual e o esperado

> É muito comum encontrar tickets com a mensagem "pagamento não funciona" e nada mais... Este tipo de mensagem só pode agregar uma coisa: retrabalho! 
> O time de desenvolvimento obrigatoriamente terá que ou contatar a qualidade ou sair testando os fluxos de pagamento para entender o que não está funcionando de fato, ou seja, um report desse só gera mais trabalho ao invés de gerar um artefato útil para a tratativa do bug.
>  Procure sempre detalhar o comportamento atual para o desenvolvimento e também relatar qual o comportamento esperado para o desenvolvimento poder guiar sua tratativa com uma base sólida do que se espera.

3. Um bug por report

> Se eu pudesse dar apenas uma dica, seria essa! 
> Enquanto desenvolvedor posso afirmar que é terrível receber uma listinha de bugs num card e cuidar de tudo como se fosse uma coisa só. Procure organizar os bugs de forma que fique um bug por relatório/atividade pois desta forma o desenvolvimento terá um foco maior e até melhorará a rastreabilidade deste bug futuramente. 
> Em casos específicos um bug pode estar relacionado a outro, neste cenário não vejo problema em ter mais de um bug por atividade mas procure pensar com carinho se não seria possível tratar cada um isoladamente.

4. Use sempre o build mais atual e evite duplicidade

> É muito comum um report que foi testado em um ambiente que ainda não está atualizado, criar o report e quando o desenvolvimento vai olhar este bug já foi tratado no build atual, principalmente se existe a cultura de priorização de bugs! 
> Outra coisa comum de acontecer é report de bug que já foi reportado anteriormente, ao invés de fazer um novo report procure atualizar o antigo (se for necessário) e dependendo até aumente a prioridade. 
> Quando for executar uma bateria de testes de forma preventiva ou estiver "caçando" bugs busque sempre utilizar a versão mais atual da aplicação e dê uma passada nos reports já abertos para evitar este comportamento.

5. Use fatos e evite personificações

> Ao reportar um bug procure sempre se utilizar de fatos que aconteceram durante a fase de descoberta deste bug, procure não ser opinativo e lembre-se das dicas 1 e 2! 
> Evite ao máximo "dar nome aos bois", mesmo que você saiba quem desenvolveu a funcionalidade que acabou retornando com bug. 
> Relatórios de bug são uma forma de documentação do seu sistema e não vai agregar em nada citar o nome de fulano ou do time XPTO nesta documentação. Isso irá evitar conflitos entre as equipes e evitar que alguém do time de desenvolvimento fique achando que alguém do time de qualidade está apenas pegando no pé.
> Procure pensar em qualidade para a organização e resolver a dor de quem sofre com este bug e não em apontar culpados.

## A estrutura de um bug report

Cabe a cada organização definir qual será a estrutura dos relatórios, não posso falar que faça assim e assado nem impor nada.
ar uma estudada sobre conceitos básicos de BDD e principalmente sobre `Given-When-Then` e já terá uma boa ideia de como estruturar seu report mas nada como definir isso a nível organizacional e criar um passo-a-passo.

Espero que durante este momento de definição, alguma dessas dicas tenha te ajudado em algo e ficarei contente em receber um ping no [Twitter](https://twitter.com/jose_filho_dev) sobre!

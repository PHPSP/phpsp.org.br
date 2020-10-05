---
createdAt: 2020-10-05
title: Middleware, PSR-7, PSR-15 e Mezzio
author: Leo Cavalcante
authorEmail: lc@leocavalcante.com
---

## Middleware, a palavra.

Sou o maluco das etimologias, acho legal tentar entender a origem da palavra e que significado ela carrega, no caso de middleware o middle vem de "meio", "entre" e o ware é usado pra substantivos não-contáveis como o middle, a língua inglesa tem esse lance de substantivos contáveis e incontáveis.

![Dicionário de Inglês Oxford](https://github.com/leocavalcante/phpsp.org.br/blob/master/source/assets/images/posts/middleware-psr-7-psr-15-e-mezzio/dictionary.jpg?raw=true)

Não achei uma tradução muito legal, a Wikipédia chama de "cola de software", por exemplo, talvez porque só traduziu o *"software glue"* da Wikipédia em inglês, mas pessoalmente eu diria: **meio de campo**.

![Rivelino](https://github.com/leocavalcante/phpsp.org.br/blob/master/source/assets/images/posts/middleware-psr-7-psr-15-e-mezzio/rivelino.jpg?raw=true)

## Origem na ciência da computação.

E a primeira vez que essa palavra foi usada, foi num paper sobre engenharia de software, apresentado numa conferência de ciência, organizado pela OTAN (NATO) em 1968; o paper tratava da relação do software com o hardware, de design de software, desenvolvimento, distribuição e o proposito que esse software estava cumprindo.

![Logo da OTAN](https://github.com/leocavalcante/phpsp.org.br/blob/master/source/assets/images/posts/middleware-psr-7-psr-15-e-mezzio/nato.png?raw=true)

Esse paper foi escrito peter Peter Naur, turing award de 2005, conhecido pela BNF (Backus–Naur form) e pelo Brian Randell que é conhecido pela sua pesquisa em sistemas resilientes/tolerantes a falhas.

![Peter Naur](https://github.com/leocavalcante/phpsp.org.br/blob/master/source/assets/images/posts/middleware-psr-7-psr-15-e-mezzio/peter-naur.jpg?raw=true)
- Peter Naur

E o termo middleware lá serviu pra descrever uma camada que ficavam entre a aplicação (software) e a comunicação entre o sistema (hardware), que abstraia acesso ao sistema de arquivos exatamente, então o gerenciamento de arquivos não precisaria ser restrito numa aplicação toda vez que ela precisasse rodar num sistema diferente. - [https://ironick.typepad.com/ironick/2005/07/update_on_the_o.html](https://ironick.typepad.com/ironick/2005/07/update_on_the_o.html)

![Paper com a palavra Middleware](https://github.com/leocavalcante/phpsp.org.br/blob/master/source/assets/images/posts/middleware-psr-7-psr-15-e-mezzio/paper.jpg?raw=true)

## Adapter pattern, é você?

Você pode ter imediatamente associado esse comportamento ao Adapter pattern, mas a diferença fundamental é o middleware não faz só uma tradução de interfaces, um middleware pode compor toda uma outra série de comportamentos, pode alterar a mensagem que é passada de um lado pro outro, pode interromper essa mensagem, passar pra outro ponto, enfim, não é só uma adaptação de APIs.

![Adaptador de tomada](https://raw.githubusercontent.com/leocavalcante/phpsp.org.br/master/source/assets/images/posts/middleware-psr-7-psr-15-e-mezzio/adapter.webp)

## Como é hoje.

Nos anos 80 a estratégia ficou bem popular pra poder lidar com sistemas legados, você podia evoluir parte dele e ainda se comunicar com as partes antigas através de um middleware.

Pelos anos 2000, o termo na área de sistemas distribuídos, foi amplamente usado para descrever componentes que ficavam acima da camada de transporte (TCP/IP), mas abaixo da camada de aplicação, como por exemplo um web server.

Um dos usos para Middleware mais comuns hoje em dia é poder definir uma cadeia de componentes que vão ficar entre dois eventos. Na web, um bom exemplo pra esses eventos são receber uma requisição HTTP e devolver uma resposta HTTP.

![Ilustração de Pipeline](https://github.com/leocavalcante/phpsp.org.br/blob/master/source/assets/images/posts/middleware-psr-7-psr-15-e-mezzio/pipeline.png?raw=true)

## PSR-7.

Receber requisições HTTP e devolver respostas HTTP é basicamente o que define a web, conforme a Internet foi crescendo, ficando popular e acessível, as necessidades da web também escalaram de servir documentos para servir páginas dinâmicas e processar dados, para que web servers não precisassem ser recompilados com regras de negócio novas que façam isso, eles foram desenvolvidos para chamar scripts no servidor e o protocolo de comunicação entre o web server e esses scripts foi criado, batizado de CGI (Common Gateway Interface).

No PHP, as informações sobre a requisição HTTP, que são enviadas pelo web server, são populadas pela SAPI (Server API) em globais mágicas que são acessíveis em qualquer parte do script.

![Ilustração da Server API do PHP](https://github.com/leocavalcante/phpsp.org.br/blob/master/source/assets/images/posts/middleware-psr-7-psr-15-e-mezzio/sapi.png?raw=true)

Até ai tá tudo legal, mas de novo, as coisas escalam, crescem e precisam evoluir nesse cenário novo, nesse caso é o próprio PHP, conforme ele foi sendo usado cada vez mais para aplicações mais complexas, surgiu a necessidade de organizar isso ao invés de depender e ter um alto-acoplamento em variáveis globais. Frameworks web para PHP começaram a adotar Orientação a Objetos e criar classes que representassem essa mensagem que vem numa requisição HTTP, informações sobre o que tem na query string, qual é o path, quais são os headers etc.

Cada framework implementava isso de uma forma, cada um dava um nome e isso impedia a interoperabilidade entre componentes, a bagunça tomou forma e precisava ser arrumada e por isso  um grupo formado por representantes dos maiores frameworks PHP decidiu recomendar alguns padrões para a comunidade seguir e termos consistência entre projetos PHP, desde estilo de código, até como namespaces e sistemas de arquivos seriam usados pelos autoloaders, interfaces para logs e uma dessas recomendações foi também: **interfaces em comum para mensagens HTTP** - [https://www.php-fig.org/psr/psr-7/](https://www.php-fig.org/psr/psr-7/)

## PSR-15.

Maravilha, frameworks começaram a fazer suas classes HTTP serem implementações dessa interface comum a todos e isso permitiu que componentes pudessem ser criados e reaproveitados em qualquer framework que seguisse essas recomendações.

E o sucesso dessas interfaces fez nascer a ideia de ser criadas novas interfaces para esses componentes que também eram muito comuns em todos os frameworks com a premissa de diminuir o acoplamento do seu código, das suas regras de negócio, de uma dependência com um framework.

Então a PSR-15 nasceu sugerindo interfaces para dois componentes: *Request Handlers*, interface para componentes que seria responsáveis por lidar com a entrada de dados através da mensagem HTTP de requisição definida na PSR-7 e devolver uma resposta HTTP que também deve seguir a interface para respostas na PSR-7 (se você entende de MVC, essa seria a interface para suas Controllers) e a segunda é o ponto que queremos chegar: **middleware**! Sim, uma das interfaces definidas pela PSR-15 é a *Psr\Http\Server\MiddlewareInterface* e com o propósito que havíamos visto antes, ou seja, é uma interface para componentes que ficariam entre o ciclo de vida de uma requisição até um *request handler*.

```
namespace Psr\Http\Server;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Participant in processing a server request and response.
 *
 * An HTTP middleware component participates in processing an HTTP message:
 * by acting on the request, generating the response, or forwarding the
 * request to a subsequent middleware and possibly acting on its response.
 */
interface MiddlewareInterface
{
    /**
     * Process an incoming server request.
     *
     * Processes an incoming server request in order to produce a response.
     * If unable to produce the response itself, it may delegate to the provided
     * request handler to do so.
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface;
}
```

- [https://www.php-fig.org/psr/psr-15/](https://www.php-fig.org/psr/psr-15/)

## Middleware, o componente.

Com essa interface podemos implementar bibliotecas com componentes de Middleware que funcionem em qualquer framework que siga também as recomendações da PHP-FIG, as PSRs.

Casos interessantes para um middleware são por exemplo: algo que lide com CORS, autenticação, sessões, content-negotiation, cache e minificação de arquivos estáticos etc. Sem contar que sua própria regra de negócio pode ser componentizada através de middleware e você pode modularizar sua aplicação com uma ótima granularidade, até rodar ela em outro framework que também tenha suporte a middleware e por falar em framework com suporte a middleware:

![Ilustração de componentes Middleware](https://github.com/leocavalcante/phpsp.org.br/blob/master/source/assets/images/posts/middleware-psr-7-psr-15-e-mezzio/middleware.png?raw=true)

## Mezzio.

Mezzio é um framework envolta das bibliotecas *laminas/laminas-httphandlerrunner* e *laminas/laminas-stratigility*, que é onde as implementações de PSR-7 e PSR-15 ficam; e ela trás toda facilidade que um framework geralmente entrega só que para trabalhar com middlewares.

Coisas como rotas, injeção de dependência, templating, tratamento de erros etc, todos resolvidos através de middlewares e com total abertura pra você implementar e incluir suas próprias; inclusive, muitas delas você não precisa implementar do zero: [https://packagist.org/packages/middlewares/](https://packagist.org/packages/middlewares/)

Laminas é a continuação da antiga Zend Framework e a Mezzio é a continuação da Zend Expressive.

E começar com a Mezzio é muito simples, além de já ter um projeto base, como a maioria dos frameworks:

```bash
composer create-project mezzio/mezzio-skeleton my-app
```

Você ainda passar por um guia de instalação onde diz quais componentes quer que façam parte do seu projeto, isso é maravilho pra você manter algo conciso, por exemplo, se você vai fazer uma API, você não precisa de algo pra templating.

![Screenshot da instalação da Mezzio](https://github.com/leocavalcante/phpsp.org.br/blob/master/source/assets/images/posts/middleware-psr-7-psr-15-e-mezzio/installer.png?raw=true)

Outra coisa bem legal é notar como os componentes poder ser escolhidos e trocados, não só durante a instalação, mas a qualquer momento, graças as middlewares e isso reduz drasticamente o acoplamento da sua aplicação com o vendor lock-in de um framework em especifico, se quiser trocar o componente de rotas, você consegue, se quiser trocar o componente de tratamento de erros, você consegue e por ai vai.

![Fluxo de dados na Mezzio](https://github.com/leocavalcante/phpsp.org.br/blob/master/source/assets/images/posts/middleware-psr-7-psr-15-e-mezzio/flow.png?raw=true)

E esse desacoplamento é fundamento para implementar arquiteturas limpas, por exemplo a baseada em camadas como a Onion (cebola).

A aplicação atua como uma "cebola"; no diagrama acima, a parte superior é a camada mais externa da cebola, enquanto a parte inferior é a mais interna.

Cada middleware recebe uma solicitação e uma próxima middleware para entregar o fluxo de dados da requisição. Qualquer middleware pode retornar uma resposta , e nesse ponto a execução volta ao normal.

### Pipelines

A terminologia "pipeline" costuma ser usada para descrever a cebola. Uma maneira de ver a "cebola" é como uma fila , que é o primeiro a entrar, primeiro a sair (FIFO) em operação. Isso significa que o primeiro middleware na fila é executado primeiro e invoca o próximo e assim por diante.

## Obrigado

A ideia do artigo foi apresentar os conceitos, encorajo a dar uma olhada no guia rápido e fazer seu primeiro _Hello, World!_ com a **Mezzio** e de divertir com **Middlewares**.

[https://docs.mezzio.dev/mezzio/v3/getting-started/quick-start/](https://docs.mezzio.dev/mezzio/v3/getting-started/quick-start/)

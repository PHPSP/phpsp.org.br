---
createdAt: 2018-10-10
title: (React PHP) Conceitos básicos - EventLoop
author: Níckolas Silva
authorEmail: nawarian@gmail.com
---

Este artigo é o primeiro de uma sequência que pretendo publicar aqui. Neste entenderemos o que é [React PHP](http://reactphp.org/) e o que nos possibilita. 
Outra nota importante é: esta não é uma série introdutória. O foco está em entender como React funciona, deixando de lado introduções didáticas focadas em desenvolver uma aplicação de exemplo.  

### Visão Geral

A palavra chave em React é _assíncrono_. Esta é a maior ideia por trás da coleção de bibliotecas que vemos consigo.
PHP, por natureza, é dito "bloqueante". Isto significa que cada procedimento só virá a ser executado após o anterior. Ilustrado na imagem (obrigado @gabrielcouto) e código: 

[![blocking-io](/assets/images/posts/React-PHP-Conceitos-básicos-–-EventLoop/blocking-io.png)](http://dev.r3c.com.br/palestra-async-html/#/9)

```php
echo 'Obtendo o arquivo...';
// Executa somente após a linha 3
$conteudo = file_get_contents('umArquivoPesado.txt');
// Executa somente após a linha 5, e assim por diante...
if ($conteudo) {
    echo 'Arquivo obtido com sucesso! :)';
}
```

Estamos de fato acostumados com este cenário. Porém isto passa a ser problemático quando _umArquivoPesado.txt_ leva alguns segundos para ser carregado à memória.

Esta mesma ideia se aplica às requisições a serviços dentro do código PHP, carregamento de configurações (XML, JSON, YAML...), acesso ao banco de dados e por aí vai. O ponto é: PHP bloqueia a cada comando executado e os comandos que fazem entrada/saída (acesso a disco, acesso a rede...) de dados tendem a ser mais demorados que comandos internos de processamento (um echo, um if, um cálculo...).

React PHP vem com o intuito, justamente, de permitir que executemos pedaços de lógica em paralelo. Nada que não pudesse ser feito com PHP antes, mas React traz uma interface orientada a objetos muito bem organizada e que nos facilita esta utilização.  

### EventLoop

Para tornar isto possível, React centraliza sua execução em um "EventLoop", que nos permitirá alcançar a ilustração seguinte: 

[![non-blocking-io](/assets/images/posts/React-PHP-Conceitos-básicos-–-EventLoop/non-blocking-io.png)](http://dev.r3c.com.br/palestra-async-html/#/21)

EventLoop nada mais é que um laço infinito (infinito até que seja interrompido ou que não possua mais processos a executar) de repetição que organiza e elege blocos de código (como são as funções) para execução. Em sua estrutura ele:

*   Gerencia processos a executar (funções, callbacks...)
*   Identifica atualizações sobre processos em paralelo
*   Executa processos referentes aos processos em paralelo

Com este modelo é possível executar procedimentos de entrada/saída (comumente demorados) em paralelo com a execução de tarefas de CPU. Abaixo exemplifico como o EventLoop gerencia os processos a serem executados:

```php
$loop = React\EventLoop\Factory::create();

$numeros = range(0, 2);
$letras = range('A', 'C');

$callback01 = function () use (&$numeros) {
 echo current($numeros).' ';
 next($numeros);
};

$callback02 = function () use (&$letras) {
 echo current($letras).' ';
 next($letras);
};

$controle = function () use (&$numeros, &$letras, $loop) {
 // Se lemos o ultimo número e a ultima letra, pare
 if (!current($numeros) && !current($letras)) {
   $loop->stop();
 }
};

$loop->addPeriodicTimer(1, $callback01);
$loop->addPeriodicTimer(1, $callback02);
$loop->addPeriodicTimer(1, $controle);

// Inicia e executa o EventLoop
$loop->run();

// Saída esperada: 0 A B 1 C 2
```

Acima o EventLoop deverá ter executado, a cada um segundo, os processos _$callback01_, _$callback02_ e _$controle_, sendo que este último identifica que o programa encerrou as leituras necessárias e solicita o fim da execução.
É importante ressaltar que _$callback01_, _$callback02_ e _$controle _não executaram em paralelo, mas o tempo de processamento destes é tão ínfimo que podemos ter esta impressão. Experimente mudar o tempo, em segundos, dos timers (linhas 23 a 25) para visualizar melhor como o EventLoop organiza e elege os processos a serem executados.  

### Timers

No exemplo de código anterior vimos como funciona o método _addPeriodicTimer()_, que se fizessemos um paralelo com o JavaScript seria equiparado ao _setInterval()_. Temos também o equivalente ao _setTimeout()_, que com o React se refere como _addTimer()_ como segue:

```php
$start = microtime(true);

$timeout = $loop->addTimer(3, function () use ($start) {
    $intervalo = sprintf('%0.2f s', microtime(true) - $start);
    echo "[{$intervalo}] Timeout veio\n";
});

$interval = $loop->addPeriodicTimer(2, function () use ($start) {
    $intervalo = sprintf('%.2f s', microtime(true) - $start);
    echo "[{$intervalo}] Interval veio\n";
});

$loop->addTimer(15, function () use ($loop, $interval, $start) {
    if ($loop->isTimerActive($interval)) {
        $interval->cancel(); // Alias para $loop->cancelTimer($interval)
        $intervalo = sprintf('%.2f s', microtime(true) - $start);

        echo "[{$intervalo}] Interval infinito cancelado.\n";
    }
});

/*
Saída esperada:
[2.00 s] Interval veio
[3.00 s] Timeout veio
[4.00 s] Interval veio
[6.00 s] Interval veio
[8.00 s] Interval veio
[10.00 s] Interval veio
[12.00 s] Interval veio
[14.00 s] Interval veio
[15.00 s] Interval infinito cancelado.
*/
```

Analisando o código acima, deverá ser impresso uma única vez a frase "Timeout veio" após 3 segundos do início da execução do programa. E deverá ser impressa infinitamente a frase "Interval veio" a cada 2 segundos.
Após 15 segundos de execução do programa realizamos uma ordem de cancelamento para o intervalo infinito caso ele esteja ativo perante o EventLoop. O EventLoop, portanto, não possuirá mais itens na fila de execução e encerra o programa na próxima iteração.  

### Streams

Até o momento não vimos nenhuma execução que de fato fosse paralela, apenas trabalhamos com filas de execução muito bem organizadas e temporizadas.
O EventLoop traz consigo uma abstração para lidar com [Streams](http://php.net/manual/en/intro.stream.php) que, em php, podem ser trabalhados utilizando [wrappers](http://php.net/manual/en/class.streamwrapper.php) e/ou [funções](http://php.net/manual/en/ref.stream.php) e nenhum dos dois modelos é muito intuitivo.
Precisamos sempre ter em mente que streams são encaixados em dois grupos: readable (de onde lemos dados) e writable (por onde escrevemos dados). Alguns tipos de streams se encaixam, inclusive, nos dois grupos.
O EventLoop tratará Streams utilizando os métodos _addReadStream()_ e _addWriteStream()_. Abaixo um exemplo de seu funcionamento:

```php
// Iniciando um server em localhost, porta 7171
$serverSock = stream_socket_server('tcp://127.0.0.1:7171');

// Aqui dizemos que ele não bloqueia execução
stream_set_blocking($serverSock, 0);

// Lista contendo todos os clientes conectados
$clients = array();

// Adicionamos um "leitor" que chamará o callback sempre que
// $serverSock estiver pronto para leitura (quando alguém se conectar, neste caso)
$loop->addReadStream($serverSock, function ($serverSock, $loop) use (&$clients) {
    $clientSock = stream_socket_accept($serverSock);
    stream_set_blocking($clientSock, 0);

    // Vamos identificar nossas conexões para entender melhor...
    $username = false;

    // Emite uma mensagem ao $clientSock que acabou de se conectar
    fwrite($clientSock, "Diga-nos seu nome: ");

    // Criamos também um buffer de leitura para o $clientSock
    // Este executa a cada mensagem enviada pelo $clientSock
    $loop->addReadStream($clientSock, function ($clientSock, $loop) use (&$username, &$clients) {

        // $username == false -> Ainda não autenticou-se
        if (!$username && $username = fgets($clientSock)) {
            $username = trim($username);
            fwrite($clientSock, "Bem-vindo, {$username}. Você está no chat maroto!\n\n");

            // Adiciona à lista de clients conhecidos
            $clients[] = $clientSock;
        }

        // Se já se identificou e enviou alguma mensagem, repasse
        if ($username && $text = fgets($clientSock)) {

            // Busco TODOS os clients conhecidos, e redistribuo
            // a mensagem $text para todos que não o remetente
            foreach ($clients as $client) {
                if ($client !== $clientSock) {
                    fwrite($client, "[{$username}] {$text}");
                }
            }
        }
    });
});
```

Esta aplicação pode ser testada, por exemplo, utilizando o programa "telnet". 
[![example](/assets/images/posts/React-PHP-Conceitos-básicos-–-EventLoop/example.png)](/assets/images/posts/React-PHP-Conceitos-básicos-–-EventLoop/example.png)

Todo callback passado para _addReadStream()_ será sempre executado quando aquele stream estiver pronto para leitura, e isto varia de acordo com o stream que estiver trabalhando: pode ser uma nova conexão recebida, ou uma mensagem recebida.
De forma análoga, _addWriteStream()_ executará os callbacks assim que o stream estiver preparado para escrita.  

### Ticks

Por fim, talvez o mais importante, precisamos apresentar os Ticks dentro do EventLoop.
Como dito anteriormente, o mecanismo do EventLoop não passa de um loop infinito. Literalmente, veja este trecho retirado de [React\EventLoop\StreamSelectLoop](https://github.com/reactphp/event-loop/blob/master/src/StreamSelectLoop.php):

```php
public function run()
{
    $this->running = true;

    while ($this->running) {
        // Lógica de organização de processos     
    }
}
```

Cada vez que entramos neste laço (linha 05) o EventLoop dispara filas de execução eleitas para aquela iteração (tick). Na implementação StreamSelectLoop, um tick inicia a execução (nesta ordem):

*   Da fila _nextTickQueue_
*   Da fila _futureTickQueue_
*   Dos timers registrados (_addTimer()_ e _addPeriodicTimer()_)
*   Dos callbacks registrados para streams (_addReadStream()_ e _addWriteStream()_)

Podemos manipular as filas _nextTickQueue_ e _futureTickQueue_ através dos métodos _nextTick()_ e _futureTick()_, respectivamente. Eles recebem funções (callable) como parâmetro:

```php
$loop->nextTick(function() {
    echo "Next tick :D\n";
});

$loop->futureTick(function() {
    echo "Future tick :D\n";
});

/* Saída esperada:
Next tick :D
Future tick :D
*/
```

Eles realmente parecem fazer a mesma coisa, mas existe uma sutil difereça entre os dois:

*   Next ticks executarão enquanto existirem callbacks em sua fila de execução
*   Future ticks executarão somente os callbacks existentes na fila no momento em que foram inicializados

O exemplo abaixo ilustra melhor esta diferença:

```php
function futureTick() {
    echo "Future tick\n";
    global $loop;

    $loop->futureTick('futureTick');
    $loop->stop();
}

$loop->futureTick('futureTick');

// Saída esperada: Future tick</pre>

Este future tick envia a mesma função para a fila de future ticks assim que executa, depois solicita o fim do EventLoop. A função _futureTick()_, porém, executará uma unica vez, pois quando a fila de future ticks iniciou a execução, existia somente uma ocorrência para executar. Veja a diferença com os next ticks:

<pre class="lang:php decode:true">function nextTick() {
    echo "Next tick\n";
    global $loop;

    $loop->nextTick('nextTick');
    $loop->stop();
}

$loop->nextTick('nextTick');
```

Este programa entrará num loop infinito, pois ao fim de _nextTick()_ esta função é enviada novamente para a fila de next ticks e esta fila executa enquanto existirem callbacks, independentemente do momento em que foram adicionados.  

### Implementações de EventLoop

Se você notar, no início deste texto, instanciamos o EventLoop utilizando a [React\EventLoop\Factory](https://github.com/reactphp/event-loop/blob/master/src/Factory.php). Isto porque, atualmente, existem quatro implementações diferentes do EventLoop (todas devem respeitar a interface [React\EventLoop\LoopInterface](https://github.com/reactphp/event-loop/blob/master/src/LoopInterface.php)) e a Factory irá instanciar o primeiro disponível. São as implementações:

*   ExtEventLoop (Utiliza a extensão [Event](http://php.net/manual/en/book.event.php))
*   LibEvLoop (Utiliza a extensão [Libev](https://github.com/m4rw3r/php-libev))
*   LibEventLoop (Utiliza a extensão [LibEvent](http://php.net/manual/en/book.libevent.php))
*   StreamSelectLoop (Não utiliza extensões)

Destas, somente StreamSelectLoop funciona somente com PHP pois faz uso de _[stream_select()](http://php.net/stream_select)_. O restante das implementações somente serão instanciadas quando a devida extensão existir.
Em questão de performance, StreamSelect é a implementação menos perfeita. As outras implementações delegam a gerência de entrada/saída às extensões. A medição de performance, porém, dependerá do seu cenário de uso e, algumas vezes, pode ser mais interessante instanciar o EventLoop manualmente em vez de depender da Factory para escolher o melhor para você.  

### Conclusão

Vimos aqui as funcionalidades básicas do EventLoop, como ele se comporta e como está desacoplado do restante das bibliotecas React.
Através destas explicações você já será capaz de criar bibliotecas que interajam com o React, assim como desenvolver novas implementações de EventLoops, modificar existentes ou mesmo contribuir com melhorias neste pacote do projeto.

---
Artigo originalmente criado em 31/12/2015.
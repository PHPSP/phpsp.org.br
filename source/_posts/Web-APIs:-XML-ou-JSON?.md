---
createdAt: 2018-10-15
title: Web APIs - XML ou JSON?
author: Níckolas Silva
authorEmail: nawarian@gmail.com
---

É comum ver discussões sobre qual o melhor formato para representar dados e quase sempre caímos na mesma briga: XML vs JSON. Na realidade um dos maiores problemas com estas discussões é a generalização, estamos acostumados - assim espero - com a expressão "não existe bala de prata". Pois é, ela não existe e exatamente por isso gostaria de estabelecer um foco aqui: Web APIs.
Uma API (Application Programming Interface) tem como maior foco fornecer a capacidade de aplicações fora de seu domínio (geralmente terceiros) se utilizarem de suas capacidades. São conhecidas como Web API as que se baseiam no protocolo HTTP para transportar estas capacidades. Padrões comuns de arquitetura de Web APIs são o [RPC](https://tools.ietf.org/html/rfc5531 "RPC") e o [REST](http://www.computerworld.com/article/2552929/networking/representational-state-transfer--rest-.html "REST"). 

##Uma breve introdução
Para que possamos chegar a algum consenso, vou indicar alguns itens que julgo importantes na produção e concessão de uma Web API:

*   Usabilidade Considerando que uma Web API serve para ser utilizada por desenvolvedores - muitas vezes são terceiros, desconhecidos e dos mais diversos níveis - a usabilidade se faz importante para oferecer maior fluidez no desenvolvimento por estes. Considere aqui usabilidade como sendo a soma de fatores como organização, divisão de recursos, complexidade baixa de dados e a baixa e explícita burocaria - Autorização, tokenização... - se existente.
*   Documentação Documentar é um bom começo para que entendamos as Web APIs - e APIs em geral, convenhamos - mundo afora. Além disso evita que passemos nosso precioso tempo de café no telefone, chat ou mesa do colega prestando suporte.
*   Desempenho É bem difícil alguém reclamar do desempenho sem que passe pelos itens acima, o que não o torna menos importante. Respostas rápidas e de baixo custo - quanto menor o tamanho da requisição e resposta, melhor - são essenciais para uma vida longa e próspera das aplicações que utilizem da Web API.

##Um pouco mais do mesmo
Em discussões sobre qual escolher alguns fatores genéricos são sempre trazidos a tona:

*   Tamanho (em bytes) das marcações Neste ponto o XML costuma sair na desvantagem, pois dizem que ele é muito "verboso", ou seja, é muito burocrático na escrita se comparado ao JSON. O exemplo a seguir demonstra como seria representada uma pessoa com atributos nome e idade: **XML**

    ```xml
    <pessoa>
        <nome>Nawarian Níckolas</nome>
        <idade>20</idade>
    </pessoa>
    ```

    **JSON**
    ```json
    {
        "nome": "Nawarian Níckolas",
        "idade": 20
    }
    ```

    De fato JSON se mostrou eficaz com um número menor de caracteres, mas veja bem o item que segue.
*   Capacidade descritiva O que era desvantagem no tópico acima virou vantagem aqui! Notando os mesmos dois trechos de código acima fica nítido que a notação XML indica perfeitamente o que cada coisa significa. Sabe-se que tratamos de uma entidade específica (pessoa) e que os valores "Nawarian Níckolas" e "20" não são simplesmente nome e idade, são nome e idade de uma pessoa. Parece óbvio, mas na realidade não é. A notação JSON deixa muito a desejar neste quesito.
*   Complexidade Bom, este item é citado mas muitas vezes raramente merece. Veja bem: XML possui uma capacidade descritiva muito alta (ele foi desenvolvido com este intuito) e consequentemente pode alcançar níveis de complexidade altíssimos. Mas nem sempre JSON vai conseguir suprir a mesma necessidade de complexidade com a mesma organização. E... não quero polemizar nem nada, mas se sua aplicação precisa de tanta complexidade assim será que compensa utilizar uma Web API?
*   Referências e DTD A marcação XML oferece de maneira mais sucinta de exibir links para outros documentos através de seus atributos. JSON também é capaz de fazer, mas note a diferença: ****XML****

    ```xml
    <pessoa href="http://umsite.com/pessoas/nawarian">
        <nome>Nawarian Níckolas</nome>
        <idade>20</idade>
    </pessoa>
    ```

    **JSON**
    ```json
    {
       "href": "http://umsite.com/pessoas/nawarian",
       "pessoa": {
           "nome": "Nawarian Níckolas",
           "idade": 20
       }
    }
    ```

    Os dois resolveram o problema com sucesso, mas supondo que o link que pedi possui uma URI **/pessoas/{identificador}** o meu retorno deveria ser uma pessoa, concorda? No exemplo JSON eu devolvi um objeto que representa o retorno e somente retorno possui a identificação de pessoa - volte e leia novamente este trecho e os códigos se não entendeu. Parece bobo, mas observe o que segue: **XML**

    ```xml
    <pessoa href="http://umsite.com/pessoas/nawarian">
        <nome>Nawarian Níckolas</nome>
        <idade>20</idade>
        <amigos>
            <pessoa href="http://umsite.com/pessoas/cadinho">
                <nome>Ricardo Ledo</nome>
            </pessoa>
        </amigos>
    </pessoa>
    ```

    **JSON**
    ```json
    {
        "href": "http://umsite.com/pessoas/nawarian",
        "pessoa": {
            "nome": "Nawarian Níckolas",
            "idade": 20,
            "amigos": [
                {
                    "href": "http://umsite.com/pessoas/cadinho",
                    "pessoa": {
                        "nome": "Ricardo Ledo"
                    }
                }
            ]
        }
    }
    ```

    Segundo o formato anterior o item existente na lista **amigos** no formato JSON representa um objeto que referencia uma pessoa, não o objeto pessoa em si.
    "Eu poderia colocar **href** dentro do objeto pessoa". De fato! Faria sentido? Lembre-se também que assim como **href** atributos **proxima_pagina**, **pagina_anterior** e afins se referem à resposta ao pedido, não ao resultado.
    De toda forma, é comum a prática de até mesmo no formato XML adicionar um elemento chamado **root** ou similar para representar a resposta da requisição.
    
    E o [DTD](http://www.w3schools.com/xml/xml_dtd_intro.asp "DTD")?
    É, XML tem suporte ao DTD que particularmente julgo como sendo muito importante. É sempre bom lembrar que não são só navegadores os possíveis clientes de uma Web API, uma estrutura de dados bem definida e com validação torna-se indispensável.
    Mas JSON não tem? Não, mas pode ter... [Em 16 de Janeiro de 2014 tornou-se recomendação da W3C](http://www.w3.org/TR/json-ld/ "Em 16 de Janeiro de 2014 tornou-se recomendação da W3C") um formato chamado [JSON-LD](http://json-ld.org/ "JSON-LD") - JSON Linked Data. Uma maneira muito mais complexa - diria também completa - de ligar dados, significados e estruturas. Então esta desculpa não existe mais para favorecer o XML.
*   Suporte e facilidades das linguagens Praticamente todas as linguagens mais difundidas possuem suporte tanto ao XML quanto ao JSON. E quase sempre, se não houver, há uma biblioteca ou outra que resolve o problema.
    A questão é que: estamos acostumados a consumir Web APIs através de aplicações baseadas em navegadores. Aqui reina o JavaScript e neste se consolida o JSON (JavaScript Object Notation). Seria bobeira utilizar XML em seu lugar!
    Seria mesmo? Quem aqui já mexeu com o DOM?

    ```
    <p>Um paragrafo perdido...</p>

    <script>
        var p =document.getElementsByTagName( 'p' )[0];
        p.innerHTML; // Um parágrafo perdido...
    </script>
    ```

    Poxa, jura que você nunca se tocou que o HTML segue a estrutura XML? E o JavaScript já trabalha assim com ele há anos!
    Mesmo assim a API de manipulação de XML (para documentos externos, não só o HTML da página) pode não estar disponível em todos os navegadores, necessitando uma biblioteca extra. 
    O suporte, portanto, deveria seguir mais a necessidade da sua aplicação e a escolha aqui está muito ligada à sua capacidade de previsão de quem irá possivelmente consumir sua Web API.
    Um bom exemplo seria a implementação do [BOSH](http://xmpp.org/about-xmpp/technology-overview/bosh/ "BOSH") para troca de mensagens instantâneas utilizando [XMPP](http://xmpp.org/ "XMPP"). Ele funciona através de uma interface [RPC](http://pt.wikipedia.org/wiki/Chamada_de_procedimento_remoto "RPC") e, por conta do protocolo de comunicação (XMPP), continua utilizando XML normalmente. E daí que é [HTTP](http://pt.wikipedia.org/wiki/Hypertext_Transfer_Protocol "HTTP")? A marcação utilizada foi a que melhor atendeu o negócio (ao menos na época).
*   Estruturas de dados "humanamente legíveis" 
    As duas estruturas de dados apresentadas clamam ser "humanamente legíveis". Eu discordo muito disto e, até o presente momento, não me foi apresentada sequer uma estrutura de dados que não exigisse treinamento para que eu pudesse entender.
    Isto porque nem todo mundo sabe entender a linguagem da matemática, a semântica do alemão, a lógica dos kanjis japoneses ou a escala pentatonica na música. Não precisamos.
    Seres humanos não precisam entender estas estruturas de dados a menos que tenham necessidade delas em seu dia-a-dia. Seres humanos que têm necessidade de entender estas estruturas de dados terão de aprendê-las e quando isto ocorrer tanto o XML quanto o JSON serão naturalmente tão complicados ou tão simples quanto o nível de esforço de quem observa.

Estes foram alguns apontamentos mais genéricos que podemos ver em diversas discussões acerca do tema. Espero que não tenha parado de ler antes de chegar aqui, eu quero ainda cutucar uma ferida... 
**"É óbvio que o XML é bem mais pesado que JSON"** 
É... nem tanto: Uma prática muito comum na otimização de transferência de dados pela Web é compactar os pacotes a serem transferidos. Esta prática consome um pouco mais de processamento, porém diminui razoavelmente o tamanho final da resposta. 
Os filtros de compactação comumente utilizados são gzip e Deflate.  Vamos fazer uma prova de conceito então! 
Para verificar o quão óbvia é a vantagem em tamanho (bytes) do JSON em relação ao XML eis abaixo uma aplicação simples. Estou utilizando a base de dados [sakila](http://dev.mysql.com/doc/sakila/en/ "sakila"), mais especificamente a tabela **films**. Que, atualmente, contém mil registros. Nesta aplicação, obtenho todos os registros e faço o teste entre JSON e XML antes e depois de executar uma compressão pelo filtro gzip.
A estrutura da tabela **films** é a que segue: films( <span style="text-decoration: underline;">film_id</span>, title, description, release_year, language_id, original_language_id, rental_duration, rental_rate, length, repalcement_cost, rating, special_features, last_updates ).
O primeiro registro desta tabela será então representado assim: **XML**

```xml
<entidade>
    <film_id>1</film_id>
    <title>ACADEMY DINOSAUR</title>
    <description>A Epic Drama of a Feminsit And a Mad Scientist who must Battle a Teacher in The Canadian Rockies</description>
    <release_year>2006</release_year>
    <language_id>1</language_id>
    <original_language_id></original_language_id>
    <rental_duration>6</rental_duration>
    <rental_rate>0.99</rental_rate>
    <length>86</length>
    <replacement_cost>20.99</replacement_cost>
    <rating>PG</rating>
    <special_features>Deleted Scenes,Behind the Scenes</special_features>
    <last_update>2006-02-15 05:03:42</last_update>
</entidade>
```

**JSON**
```json
{
    "film_id":"1",
    "title": "ACADEMY DINOSAUR",
    "description":"A Epic Drama of a Feminsit And a Mad Scientist who must Battle a Teacher in The Canadian Rockies",
    "release_year":"2006",
    "language_id":"1",
    "original_language_id":null,
    "rental_duration":"6",
    "rental_rate":"0.99",
    "length":"86",
    "replacement_cost":"20.99",
    "rating":"PG",
    "special_features":"Deleted Scenes,Behind the Scenes",
    "last_update":"2006-02-15 05:03:42"
}
```

Agora vamos coletar alguns dados brutos para podermos realizar algumas comparações. Para coletar estes dados escrevi um programa simples que realizará conversão e compactação dos registros nesta tabela **films** testando 1, 10 e 1000 registros nesta sequência. O código-fonte e máquina virtual deste teste podem ser encontrados [aqui](https://github.com/nawarian/benchmark_xml_vs_json "aqui"), sinta-se livre para alterar o código e quintuplicar o número de registros se assim desejar. É sempre bom testar em maiores proporções e diferentes tipos de dados.
[![https://drive.google.com/file/d/0BwCNs-cya0IQNDlza05SRTdpV2c/view?usp=sharing](https://lh5.googleusercontent.com/vVZzB6wcwrPrAxKNEdnKCl86UFehDo9_HDfJq36pmZbRi9QX7hqe9p0pShLv6nU4eTWgQA=w1896-h870)](https://drive.google.com/file/d/0BwCNs-cya0IQNDlza05SRTdpV2c/view?usp=sharing)

Conforme o primeiro teste, realizado com um registro, nota-se facilmente que JSON leva vantagem pois: alcança um gasto de tamanho (em bytes) menor em relação a XML tanto em sua forma pura quanto comprimido. O tempo de compressão dos dois equiparam-se pois foi realizado um arredondamento. Mas o intervalo de compressão é muito ínfimo e apenas aplicações muito específicas podem vir a necessitar de desempenho neste nível.
No segundo teste temos um tempo de compressão semelhante ao primeiro, porém o primeiro choque: comprimindo a estrutura de dados XML temos um resultado mais satisfatório em comparação ao JSON e a diferença não foi pequena!
No terceiro e ultimo teste, realizado com mil registros, temos uma exemplificação de como os valores antes citados se inverteram absurdamente. Há uma redução de aproximadamente 357 quilobytes (89,79%) para os registros em JSON, enquanto a redução com XML foi de 546 quilobytes (99,45%) com uma vantagem de 0,0039 segundos no tempo de compressão.
Provavelmente este comportamento se dá por conta do [algorítmo deflate](http://www.gzip.org/deflate.html "algorítmo deflate"), que identifica padrões na estrutura a ser compactada e os transforma de maneira proporcional. Lembrando apenas que a estrutura de TAGs que o XML se utiliza é claramente repetitiva e este fator não é tão obviamente encontrado na estrutura JSON.
##Conclusão
Agora temos uma visão exposta de boa parte dos ideais apresentados e, se deixarmos o aspecto "fã" de lado, fica claro que:

*   Ambos possuem vantagens semânticas, estéticas e de implementação.
*   Tratando-se de transporte JSON possui uma pequena vantagem para poucos registros, mas conforme o número de registros cresce maior a vantagem da marcação XML.
*   Em complexidade XML e JSON possuem a mesma capacidade: XML com sua estrutura de árvore e DTD e JSON com sua especificação JSON-LD.
*   A manipulação, mesmo sendo uma ideia muito subjetiva, aparenta ser mais simples para JSON pois se baseia na estrutura chave-valor em vez da estrutura de árvore, muito mais complexa de interpretação (sob aspecto de uma estrutura lógica). Apesar disso, estamos num período em que se faz comum a programação de alto nível - como JavaScript, PHP, Java - e podemos contar com frameworks que abstraem e facilitam estes procedimentos.

Mas pra quê escolher XML ou JSON na hora de desenvolver a aplicação? Por que não os dois?
Afinal em alguns momentos ambos se sobressaem e uma junção bem definida destes pode gerar uma aplicação de desempenho talvez melhor do que a adoção de apenas um.
Agora gostaria de saber a sua opnião nos comentários: e aí? XML ou JSON?

---
Artigo originalmente criado em 13/03/2015.
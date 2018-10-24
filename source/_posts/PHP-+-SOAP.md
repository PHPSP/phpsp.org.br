---
createdAt: 2018-10-22
title: PHP + SOAP
author: Níckolas Silva
authorEmail: nawarian@gmail.com
---

Desde a versão 5.0.1 do PHP fizeram-se disponíveis as classes e funções para trabalhar com SOAP nativamente. 

O link para o manual é o que segue: [http://php.net/manual/en/book.soap.php](http://php.net/manual/en/book.soap.php). 

Abaixo veremos como começar a brincar com essa nova funcionalidade que agora nos é disponível.   


### Começando pelo começo: O que é SOAP? 

Evitando qualquer tipo de "historinha", SOAP é uma abreviação de Simple Object Access Protocol, ou Protocolo Simples de Acesso a Objetos. Isto resume basicamente sua funcionalidade: transportar de forma facilitada objetos - talvez a palavra "funcionalidades" coubesse melhor aqui - através de um protocolo bem definido e com um padrão capaz de ser integrado a diversas plataformas. 

O SOAP baseia seu protocolo de comunicação no XML, e seu transporte no HTTP. Não significa que o mesmo não possa ser implementado de outras formas, mas este não é o foco deste texto. 

SOAP é um dos protocolos mais comuns quando tratamos de sistemas distribuídos e está muito presente no mundo enterprise. Basicamente consiste em dispor uma interface acessível à operações remotas à sua aplicação (costumo dizer que transmite meta-objetos), permitindo a distribuição organizada de suas aplicações e a componentização destas de forma que: (1) uma aplicação pode ser dividida em vários componentes que se utilizam entre si; (2) novas aplicações ou módulos que possam vir a surgir integrados a esta primeira poderão reutilizar componentes utilizando simplesmente a interface de comunicação; e (3) aplicações externas à(s) sua(s) poderão ter um meio de chamar os componentes de interesse na aplicação já existente.

### O que eu preciso para começar com SOAP? 
Este é um assunto que possui uma carga teórica razoalvemente alta, recomendo buscar literaturas relacionadas para poder ter um maior embasamento. Um título que li e recomendo para introdução ao SOAP (entre outros) é o [SOA na Prática](http://novatec.com.br/livros/soa/) de Fabio Perez Marzullo através da Novatec. 

Um serviço SOAP geralmente vem acompanhado de um WSDL Document - WebService Description Language Document - que é um documento XML com objetivo de descrever as funcionalidades oferecidas, as regras de entrada/saída de dados, autenticação e afins.

Apesar disso, o WSDL não é item obrigatório no PHP e, neste texto, iremos ignorá-lo pois é um tanto trabalhoso e foge do nosso foco aqui.

### Escrevendo um serviço SOAP com PHP
Conforme indicado no primeiro parágrafo, o suporte nativo ao SOAP nasceu na versão 5.0.1 do PHP e traz consigo duas classes principais: [SoapServer](http://php.net/manual/en/class.soapserver.php) e [SoapClient](http://php.net/manual/en/class.soapclient.php). Para iniciarmos o desenvolvimento precisaremos, portanto, de: um servidor http e o interpretador php 5.0.1 ou superior. Estou utilizando para testes sobre este conteúdo o php 5.5 e seu servidor http integrado.

### Instanciando SoapServer:

```php
// server.php
// public SoapServer ( mixed $wsdl [, array $options ] )

$options = array(
    'uri' => 'http://localhost:8080/soap.php'
);
$server = new SoapServer(null, $options);
```

A partir deste ponto teremos uma instância de SoapServer. Note que o primeiro parâmetro do construtor foi omitido, isto porque não queremos utilizar um wsdl aqui. 

O próximo passo será definir quem será responsável por oferecer a interface de comunicação, neste momento teremos duas opções: um objeto já instanciado ou uma classe.

Vou então criar uma classe de exemplo para que possamos entender estas duas possibilidades:

```php
class MinhaInterfaceSoap
{
    public function somar($valor1, $valor2)
    {
        return $valor1 + $valor2;
    }
}


// $server->setClass('MinhaInterfaceSoap');
$server->setObject(new MinhaInterfaceSoap());

$server->handle();
```

Ambos formatos funcionarão de acordo. Ao Final deste trecho de código temos uma chamada à $server->handle(), que irá capturar automaticamente os dados da requisição passados por POST e trabalhar de acordo. Salve o arquivo com o nome server.php e logo em seguida inicie o servidor http contendo este arquivo em sua pasta raiz. Eu optei por fazer assim: `$ php -S localhost:8080`

### Instanciando SoapClient: 

Já temos um SoapServer preparado em server.php, agora vamos escrever um SoapClient capaz de se comunicar com ele.

```php
// client.php
// public SoapClient ( mixed $wsdl [, array $options ] )

$options = array(
    'uri' => 'http://localhost:8080/server.php',
    'location' => 'http://localhost:8080/server.php'
);

$client = new SoapClient(null, $options);

// Já estamos conectados, vamos usar o método "somar" do servidor:
var_dump($client->somar(10, 15)); // 25
```

**Importante! Não rode seu client.php ainda**
Isto, é claro, se você pretende rodar client.php do seu navegador. Afinal no exemplo que citei o servidor http é aquele integrado do php 5.4++.

Acontece que este servidor não trabalha com processos paralelos, de forma que se você tentar acessar [client.php](http://localhost:8080/client.php) no seu navegador provavelmente você irá travar seu processo php.

Pode-se testar client.php diretamente da CLI ou utilizando outra instância do servidor integrado do PHP.

O trecho de código acima deveria imprimir algo como "int(25)" na tela, testemos:

```php
$ php client.php
int(25)
```

Desta forma já estamos conseguindo trabalhar com o cliente e servidor SOAP. Numa próxima devo apresentar bibliotecas para trabalhar com WSDL no PHP e como utilizar o servidor e cliente Soap com um WSDL Document em mãos.

Espero que tenham gostado.

---
Artigo originalmente criado em 28/07/2015.
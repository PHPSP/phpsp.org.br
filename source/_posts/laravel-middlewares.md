---
createdAt: 2020-02-07
title: Introdução a Middlewares com Laravel
author: José Filho (Zé)
authorEmail: jose.filho@phpsp.org.br
---

Mesmo que você não saiba, quando você está utilizando um framework de mercado (aka Laravel/Symfony) você está usando e abusando de middlewares. Frameworks gostam de basear algumas (ou várias) regras em middlewares para deixar o código que você vê no dia-a-dia mais limpo, fluído, e isso é de fato uma das vantagens de se usar middlewares na design do seu sistema.

## Mas você sabe de fato o que são middlewares?

Bom, basicamente um middleware é uma estrutura responsável por ficar entre (no meio: daí o nome `Middleware`) outras estruturas, sejam essas estruturas aplicações, hardware/software ou como ficou mais conhecido no nosso querido PHP `Http Requests`.

A grosso modo um middleware é um caba doido que fica no meio das coisas e pode manipular o que está sendo passado entre essas coisas.

Aquele seu vizinho que sua mãe contratou pra olhar toda vez que você saia de casa e avisá-la, é um middleware que ela colocou entre sua ação (sair de casa) e seu destino. Pense que em determinado momento teu vizinho pode ter achado estranha tua saída e te perguntando onde você está indo, tu responde que tá indo na casa de um amigo que sua mãe não gosta e teu vizinho te impede de ir... Bom, o middleware (vizinho chato) manipulou sua ação e não deixou que ela se propagasse.

Deixando de lado esta analogia besta, podemos considerar middlewares coisas como: brokers, barramentos, e há até quem defenda que uma API é um middleware.

Como eu falei lá em cima, um dos usos mais comuns em PHP para middlewares é em cima das `http requests`, principalmente após a integração das PSRs 7 e 15. Esse uso ficou popularizado porque você consegue fazer basicamente qualquer coisa com uma `request` antes que ela chegue ao seu controller ou até mesmo depois que ela sai do controller e será entregue em forma de `response` como veremos mais pra frente.

## Exemplo de uso

O framework [Laravel](https://laravel.com) dispensa apresentações e ele se utiliza bastante de middlewares. Provavelmente você já utilizou a facilidade de `Auth` do Laravel em uma rota para protegê-la e permitir apenas usuários logados ou até mesmo utilizou o middleware de `Cors`. Mas você sabia que através de middlewares dá pra fazer absolutamente qualquer coisa com o objeto `Request` antes mesmo dele cair no teu controller? Então bora saber agora!

Vamos usar a própria autenticação nativa do Laravel como exemplo, pois acho que é o que a galera tem mais familiaridade.

Basicamente um middleware no Laravel é uma classe que implementa um método público chamado `handle` e recebe dois parâmetros: `Request $request` e `Closure $next`, onde Request é o objeto da request que o Laravel monta pra gente (dentro do middleware temos a oportunidade de modificá-lo até) e Closure é uma closure (avá) responsável pra passar o middleware pro próximo responsável (outro middleware, um controller etc).

Olha como é a implementação do [middleware de autenticação](https://github.com/illuminate/auth/blob/master/Middleware/Authenticate.php) pelo próprio Laravel:

```
// classe Illuminate\Auth\Middleware\Authenticate
    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        return $next($request);
    }

    protected function authenticate($request, array $guards)
    {
        if (empty($guards)) {
            $guards = [null];
        }

        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                return $this->auth->shouldUse($guard);
            }
        }

        $this->unauthenticated($request, $guards);
    }
```

Olha que sussi! O middleware "intercepta" a request recebendo os `$guards` da autenticação, faz a regra que ele quer no método `authenticate` e passa a request pra frente.

Uma coisa que você pode ter notado é que além dos dois parâmetros que eu comentei que um middleware sempre irá receber, existe o `...$guards` ali, isso porque podemos enviar quantos parâmetros quisermos pra os middlewares e naturalmente eles virão após a Closure.

Vamos criar um middleware nosso pra entender melhor como essa parada funciona.

## Criando você mesmo um middleware no Laravel

Pra por a mão na massa vamos criar um middleware de [HoneyPot](https://pt.wikipedia.org/wiki/Honeypot) bem simples mas que vai te dar uma ideia do poder do middleware.

Pra criar um middleware no Laravel pode ser tanto via `artisan` ou criando você mesmo a classe e registrando-a. Vamo criar na mão memo e já era!

Os middlewares ficam por default no namesapce `App\Http\Middleware` e é lá que vamos criar nossa classe. Vai ficar algo tipo assim:

```
// seu_projeto/app/Http/Middleware/HoneyPot.php
<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Request;

/**
 * Middleware responsável por desviar bots para outro servidor
 */
class HoneyPot
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // cria uma regra para identificar se o usuário é um bot como por exemplo pegar o user-agent da request
        // neste caso vamos supor que caso o User Agent seja vazio o usuário é um bot
        if ($request->header('user-agent') === '') {
            return redirect('https://raw.githubusercontent.com/zemirco/sf-city-lots-json/master/citylots.json');
        }

        return $next($request);
    }
}
```

O que estamos fazendo aqui? Estamos identificando se o usuário é um bot e se for ao invés de continuar o fluxo da nossa aplicação (usando `$next($request)`) vamos redirecionar esse bot para uma API bem pesada! Você pode navegar até o link do exemplo se quiser ou remover o `if` que eu adicionei e rodar o código mas eu não o faria xD

Fácil né, fala tu?!

Pois calma lá! Pra essa bruxaria funcionar precisamos tomar mais alguns passos com o Laravel.

## Registrando um middleware

Como podemos ver na [documentação oficial](https://laravel.com/docs/6.x/middleware#registering-middleware) do Laravel há basicamente duas formas para se registrar um middleware: globalmente e/ou atribuindo a rotas. Já dá pra imaginar pra que cada um serve, né? Middlewares globais serão executados em toda request que entrar pro Laravel, middlewares de rotas serão executados cada vez que a rota atribuída a ele for chamada. Aqui vamos usar a atribuição por rotas:

```
// Classe App\Http\Kernel

protected $routeMiddleware = [
    'auth' => \App\Http\Middleware\Authenticate::class,
    'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
    'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
    'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
    'can' => \Illuminate\Auth\Middleware\Authorize::class,
    'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
    'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
    'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    'honeypot' => \App\Http\Middleware\HoneyPot::class,
];
```

Feito isso agora basta atribuirmos o middleware para a rota que queremos que ele seja executado:

```
// routes.php
Route::get('seu/path', 'SeuQueridoController@index')->middleware('honeypot');
```

Já era! Agora você pega aquele bot vaaagabundo!

Vale ressaltar que como quase tudo no Laravel existe mais de uma forma de se atribuir o middleware a uma rota, não deixe de checar a documentação que eu já linkei ali acima e ver outras formas de atribuição, como passar parâmetros igual o próprio Laravel passa as `$guards` do exemplo. E mais importante, divirta-se!

## Conclusão

Middlewares podem ser bem úteis pra uma gama de coisas, como puderam perceber e vale lembrar também que podemos colocar quantos middlewares quisermos pra tratar nossa request:
```
Route::get('seu/path', 'SeuQueridoController@index')->middleware('auth', 'honeypot', 'logger');
```
Tudo vai da sua criatividade e espero eu que do seu bom senso também! Em breve vou criar um novo post falando sobre como middlewares podem ser úteis em refatorações de código legado e espero poder trazer uma visão mais ampla de mais essa ferramenta poderosa que podemos usar no nosso dia-a-dia.

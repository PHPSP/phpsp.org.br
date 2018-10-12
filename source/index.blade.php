---
pagination:
    collection: posts
    perPage: 5
---
@extends('_layouts.master')

@section('body')
    <section class="hero is-small">
        <div class="hero-body">
            <div class="container">
                <img src="{{ $page->asset_prefix }}/assets/images/phpsp/blue-elephpant-herd.jpg" title="ElePHPants">
            </div>
        </div>
    </section>
    <section class="section is-small">
        <div class="columns">
            <div class="column content">
                <h2 class="title is-2">
                    <a class="has-text-grey" href="{{ $page->getUrl() }}eventos">Próximos Eventos</a>
                </h2>
                <p>
                    A comunidade se reune frequentemente. Veja qual encontro vai aconcer ao seu redor!
                </p>
                <hr>
                <a href="https://www.meetup.com/php-sp/events/" target="_blank"
                   class="button is-rounded is-medium is-fullwidth">Eventos em São Paulo</a>
                <br>
                <a href="https://www.meetup.com/PHPSP-Campinas/events" target="_blank"
                   class="button is-rounded is-medium is-fullwidth">Eventos em Campinas</a>
            </div>
            <div class="column">
                <h2 class="title is-2">
                    <a class="has-text-grey-dark" href="{{ $page->getUrl() }}blog">Artigos</a>
                </h2>
                @include('_partials.content.posts.list')
            </div>
            <div class="column">
                <h2 class="title is-2">
                    <a class="has-text-grey" href="{{ $page->getUrl() }}avisos">Avisos</a>
                </h2>
                <div class="card">
                    <div class="card-content">
                        <p class="subtitle">
                            Salve pessoal! Além do PHPSP+Pub, encontro mensal do grupo, temos mais eventos sendo
                            construídos com a ajuda da comunidade e dos parceiros. Quer nos ajudar e fazer parte do
                            grupo? Acesse a seção <a href="/como-contribuir/">como contribuir</a> e ajude a evangelizar
                            o PHPSP!
                        </p>
                    </div>
                    <footer class="card-footer">
                        <p class="card-footer-item">
                          <span>
                            <a href="https://twitter.com/phpsp">Twitter</a>
                          </span>
                        </p>
                        <p class="card-footer-item">
                          <span>
                            <a href="https://facebook.com/sao.paulo.elephants">Facebook</a>
                          </span>
                        </p>
                        <p class="card-footer-item">
                          <span>
                            <a href="https://bit.ly/vemproslackphpsp">Slack</a>
                          </span>
                        </p>
                    </footer>
                </div>
            </div>
        </div>
    </section>
@endsection
---
pagination:
    collection: posts
    perPage: 8
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
                    <span class="has-text-grey">Próximos Eventos</span>
                </h2>
                <p>
                    A comunidade se reune frequentemente. Veja qual encontro vai acontecer ao seu redor!
                </p>
                @include('_partials.content.events.list')
            </div>
            <div class="column">
                <h2 class="title is-2">
                    <a class="has-text-grey-dark" href="{{ $page->getUrl() }}artigos">Artigos</a>
                </h2>
                @include('_partials.content.posts.list')
            </div>
            <div class="column">
                <h2 class="title is-2">
                    <span class="has-text-grey">Avisos</span>
                </h2>
                @include('_partials.content.notices.list')
            </div>
        </div>
    </section>
@endsection

---
title: Artigos
pagination:
    collection: posts
    perPage: 12
---
@extends('_layouts.master')

@section('body')

    <section class="section">
        <div class="content">
            <h1 class="title is-1">{{ $page->title }}</h1>
            @include('_partials.content.posts.grid')
        </div>

        @include('_partials.layout.pagination')
    </section>
@endsection


---
title: Artigos
pagination:
    collection: posts
    perPage: 12
---
@extends('_layouts.master')

@section('body')
    <?php $columns = 3; $count = 0;?>

    <section class="section">
        <div class="content">
            <h1 class="title is-1">{{ $page->title }}</h1>

            <div class="tile is-ancestor">
            @foreach ($pagination->items as $post)
                <div class="tile is-parent is-4">
                    <article class="tile is-child box">
                        <p class="title">
                            <a href="{{ $post->getPath() }}">{{ $post->title }}</a>
                        </p>
                        <p class="subtitle">
                            <small>por </small>
                            <strong>{{ $post->author }}</strong>
                            <small> em </small>
                            <small>{{ date('d\/m\/Y', $post->createdAt) }}</small>
                        </p>
                    </article>
                </div>
            @if(++$count % $columns === 0)
            </div>
            <div class="tile is-ancestor">
            @endif
            @endforeach
            </div>
        </div>

        <nav class="pagination is-centered" role="navigation" aria-label="pagination">

            @if ($previous = $pagination->previous)
                <a class="pagination-previous" href="{{ $page->baseUrl }}{{ $previous }}">&lt;</a>
            @else
                <a class="pagination-previous" disabled>&lt;</a>
            @endif

            @if ($next = $pagination->next)
                <a class="pagination-next" href="{{ $page->baseUrl }}{{ $next }}">&gt;</a>
            @else
                <a class="pagination-next" disabled>&gt;</a>
            @endif

            <ul class="pagination-list">

            @foreach ($pagination->pages as $pageNumber => $path)
                <li>
                    <a class="pagination-link {{ $pagination->currentPage == $pageNumber ? 'is-current' : '' }}" href="{{ $page->baseUrl }}{{ $path }}" aria-label="Goto page {{ $pageNumber }}" {{ $pagination->currentPage == $pageNumber ? 'disabled' : '' }}>{{ $pageNumber }}</a>
                </li>
            @endforeach

            </ul>
        </nav>
    </section>
@endsection


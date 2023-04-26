<!DOCTYPE html>
<html class="has-navbar-fixed-top">
@include('_partials.layout.head')

<?php
$isPost = true;
/** @var \TightenCo\Jigsaw\Collection\CollectionItem $page */
$hasToC = ($page->get('enableToC', true) !== false) &&
    ($page->has('tableOfContents')) &&
    ($page->tableOfContents instanceof \Phpsp\Site\EventHandlers\AfterCollections\ToC\Header) &&
    ($page->tableOfContents->hasChildren());
?>

<body>
<section id="app" class="section">
    <div class="container is-max-desktop">
        @include('_partials.layout.navbar')
        @include('_partials.layout.breadcrumbs')
        <section class="section columns">
            <div class="content column {{ ($hasToC) ? 'is-8-tablet is-9-desktop' : 'is-12' }}">
                <h1 class="title is-1">{{ $page->title }}</h1>
                <p>
                    <small>
                        por {{ $page->author }}
                        em {{ date('d\/m\/Y', $page->createdAt) }}
                    </small>
                </p>
                <article id="post-contents">
                    @yield('post')
                </article>
            </div>
            @if ($hasToC)
            <aside id="toc" class="column is-4-tablet is-3-desktop is-hidden-mobile">
                <div class="box has-background-light">
                    <p class="menu-label">Índice</p>
                    <ul>
                        @each('_partials.content.posts.toc', $page->tableOfContents->getChildren(), 'header')
                    </ul>
                </div>
            </aside>
            @endif
        </section>
        <section class="section">
            <div class="container">
                {{--@include('_partials.content.authors.about-card')--}}
                @include('_partials.content.authors.posts-grid')
            </div>
        </section>
        @include('_partials.layout.contribute')
    </div>
</section>
</body>



@include('_partials.layout.footer')

</html>

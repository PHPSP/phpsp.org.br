<!DOCTYPE html>
<html class="has-navbar-fixed-top">
@include('_partials.layout.head')

<?php $isPost = true; ?>

<body>
<section id="app" class="section">
    <div class="container is-max-desktop">
        @include('_partials.layout.navbar')
        @include('_partials.layout.breadcrumbs')
        <section class="section">
            <div class="content">
                <h1 class="title is-1">{{ $page->title }}</h1>
                <p>
                    <small>
                        por {{ $page->author }}
                        em {{ date('d\/m\/Y', $page->createdAt) }}
                    </small>
                </p>
        
                @yield('post')
            </div>
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

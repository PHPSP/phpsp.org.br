@extends('_layouts.master')

<?php $isPost = true; ?>

@section('body')
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
@endsection
@extends('_layouts.master')

@section('body')
    <section class="section">
        <div class="content">
            <h1 class="title is-1">{{ $page->title }}</h1>

            @yield('content')
        </div>
    </section>
@endsection
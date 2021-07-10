<?php

?>
@extends('_layouts.master')

@section('body')

    <section class="section">
        <div class="content">
            <h1 class="title is-1">Autores</h1>
            @include('_partials.content.authors.grid')
        </div>

{{--        @include('_partials.layout.pagination')--}}
    </section>
@endsection


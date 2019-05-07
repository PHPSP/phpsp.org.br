<body>
<section id="app" class="section">
    <div class="container">
        @include('_partials.layout.navbar')
        @include('_partials.layout.breadcrumbs')
        @yield('body')
        @include('_partials.layout.contribute')
    </div>
</section>
</body>

<nav class="breadcrumb" aria-label="breadcrumbs">
    <ul>
        <li><a href="/">PHPSP {{$page->type}}</a></li>

        @if ($isPost)
            <li><a href="/artigos">Artigos</a></li>
        @endif

        <li class="is-active"><a href="#" aria-current="page">{{ $page->title }}</a></li>
    </ul>
</nav>
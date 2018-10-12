<?php $authorPosts = $posts->filter(function ($value, $key) use ($page) {
    return $value->author == $page->author && $value->title != $page->title;
})->slice(0,6); ?>
<?php $columns = 3;
$count = 0; ?>
@if ($authorPosts->count() > 0)
    <h4 class="title is-4">Mais posts deste Autor</h4>
    <div class="tile is-ancestor">
        @foreach ($authorPosts as $post)
            <div class="tile is-parent is-4">
                @include('_partials.content.authors.posts-grid-item')
            </div>
            @if(++$count % $columns === 0)
    </div>
    <div class="tile is-ancestor">
        @endif
        @endforeach
    </div>
@endif
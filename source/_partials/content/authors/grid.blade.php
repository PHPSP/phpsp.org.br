<?php
$authors = [];
$authorsPostsCount = [];

foreach ($posts as $post) {
    if (!array_key_exists($post->author, $authorsPostsCount)) {
        $authorsPostsCount[$post->author] = 0;
        $authors[] = (object)[
            'author' => $post->author,
            'authorEmail' => $post->authorEmail,
        ];
    }

    ++$authorsPostsCount[$post->author];
}

$columns = 3;
$count = 0;
?>
@if (count($authors) > 0)
    <div class="tile is-ancestor">
        @foreach ($authors as $author)
            <div class="tile is-parent is-4">
                @include('_partials.content.authors.grid-item', ['author' => $author, 'postCount' => $authorsPostsCount])
            </div>
    @if(++$count % $columns === 0)
    </div>
    <div class="tile is-ancestor">
    @endif
        @endforeach
    </div>
@endif
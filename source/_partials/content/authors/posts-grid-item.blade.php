<article class="tile is-child box">
    <p class="title">
        <a href="{{ $post->getPath() }}">{{ $post->title }}</a>
    </p>
    <p class="subtitle">
        <small> em </small>
        <small>{{ date('d\/m\/Y', $post->createdAt) }}</small>
    </p>
</article>
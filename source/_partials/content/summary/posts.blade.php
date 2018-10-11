<div class="box">
    @foreach ($pagination->items as $post)
        <article class="media">
            <div class="media-left">
                <figure class="image is-64x64">
                    <?php $emailHash = md5( strtolower( trim( $post->authorEmail ) ) ); ?>
                    <img class="is-rounded" src="https://www.gravatar.com/avatar/{{$emailHash}}?s=64&d=retro&r=g" alt="Gravatar de {{ $post->author }}">
                </figure>
            </div>
            <div class="media-content">
                <div class="content">
                    <p>
                        <a href="{{ $post->getPath() }}">{{ $post->title }}</a>
                        <br>
                        <small>por <strong>{{ $post->author }}</strong> em {{ date('d\/m\/Y', $post->createdAt) }}</small>
                    </p>
                </div>
            </div>
        </article>
    @endforeach
</div>
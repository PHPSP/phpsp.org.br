<article class="card">
    <a href="{{ $post->getPath() }}">
        <div class="card-content has-text-black	">
            <div class="media">
                <div class="media-left">
                    <figure class="image is-64x64">
                        <?php $emailHash = md5(strtolower(trim($post->authorEmail))); ?>
                        <img class="is-rounded" src="https://www.gravatar.com/avatar/{{$emailHash}}?s=64&d=retro&r=g" alt="Gravatar de {{ $post->author }}">
                    </figure>
                </div>
                <div class="media-content">
                    <p class="title is-5">{{ $post->author }}</p>
                </div>
            </div>
            <div class="content">
                <br>
                <time class="level-right is-italic is-size-6" datetime="{{ date('d-m-Y', $post->createdAt) }}">{{ date('d\/m\/Y', $post->createdAt) }}</time>
                <p class="is-centered has-text-weight-semibold is-size-5">{{ $post->title }}</p>
            </div>
        </div>
    </a>
</article>
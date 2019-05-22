<article class="tile is-child card">
    <a class="article-item" href="{{ $post->getPath() }}">

        <header class="card-header-title is-centered">
            <figure class="image is-64x64">
                <?php $emailHash = md5(strtolower(trim($post->authorEmail))); ?>
                <img class="is-rounded" src="https://www.gravatar.com/avatar/{{$emailHash}}?s=64&d=retro&r=g" alt="Gravatar de {{ $post->author }}">

            </figure>
        </header>
        <div class="card-content is-paddingless">
            <p class="title is-size-6 has-text-centered	">{{$post->author}}</p>
            <p class="subtitle is-size-7 has-text-centered">
                em <time class="is-size-8" datetime="{{ date('d-m-Y', $post->createdAt) }}">{{ date('d\/m\/Y', $post->createdAt) }}</time>
            </p>
        </div>
        <div class="card-content">
            <p class="is-uppercase is-size-6 has-text-weight-semibold has-text-centered">
                {{ $post->title }}
            </p>
        </div>
    </a>
</article>
<h4 class="title is-4">Sobre o Autor</h4>
<div class="box">
    <article class="media">
        <div class="media-left">
            <figure class="image is-64x64">
                <?php $emailHash = md5(strtolower(trim($page->authorEmail))); ?>
                <img class="is-rounded"
                     src="https://www.gravatar.com/avatar/{{$emailHash}}?s=64&d=retro&r=g"
                     alt="Gravatar de {{ $page->author }}">
            </figure>
        </div>
        <div class="media-content">
            <div class="content">
                <p>
                    <strong>{{ $page->author }}</strong>
                    <small>@johnsmith</small>
                    <small>31m</small>
                    <br>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean efficitur sit amet massa
                    fringilla egestas. Nullam condimentum luctus turpis.
                </p>
            </div>
        </div>
    </article>
</div>
<div class="level is-small">
    @foreach( $page->sponsors as $sponsor)
        <div class="level-item">
            <a href="{{ $sponsor->url }}" target="_blank">
                <figure class="image is-128x128">
                    <img src="{{ $page->asset_prefix }}{{ $sponsor->img }}" title="{{ $sponsor->title }}"
                         alt="{{ $sponsor->title }}">
                </figure>
            </a>
        </div>
    @endforeach
</div>
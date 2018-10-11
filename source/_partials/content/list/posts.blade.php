<?php $columns = 3; $count = 0;?>
<div class="tile is-ancestor">
    @foreach ($pagination->items as $post)
        <div class="tile is-parent is-4">
            @include('_partials.content.item.post')
        </div>
        @if(++$count % $columns === 0)
</div>
<div class="tile is-ancestor">
    @endif
    @endforeach
</div>
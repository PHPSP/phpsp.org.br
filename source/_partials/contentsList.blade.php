<ul>
    @foreach ($contents as $content)
        <li><a href="{{ $content->getPath() }}">{{ $content->title }}</a></li>
    @endforeach
</ul>
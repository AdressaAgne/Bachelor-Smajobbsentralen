<ul>
    <li><a href="/">home</a></li>
    @foreach($menu as $item)
        <li><a href="/page/{{ $item['permalink'] }}">{{ $item['header'] }}</a></li>
    @endforeach
</ul>
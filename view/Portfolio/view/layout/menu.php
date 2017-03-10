<nav class="container">
    <a href="/">home</a> |
    
    @foreach($menu as $item)

        <a href="/page/{{ $item['permalink'] }}">{{ $item['header'] }}</a> |

    @endforeach
</nav>
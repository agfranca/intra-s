<li><a href={{$link_filho->link}}><span>{{ $link_filho->nome }}</span></a></li>
@if ($link_filho->links)
    <ul class="treeview-menu">
        @foreach ($link_filho->links as $linkFilho)
            @include('link_filho', ['link_filho' => $linkFilho])
        @endforeach
    </ul>
@endif


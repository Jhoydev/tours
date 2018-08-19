<nav class="sidebar-nav">
    <ul class="nav">
        @foreach($sidebar_item as $item)
        <li class="nav-item">
            <a class="nav-link" href="{{ $item['link'] }}"><i class="fa fa-user"></i> {{ $item['name'] }}</a>
        </li>
        @endforeach
    </ul>
</nav>
<button class="sidebar-minimizer brand-minimizer" type="button"></button>
<h1>Tyrants</h1>
<nav>
    Filter:
    <a class="btn btn-primary" href="/g/xbx/db/tyrants">All</a>
    <a class="btn btn-primary" href="?lv=0">lv0-19</a>
    <a class="btn btn-primary" href="?lv=20">lv20-39</a>
    <a class="btn btn-primary" href="?lv=40">lv40-59</a>
    <a class="btn btn-primary" href="?lv=60">lvl60+</a>
</nav>
<nav>
    @foreach($results as $category => $categories)
        <a class="btn btn-primary navbar-btn" href="#{{$category}}">{{$category}}</a>
    @endforeach
</nav>
@foreach($results as $continent => $continents)
    <h2 id="{{$continent}}">{{ $continent }}</h2>
    @foreach($continents as $beast_type => $beasts)
        <h3>{{ $beast_type }}</h3>
        <table class="table">
            <thead class="thead-inverse">
            <tr>
                <th style="width:5em">Level</th>
                <th>Name</th>
                <th>Location (~ = spawn not guaranteed; ! = approach to spawn)</th>
                <th>Type</th>
                <th>Continent</th>
                <th>Figure</th>
            </tr>
            </thead>
            @foreach($beasts as $r)
                <tr>
                    <td>{{ $r->lv_string }}</td>
                    <td><a href="/g/xbx/db/tyrant/{{$r->id}}-{{urlencode($r->name)}}">{{$r->name}}</td>
                    @if(!empty($r->location_img))
                        <td>
                            <a href="{!! $r->location_img !!}" target="_blank">
                                <img alt="{{ $r->name }} location" style="width:100px;height:auto" class="pull-right"
                                     src="{!! $r->location_img !!}}">
                            </a>
                            @if(!empty($r->indigen_img))
                                <a href="{!! $r->indigen_img !!}" target="_blank">
                                    <img alt="{{ $r->name }}" style="width:100px;height:auto" class="pull-right"
                                         src="{!! $r->indigen_img !!}}">
                                </a>
                            @endif
                            {{ $r->location }}
                        </td>
                    @else
                        <td>{{ $r->location }}</td>
                    @endif
                    <td>{{ $r->type }}</td>
                    <td>{{ $r->continent }}</td>
                    <td>{{ $r->figure }}</td>
                </tr>
            @endforeach
        </table>
    @endforeach
@endforeach
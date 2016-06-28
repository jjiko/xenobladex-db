<h1>Bestiary</h1>
<nav>
    <a class="btn btn-primary" href="/g/xbx/db/bestiary">All</a>
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
                <th>Name</th>
                <th>Genus</th>
                <th>Type</th>
                <th>Continent</th>
                <th>Location (n=night, hi/lo=high/low, air=flying around)</th>
                <th>Weather</th>
                <th>Time</th>
                <th>Min Level</th>
                <th>Max Level</th>
            </tr>
            </thead>
            @foreach($beasts as $r)
                <tr>
                    <td><a href="/g/xbx/db/bestiary/{{$r->id}}-{{urlencode($r->name)}}">{{$r->name}}</td>
                    <td>{{ $r->genus }}</td>
                    <td>{{ $r->type }}</td>
                    <td>{{ $r->continent }}</td>
                    <td>{{ $r->location }}</td>
                    <td>{{ $r->weather }}</td>
                    <td>{{ $r->time }}</td>
                    <td>{{ $r->lv }}</td>
                    <td>{{ $r->lv_high }}</td>
                </tr>
            @endforeach
        </table>
    @endforeach
@endforeach
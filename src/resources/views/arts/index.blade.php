<h1>Arts</h1>
<table class="table table-hover">
    <thead>
    <tr>
        <th>Name</th>
        <th>Class Rank</th>
        <th>Weapon</th>
        <th>Target</th>
        <th>Element</th>
        <th>TP</th>
        <th>Description</th>
    </tr>
    </thead>
    @foreach($results as $i => $r)
        <tr>
            <td><a href="/g/xbx/db/art/{{$r->id}}-{{urlencode($r->name)}}">{{$r->name}}</td>
            <td>{{$r->class_rank}}</td>
            <td>{{$r->weapon}}</td>
            <td>{{$r->target}}</td>
            <td>{{$r->element}}</td>
            <td>{{$r->tp}}</td>
            <td>{{$r->description}}</td>
        </tr>
    @endforeach
</table>

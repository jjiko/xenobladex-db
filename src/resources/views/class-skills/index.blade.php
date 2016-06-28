<h1>Class Skills</h1>
<table class="table table-condensed">
    @foreach($results as $i => $r)
        @if($i==0)
            <thead class="thead-inverse">
            <tr>
                <td>Name</td>
                <td>Class/Rank</td>
                <td>Effect</td>
            </tr>
            </thead>
        @endif
        <tr>
            <td>{{$r->name}}</td>
            <td>{{$r->class_rank}}</td>
            <td>{{$r->effect}}</td>
        </tr>
    @endforeach
</table>
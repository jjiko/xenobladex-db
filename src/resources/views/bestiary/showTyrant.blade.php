<h1>{{ $r->name }}</h1>
<table class="table table-hover">
    <thead class="thead-inverse">
    <tr>
        <th>Type</th>
        <th>Continent</th>
        <th>Figure</th>
        <th>Location</th>
        <th>Level</th>
    </tr>
    </thead>
    <tr>
        <td>{{ $r->type }}</td>
        <td>{{ $r->continent }}</td>
        <td>{{ $r->figure }}</td>
        @if(!empty($r->location_img))
            <td><a href="{!! $r->location_img !!}}" target="_blank">{{ $r->location }}</a></td>
        @else
            <td>{{ $r->location }}</td>
        @endif
        <td>{{ $r->weather ?: "ANY" }}</td>
        <td>{{ $r->time ?: "ANY" }}</td>
        <td>{{ $r->lv_string }}</td>
    </tr>
</table>
<h2>Stats</h2>
<table class="table table-hover">
    <thead class="thead-inverse">
    <tr>
        <th>Exp</th>
        <th>HP</th>
        <th>Melee Attack</th>
        <th>Melee Accuracy</th>
        <th>Ranged Attack</th>
        <th>Ranged Accuracy</th>
        <th>Potential</th>
        <th>Evasion</th>
        <th>Resistances</th>
    </tr>
    </thead>
    <tr>
        <td>{{ $r->exp }}</td>
        <td>{{ $r->hp }}</td>
        <td>{{ $r->m_pow }}</td>
        <td>{{ $r->m_acc }}</td>
        <td>{{ $r->r_pow }}</td>
        <td>{{ $r->r_acc }}</td>
        <td>{{ $r->potential }}</td>
        <td>{{ $r->evasion }}</td>
        <td>{{ $r->res }}</td>
    </tr>
</table>

<h2>Drops</h2>
@if(count($r->drops))
    <table class="table table-hover">
        @foreach($r->drops as $drop)
            <tr>
                <td><a href="/g/xbx/db/material/{{$drop->id}}-{{$drop->name}}">{{ $drop->name }}</a></td>
            </tr>
        @endforeach
    </table>
@else
    <p>No drops for {{ $r->name }} ({{$r->location}})</p>
@endif
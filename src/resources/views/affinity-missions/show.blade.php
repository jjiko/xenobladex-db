<h1>{!! $r->name !!}</h1>
@if(property_exists($r, 'type'))
    <h2>{!! $r->type !!}</h2>
@endif
<table class="table table-hover">
    <thead>
    <tr>
        <td>Client</td>
        <td>Location</td>
        <td>Story</td>
        <td>Lv</td>
        <td>Party</td>
        <td>Required</td>
        <td>Prohibited</td>
        <td>Prerequisites</td>
    </tr>
    </thead>
    <tr>
        <td>{{ $r->client }}</td>
        <td>{{ $r->client_location }}</td>
        <td>{{ $r->story }}</td>
        <td>{{ $r->lv }}</td>
        <td>{{ $r->party }}</td>
        <td>{!! nl2br($r->required) !!}</td>
        <td>{!! nl2br($r->prohibited) !!}</td>
        <td>{{ $r->prereqs }}</td>
    </tr>
</table>
<h2>Rewards</h2>
<table class="table">
    <thead>
    <tr>
        <td>Items/Skill/Character Unlock</td>
        <td>New Skill</td>
        <td>Credits</td>
        <td>Exp</td>
    </tr>
    </thead>
    <tr>
        <td>{!! nl2br($r->rewards) !!}</td>
        <td><span class="glyphicon glyphicon-{{ $r->skill ? 'ok' : 'remove' }}"></span></td>
        <td>{{ $r->credits }}</td>
        <td>{{$r->exp}}</td>
    </tr>
</table>
<h2>Objectives</h2>
<p>
    {!! nl2br($r->objective) !!}
</p>

@if(property_exists($r, 'notes'))
    <h2>Notes</h2>
    <p>
        {!! nl2br($r->notes) !!}
    </p>
@endif
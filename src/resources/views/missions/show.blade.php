<h1>{!! $r->name !!}</h1>
@if(property_exists($r, 'type'))
    <h2>{!! $r->type !!}</h2>
@endif
<table class="table table-hover">
    <thead>
    <tr>
        <th>Client</th>
        <th>Location</th>
        @if(property_exists($r, 'bl'))
            <th>Blade Level</th>
        @endif
        <th>Story</th>
        <th>Prerequisites</th>
        <th>Gold</th>
        <th>Exp</th>
        <th>Rewards</th>
    </tr>
    </thead>
    <tr>
        <td>{!! $r->client !!}</td>
        <td>{!! $r->location !!}</td>
        @if(property_exists($r, 'bl'))
            <td>
                {!! $r->bl !!}
            </td>
        @endif
        <td>{!! $r->story !!}</td>
        <td>{!! $r->prereqs !!}</td>
        <td>{!! $r->gold !!}</td>
        <td>{!! $r->exp !!}</td>
        <td>>{!! $r->reward !!}</td>
    </tr>
</table>
<h2>Objectives</h2>
<p>
    {!! nl2br($r->objectives) !!}
</p>

@if(!empty($r->notes))
    <h2>Notes</h2>
    <p>
        {!! nl2br($r->notes) !!}
    </p>
@endif
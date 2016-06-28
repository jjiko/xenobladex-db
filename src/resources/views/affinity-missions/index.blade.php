<h1>Affinity Missions</h1>
<table class="table table-hover">
    <thead>
    <tr>
        <td>Name</td>
        <td>Client</td>
        <td>Location</td>
        <td>Story</td>
        <td>Lv</td>
        <td>Party</td>
        <td>Required</td>
        <td>Prohibited</td>
        <td>Prerequisites</td>
        <td>Reward</td>
        <td>New Skill</td>
    </tr>
    </thead>
    @foreach($results as $client => $missions)
        @foreach($missions as $r)
            <tr>
                <td>
                    <a href="{{ sprintf("/g/xbx/db/affinity-mission/%s-%s", $r->id, $r->name) }}">{{$r->name}}</a>
                </td>
                <td>{{ $r->client }}</td>
                <td>{{ $r->client_location }}</td>
                <td>{{ $r->story }}</td>
                <td>{{ $r->lv }}</td>
                <td>{{ $r->party }}</td>
                <td>{!! nl2br($r->required) !!}</td>
                <td>{!! nl2br($r->prohibited) !!}</td>
                <td>{{ $r->prereqs }}</td>
                <td>{{ $r->rewards }}</td>
                <td><span class="glyphicon glyphicon-{{ $r->skill ? 'ok' : 'remove' }}"></span></td>

            </tr>
        @endforeach
    @endforeach
</table>
<h1>{{ $missions_label }} Missions</h1>
<table class="table table-hover">
    <thead>
    <tr>
        <td>Name</td>
        @if($missions_label == "Basic")
            <td>Type</td>
        @endif
        <td>Client</td>
        <td>Location</td>
        @if($missions_label == "Basic")
            <td>Blade Lv</td>
        @endif
        <td>Story</td>
        <td>Prerequisites</td>
        <td>Gold</td>
        <td>Exp</td>
        <td>Reward</td>
        <td>Objectives</td>
    </tr>
    </thead>
    @foreach($results as $r)

        <tr>
            <td>
                <a href="{{ sprintf("/g/xbx/db/%s-mission/%s-%s", strtolower($missions_label), $r->id, $r->name) }}">{{$r->name}}</a>
            </td>
            @if($missions_label == "Basic")
                <td>
                    {{$r->type}}
                </td>
            @endif
            <td>{{$r->client}}</td>
            <td>{{$r->location}}</td>
            @if($missions_label == "Basic")
                <td>{{$r->bl}}</td>
            @endif
            <td>{{$r->story}}</td>
            <td>{{$r->prereqs}}</td>
            <td>{{$r->gold}}</td>
            <td>{{$r->exp}}</td>
            <td>{{$r->reward}}</td>
            <td>{{nl2br($r->objectives)}}</td>
        </tr>
    @endforeach
</table>
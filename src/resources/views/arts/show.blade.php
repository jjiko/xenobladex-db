<a class="btn btn-primary" href="/g/xbx/db/arts">Back to arts</a>
<h1>{{ $r->name }}</h1>
<h2>{{ $r->class_rank }}</h2>
<table class="table table-hover">
    <thead>
    <tr>
        <th>Weapon</th>
        <th>Target</th>
        <th>Element</th>
        <th>TP</th>
        <th>Description</th>
    </tr>
    </thead>
    <tr>
        <td>{{$r->weapon}}</td>
        <td>{{$r->target}}</td>
        <td>{{$r->element}}</td>
        <td>{{$r->tp}}</td>
        <td>{{$r->description}}</td>
    </tr>
</table>

<h3>Stats</h3>
<table class="table">
    <thead>
    <tr>
        <td>Overcast</td>
        <td>Recast</td>
        <td>Multiplier/Recovery</td>
        <td>Hits</td>
        <td>Effect/Aura</td>
        <td>Duration</td>
        <td>Special Conditions</td>
        <td>Aura Effects</td>
    </tr>
    </thead>
    <tr>
        <td>{{$r->overcast}}</td>
        <td>{{$r->recast}}</td>
        <td>{{$r->multiplier_recovery}}</td>
        <td>{{$r->hits}}</td>
        <td>{{$r->effect_aura}}</td>
        <td>{{$r->duration}}</td>
        <td>{{$r->special_conditions}}</td>
        <td>{{$r->aura_effects}}</td>
    </tr>
</table>

<h3>Notes</h3>
<p>{{ $r->notes ?: "N/A" }}</p>
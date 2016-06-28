<h1>Materials</h1>
<h2>Click on a material name to see <a href="/g/xbx/db/bestiary">what drops it</a> and what <a
            href="/g/xbx/db/engineering">engineering
        items</a> use it.</h2>
@foreach($results->chunk(count($results)/4) as $column)
    <div class="col-md-3">
        <table class="table table-responsive">
            @foreach($column as $material)
                <tr>
                    <td><a href="/g/xbx/db/material/{{ sprintf("%s-%s", $material->id, urlencode($material->name)) }}">
                            {{$material->name}}</a></td>
                </tr>
            @endforeach
        </table>
    </div>
@endforeach

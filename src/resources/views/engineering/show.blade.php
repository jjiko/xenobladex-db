@foreach($r as $item)
    <h1>{{ $item->categories()->first()->name }}: {{ $item->name }}</h1>
    <h2>{{ $item->description }}</h2>
    <h3>Materials</h3>
    @if(count($item->materials))
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th style="width:3em">#</th>
                <th>Name</th>
                <th>Ticket Cost</th>
            </tr>
            </thead>
            @foreach($item->materials as $material)
                <tr>
                    <td>{{ $material->pivot->count }}</td>
                    <td><a href="/g/xbx/db/material/{{$material->id}}-{{urlencode($material->name)}}">{{ $material->name }}</a></td>
                    <td>{{ $material->ticket_cost }}</td>
                </tr>
            @endforeach
        </table>
    @endif
@endforeach
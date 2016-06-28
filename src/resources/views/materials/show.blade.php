@foreach($r as $material)
    <h1>{{ $material->name }}</h1>
    <h2>{{ $material->ticket_cost }} Tickets</h2>
    <div class="row">
        <div class="col-md-6">
            <h2>Bestiary</h2>
            <table class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Location</th>
                </tr>
                </thead>
                @foreach($material->bestiary as $beast)
                    <tr>
                        <td>
                            <a href="/g/xbx/db/bestiary/{{$beast->id}}-{{urlencode($beast->name)}}">{{ $beast->name }}</a>
                        </td>
                        <td>{{ $beast->location }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="col-md-6">
            <h2>Engineering</h2>
            <table class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                </tr>
                </thead>
                @foreach($material->engineering as $item)
                    <tr>
                        <td>
                            <a href="/g/xbx/db/engineering/{{$item->id}}-{{urlencode($item->name)}}">{{ $item->name }}</a>
                        </td>
                        <td>
                            {{ $item->category }}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endforeach
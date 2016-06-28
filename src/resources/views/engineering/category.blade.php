<h1>{{ $category_name }} Engineering</h1>
<div class="row">
    <div class="col-md-12">
        <table class="table">
            <thead>
            <tr>
                <td>Name</td>
                @if($category_name=="Special Devices")
                    <td>How to get</td>
                @else
                    <td>Materials</td>
                @endif
            </tr>
            </thead>
            @foreach($results as $item)
                <tr>
                    <td><h4>
                            <a href="/g/xbx/db/engineering/{{$item->id}}-{{urlencode($item->name)}}">{{$item->name}}</a>
                        </h4>
                        <p>{{ $item->description }}</p></td>
                    <td>
                        @if($category_name=="Special Devices")
                            @if(!empty($item->special))
                                {!! $item->special !!}
                            @endif
                        @else
                            @if(count($item->materials))
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th style="width:3em">#</th>
                                        <th>Material Name</th>
                                        <!--<th>Location</th>-->
                                        <th>Tickets</th>
                                    </tr>
                                    </thead>
                                    @foreach($item->materials as $material)
                                        <tr>
                                            <td>{{ $material->pivot->count }}</td>
                                            <td>
                                                <a href="/g/xbx/db/material/{{$material->id}}-{{urlencode($material->name)}}">
                                                    {{ $material->name }}
                                                </a></td>
                                            <!--<td>{{ $material->location }}</td>-->
                                            <td>{{$material->ticket_cost}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
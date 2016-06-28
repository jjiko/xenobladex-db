<div id="frontiernav">
    @foreach($frontiernav as $map_name => $items)
        <h1><?php echo ucwords($map_name); ?></h1>
        <div class="row" data-map-name="<?php echo str_replace(' ', '-', $map_name); ?>">
            <div class="col-xs-8">
                <div id="controls-<?php echo $map_name; ?>">
                    <div class="hidden">
                        <button class="btn btn-default" data-toggle="maps">Toggle Map</button>
                    </div>
                    <span class="btn">Filter</span>
                    <div class="btn-group">
                        <button class="btn btn-primary" data-filter="x-icon-fn">FN Sites</button>
                        <button class="btn btn-primary" data-filter="x-icon-mission">Missions</button>
                        <button class="btn btn-primary" data-filter="x-icon-affinity">Affinity Missions</button>
                        <button class="btn btn-primary" data-filter="x-icon-treasure">Treasure</button>
                        <button class="btn btn-primary" data-filter="x-icon-tyrant">Tyrants</button>
                        <button class="btn btn-default" data-action="reset filters">Reset</button>
                    </div>
                </div>
                <div id="frontiernav-<?php echo str_replace(' ', '-', $map_name); ?>">
                    <div class="alert alert-info" id="info-<?php echo str_replace(' ', '-', $map_name); ?>"
                         style="display: none;right:0"></div>
                    <div id="fn-ids-<?php echo str_replace(' ', '-', $map_name); ?>"></div>
                    <div id="poi-<?php echo str_replace(' ', '-', $map_name); ?>">
                        @foreach($items as $item)
                            <?php $info = json_decode($item->data); ?>
                            @if($item->type == "tyrant")
                                @if(!empty($info->bestiary))
                                    <a class="item-link" href="/g/xbx/db/tyrant/<?php echo sprintf("%s-%s", $info->bestiary->id, $info->name); ?>">
                                        @include('xbx::frontiernav.poi')
                                    </a>
                                @else
                                    @include('xbx::frontiernav.poi')
                                @endif
                            @elseif($item->type == "mission")
                                @if(!empty($info->model))
                                    <a class="item-link" href="/g/xbx/db/normal-mission/<?php echo sprintf("%s-%s", $info->model->id, $info->name); ?>">
                                        @include('xbx::frontiernav.poi')
                                    </a>
                                @else
                                    @include('xbx::frontiernav.poi')
                                @endif
                            @elseif($item->type == "affinity")
                                @if(!empty($info->model))
                                    <a class="item-link" href="/g/xbx/db/affinity-mission/<?php echo sprintf("%s-%s", $info->model->id, $info->name); ?>">
                                        @include('xbx::frontiernav.poi')
                                    </a>
                                @else
                                    @include('xbx::frontiernav.poi')
                                @endif
                            @else
                                @include('xbx::frontiernav.poi')
                            @endif
                        @endforeach
                    </div>
                    <div id="segment-map-<?php echo str_replace(' ', '-', $map_name); ?>" data-map="segment">
                        <img alt="<?php echo $map_name; ?> Segment Map"
                             src="//cdn.joejiko.com/img/gaming/xbx/maps/<?php echo str_replace(" ", "-", $map_name); ?>.png">
                    </div>
                    <div id="terrain-map-<?php echo str_replace(' ', '-', $map_name); ?>" data-map="terrain" hidden>
                        <img alt="<?php echo $map_name; ?> Terrain Map"
                             src="//cdn.joejiko.com/img/gaming/xbx/maps/<?php echo str_replace(" ", "-", $map_name); ?>_terrain_sd.png"
                             width="900" height="877">
                    </div>
                </div>
            </div>
            @if(getenv('APP_ENV') == 'local')
                <div class="col-sm-4">
                    <ul clas="nav">
                        <div class="btn-group">
                            <button class="btn btn-primary" data-action="export">Export Coordinates</button>
                        </div>
                    </ul>
                    <textarea id="export" class="form-control" rows="20"></textarea>
                </div>
            @endif
        </div>
    @endforeach
</div>
<h1>FrontierNav</h1>
<div class="row">
    <div class="col-sm-12">
        <ul class="nav">
            @foreach($maps as $map_name => $v)
                <li>
                    <a class="nav-link" href="/g/xbx/db/frontiernav/<?php echo str_replace(' ', '-', $map_name); ?>">
                        <?php echo ucwords($map_name); ?>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
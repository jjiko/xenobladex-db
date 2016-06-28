<nav class="navbar navbar-default navbar-fixed-top navbar-fixed-top-30">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <div class="navbar-right">
                <span class="alert alert-danger">If there's something missing let me know &rarr;</span>
                <button id="feedback" data-toggle="modal" data-target="#feedbackModal"
                        class="btn btn-default btn-warning navbar-btn">
                    Feedback <i class="material-icons" style="vertical-align:middle">feedback</i>
                </button>
            </div>
            <ul class="nav navbar-nav" style="text-transform: capitalize">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Bestiary <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a class="" href="/g/xbx/db/bestiary">normal</a>
                        <li><a class="" href="/g/xbx/db/tyrants">tyrants</a>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">engineering <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @foreach($engineering_categories as $e_cat)
                            <li><a class="" href="/g/xbx/db/engineering/cat/{{ $e_cat->slug }}">{{ $e_cat->name }}</a>
                        @endforeach
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">FrontierNav <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @foreach($frontiernav_categories as $fn_cat)
                            <li><a class="" href="/g/xbx/db/frontiernav/<?php echo $fn_cat->map; ?>"><?php echo ucwords($fn_cat->map); ?></a></li>
                        @endforeach
                    </ul>
                </li>
                <li><a class="" href="/g/xbx/db/materials">materials</a>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">missions <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a class="" href="/g/xbx/db/affinity-missions">affinity missions</a></li>
                        <li><a class="" href="/g/xbx/db/basic-missions">basic
                                missions</a>
                        <li><a class="" href="/g/xbx/db/normal-missions">normal
                                missions</a>
                    </ul>
                </li>
                <li><a class="" href="/g/xbx/db/arts">arts</a>
                <li><a class=""
                       href="/g/xbx/db/skills">skills</a>
                <li><a class="" href="/g/xbx/db/squad-tasks">squad
                        tasks</a>
            </ul>
        </div>
    </div>
</nav>
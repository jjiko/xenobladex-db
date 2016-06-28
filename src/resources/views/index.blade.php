<div class="row">
    <div class="col-xs-12">
        {!! Jiko\Models\Page\PageSection::where('guid', '{3A1B9CC2-B69B-4327-922F-43E7164BD242}')->first()->content !!}
    </div>
</div>
<div class="row">
    <div class="col-sm-9">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                           aria-expanded="true" aria-controls="collapseOne">
                            Acknowledgements
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <div class="alert alert-success">
                            {!! Jiko\Models\Page\PageSection::where('guid', '{EDE732EE-BC40-4899-97EE-392EC63B8010}')->first()->content !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTwo">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                           href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Helping out
                        </a>
                    </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="panel-body">
                        <div class="alert alert-info">
                            {!! Jiko\Models\Page\PageSection::where('guid', '{F0E3B8D6-0350-418E-B711-376C89333C19}')->first()->content !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingThree">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                           href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Release notes
                        </a>
                    </h4>
                </div>
                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="panel-body">
                        <div class="alert alert-info">
                            {!! Jiko\Models\Page\PageSection::where('guid', '{DFC40BDD-DE2F-4367-B7F7-74AEB6F45540}')->first()->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        @include('xbx::ads.amazon')
    </div>
</div>
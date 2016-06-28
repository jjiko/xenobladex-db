@extends('xbx::base')
@section('scripts.head')
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-9412432435492574",
            enable_page_level_ads: true
        });
    </script>
@stop
@section('scripts.footer')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha256-KXn5puMvxCw+dAYznun+drMdG1IFl3agK0p/pqT9KAo= sha512-2e8qq0ETcfWRI4HJBzQiA3UoyFk6tbNyG+qSaIBZLyW9Xf3sWZHN/lxe9fTh1U45DpPf07yj94KsUHHWe4Yk1A==" crossorigin="anonymous"></script>
    @if($agent->isDesktop())
        <script src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
        <script>
            jQuery(document).ready(function ($) {
                if (
                        window.location.href.indexOf("bestiary") > -1
                        || window.location.href.indexOf("tyrant") > -1
                        || window.location.href.indexOf("missions") > -1
                ) {
                    window.$tables = $('.table').DataTable({
                        paging: false
                    });
                }
            });
        </script>
    @endif
    <script>
        $(document).ready(function($){
           $("#feedbackModal").on('show.bs.modal', function(){
              var $modal = $(this);
               $modal.find('.sent').hide();
               $modal.find('.pre').show();
               $modal.find('form').show();
           });
        });
    </script>
@stop
@section('styles')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    @if($agent->isDesktop())
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css">
    @endif
    <link rel="stylesheet" href="/dist/css/main.css">
    <link rel="stylesheet" href="/dist/css/xbxdb.css">
@stop
@section('app')
    @include("xbx::layout.search")
    @include("xbx::layout.navbar")
    <div id="xbx-container" class="container">
        @if(!$agent->isDesktop())
        <div class="row">
            <div class="col-sm-12">
                @include('xbx::ads.google-2')
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-sm-11">
                @if(empty($content))
                    @include('xbx::index')
                @else
                    <?php echo $content; ?>
                @endif
            </div>
            <div class="col-sm-1">
                @if(!empty($content))
                    @include('xbx::ads.google')
                @endif
                <div class="row">
                    <div class="col-xs-12">@include('xbx::layout.brand')</div>
                </div>
            </div>
        </div>
        <div class="row hidden-xs">
            <div class="col-sm-12">
                <a class="btn btn-lg btn-link" href="/">
                    <div class="logo-ico-32">{!! file_get_contents(img_path('img/shared/logo.svg')) !!}</div>
                    << joejiko.com
                </a>
            </div>
        </div>
    </div>
    @include('xbx::layout.modals.feedback')
    <script>
        (function() {
            var cx = '003680385983546366489:2ovxeacsqog';
            var gcse = document.createElement('script');
            gcse.type = 'text/javascript';
            gcse.async = true;
            gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
                    '//cse.google.com/cse.js?cx=' + cx;
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(gcse, s);
        })();
    </script>
    <gcse:searchresults-only></gcse:searchresults-only>
    <form id="triggerSearch" method="GET" hidden><input name="q" type="text"><button type="submit">search</button></form>
@stop
var $ = require('jquery');
// movable items
var editMode = $("#frontiernav").is("[data-mode=edit]");
if (editMode) {
    $('body').on('mousedown', '.x-icon', function(evt){
        $(this).addClass('dragging').parents().on('mousemove', function(e){
           $('.dragging').offset({
               top: e.pageY - $('.dragging').outerHeight() / 2
           }).on('mouseup', function(){
               $(this).removeClass('dragging');
           });
        });
        evt.preventDefault();
    }).on('mouseup', function(){
        $('.dragging').removeClass('.dragging');
    });
}

function show_info(type, info, key) {
    var $info = this;
    switch (type) {
        case "affinity":
            $info
                .append($("<h4 />").append(info.name))
                .append($("<p />").append("<strong>Requirements:</strong> " + info.requirements));
            break;

        case "fn":
            $info
                .append($("<h4 />").append("FN Site " + info.id))
                .append($("<p />").append("<strong>Mechanical Level</strong> " + info.requirements))
                .append($("<p />").append("<strong>Production:</strong> " + info.production))
                .append($("<p />").append("<strong>Revenue:</strong> " + info.revenue))
                .append($("<p />").append("<strong>Combat support:</strong> " + info.combat_support))
                .append($("<p />").append("<strong>Sightseeing spots:</strong> " + info.sightseeing_spots))
                .append($("<p />").append("<strong>Resources:</strong> " + info.mineable_resources))
            break;

        case "mission":
            $info
                .append($("<h4 />").append(info.name))
                .append($("<p />").append("<strong>Client:</strong> " + info.client))
                .append($("<p />").append("<strong>Requirements:</strong> " + info.requirements));
            break;

        case "tyrant":
            $info
                .append($("<h4 />").append(info.name + " (lv." + info.level + ")"))
                .append($("<p />").append("<strong>Subcategory:</strong> " + info.subcategory))
                .append($("<p />").append("<strong>Location:</strong> " + info.location))
                .append($("<p />").append("<strong>Appears:</strong> " + info.appears));
            break;

        case "treasure":
            $info
                .append($("<h4 />").append(info.type))
                .append($("<p />").append("<strong>Requirements:</strong> " + info.requirements))
                .append($("<p />").append("<strong>Rewards:</strong> " + info.rewards))
            break;

        default:
            $info.append($("<h4 />").append(info.name));
    }
    if(editMode) {
        $info.find('h4').append("[" + key.toUpperCase() + "]");
    }
    $info.show();
};

function hide_info() {
    this.empty().hide();
}

$('.row[data-map-name]').each(function (i, e) {
    var $row = $(e);
    var map = $row.attr('data-map-name');
    var $info = $("#info-" + map);
    $(".x-icon-fn").each(function (i, e) {
        var $e = $(e);
        var info = JSON.parse($e.attr('data-info'));
        if (!editMode) {
            var $span = $('<span class="fn-site-id" />')
                .css({
                    left: $e.position().left + "px",
                    top: ($e.position().top + 15) + "px"
                })
                .append("FN" + info.id);
            $span.on('mouseenter', function (evt) {
                var e_info = JSON.parse($e.attr('data-info'));
                show_info.apply($info, [$e.attr('data-type'), info, $e.attr('data-key')]);
            });
            $span.on('mouseleave', function (evt) {
                hide_info.apply($info)
            });
            $("#fn-ids-" + map).append($span);
        }
    });

    $(".x-icon").each(function (i, e) {
        var $e = $(e);
        $e.on('mouseenter', function (evt) {
            var e_info = JSON.parse($e.attr('data-info'));
            show_info.apply($info, [$e.attr('data-type'), e_info, $e.attr('data-key')]);
        });
        $e.on('mouseleave', function (evt) {
            hide_info.apply($info)
        });
    });
});

$("[id^=controls-] button[data-toggle=maps]").on('click', function (evt) {
    var map = $(this).parents('.row').attr('data-map-name')
    $("#terrain-map-" + map).toggle();
});

$("[id^=controls] button[data-filter]").on('click', function (evt) {
    var $this = $(this);
    var map = $this.parents('.row').attr('data-map-name');
    $("#frontiernav-" + map + " .x-icon").hide();
    $("#frontiernav-" + map + " ." + $this.attr('data-filter')).show();
});

$('[id^=controls] button[data-action="reset filters"]').on('click', function () {
    var map = $(this).parents('.row').attr('data-map-name');
    $('#frontiernav-' + map + ' .x-icon').show();
});

// export json
$("[data-action=export]").on('click', function () {
    var data = {};
    $('.x-icon').each(function (i, e) {
        var $e = $(e);
        data[$e.attr('data-key')] = $e.css('top');
    });
    $("textarea#export").text(JSON.stringify(data));

    return false;
})
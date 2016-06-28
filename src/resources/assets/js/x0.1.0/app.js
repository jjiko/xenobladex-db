$ = require('jquery');
var $app = $({});

// trigger build
module.exports = {
    "search": null,
    init: function () {
        $app.on('app.done', function () {
            //
        });
        $(document).on('click', '.modal .btn', function () {
            var $this = $(this);
            $this.prop('disabled', true).empty().append('Sending..');

            var $modal = $(this).parents('.modal');
            var $form = $modal.find('form');

            var jqxhr = $.ajax({
                type: "POST",
                url: $form.attr('action'),
                data: $form.serialize(),
                success: function(msg) {
                    $this.prop('disabled', false).empty().append('Send');

                    $modal.find('.pre').hide();
                    $modal.find('.modal-body form').hide();
                    $modal.find('.sent').show();
                },
                error: function() {
                    alert("Something went wrong.. sorry.");
                }
            });

            return false;
        });
        $app.trigger({type: "app.start"});
        if ($('.typeahead').length) require('./app/typeahead.js').init();
        $(document).on('keydown', function(evt){
            if(evt.keyCode == 13) {
                var $searchInput = $("#xbxdb-search-input");
                var q = $searchInput.prop('value');
                var $search = $("#triggerSearch");
                $search.find("input[name=q]").prop('value', q);
                if($searchInput.is(":focus")) {
                    $("#triggerSearch").submit();
                }
            }
        })
        if ($('#frontiernav').length) require('./app/frontiernav.js');
        $app.trigger({type: "app.done"});
    }
};
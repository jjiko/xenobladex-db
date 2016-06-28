var $ = require('jquery');
require('../../vendor/typeahead.bundle.js');
var Bloodhound = require('bloodhound-js');
// instantiate the bloodhound suggestion engine
var jqxhr = $.get('/g/xbx/db/all.json', function(data){
    var arts = new Bloodhound({
        datumTokenizer: function (d) {
            return Bloodhound.tokenizers.whitespace(d.n);
        },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        limit: 8,
        initialize: true,
        local: data.engineering.items
    });
    var bestiary = new Bloodhound({
        datumTokenizer: function (d) {
            return Bloodhound.tokenizers.whitespace(d.n);
        },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        limit: 8,
        initialize: true,
        local: data.bestiary.items
    });
    var class_skills = new Bloodhound({
        datumTokenizer: function (d) {
            return Bloodhound.tokenizers.whitespace(d.n);
        },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        limit: 8,
        initialize: true,
        local: data.skills.items
    });
    var engineering = new Bloodhound({
        datumTokenizer: function (d) {
            return Bloodhound.tokenizers.whitespace(d.n);
        },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        limit: 8,
        initialize: true,
        local: data.engineering.items
    });
    var tyrants = new Bloodhound({
        datumTokenizer: function (d) {
            return Bloodhound.tokenizers.whitespace(d.n);
        },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        limit: 8,
        initialize: true,
        local: data.tyrants.items
    });
    var materials = new Bloodhound({
        datumTokenizer: function (d) {
            return Bloodhound.tokenizers.whitespace(d.n);
        },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        limit: 8,
        initialize: true,
        local: data.materials.items
    });
    var missions_affinity = new Bloodhound({
        datumTokenizer: function (d) {
            return Bloodhound.tokenizers.whitespace(d.n);
        },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        limit: 8,
        initialize: true,
        local: data.affinity_missions.items
    });
    var missions_basic = new Bloodhound({
        datumTokenizer: function (d) {
            return Bloodhound.tokenizers.whitespace(d.n);
        },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        limit: 8,
        initialize: true,
        local: data.basic_missions.items
    });
    var missions_normal = new Bloodhound({
        datumTokenizer: function (d) {
            return Bloodhound.tokenizers.whitespace(d.n);
        },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        limit: 8,
        initialize: true,
        local: data.normal_missions.items
    });
    var squad_tasks = new Bloodhound({
        datumTokenizer: function (d) {
            return Bloodhound.tokenizers.whitespace(d.n);
        },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        limit: 8,
        initialize: true,
        local: data.squad_tasks.items
    });

    $('.typeahead').typeahead({
            highlight: true
        },
        {
            displayKey: 'n',
            source: bestiary.ttAdapter(),
            templates: {
                header: '<div class="col-sm-12"><h3 class="table-name"><a href="/g/xbx/db/bestiary">Bestiary</a></h3></div>',
                suggestion: function (data) {
                    return ['<div class="col-sm-12"><p>', data.n, '<br><em>', data.d, '</em></p></div>'].join('\n');
                },
                footer: ''
            }
        },
        {
            displayKey: 'n',
            source: tyrants.ttAdapter(),
            templates: {
                header: '<div class="col-sm-12"><h3 class="table-name"><a href="/g/xbx/db/tyrants">Tyrants</a></h3></div>',
                suggestion: function (data) {
                    return ['<div class="col-sm-12"><p>', data.n, '<br><em>', data.d, '</em></p></div>'].join('\n');
                },
                footer: ''
            }
        },
        {
            displayKey: 'n',
            source: engineering.ttAdapter(),
            templates: {
                header: '<div class="col-sm-12"><h3 class="table-name"><a href="/g/xbx/db/engineering">Engineering</a></h3></div>',
                suggestion: function (data) {
                    return ['<div class="col-sm-12"><p>', data.n, '<br><em>', data.d, '</em></p></div>'].join('\n');
                },
                footer: ''
            }
        },
        {
            displayKey: 'n',
            source: materials.ttAdapter(),
            templates: {
                header: '<div class="col-sm-12"><h3 class="table-name"><a href="/g/xbx/db/bestiary">Materials</a></h3></div>',
                suggestion: function (data) {
                    return ['<div class="col-sm-12"><p>', data.n, '<br><em>', data.d, '</em></p></div>'].join('\n');
                },
                footer: ''
            }
        },
        {
            displayKey: 'n',
            source: class_skills.ttAdapter(),
            templates: {
                header: '<div class="col-sm-12"><h3 class="table-name"><a href="/g/xbx/db/skills">Class Skills</a></h3></div>',
                suggestion: function (data) {
                    return ['<div class="col-sm-12"><p>', data.n, '<br><em>', data.d, '</em></p></div>'].join('\n');
                },
                footer: ''
            }
        },
        {
            displayKey: 'n',
            source: arts.ttAdapter(),
            templates: {
                header: '<div class="col-sm-12"><h3 class="table-name"><a href="/g/xbx/db/arts">Arts</a></h3></div>',
                suggestion: function (data) {
                    return ['<div class="col-sm-12"><p>', data.n, '<br><em>', data.d, '</em></p></div>'].join('\n');
                },
                footer: ''
            }
        },
        {
            displayKey: 'n',
            source: missions_affinity.ttAdapter(),
            templates: {
                header: '<div class="col-sm-12"><h3 class="table-name"><a href="/g/xbx/db/affinity-missions">Affinity Missions</a></h3></div>',
                suggestion: function (data) {
                    return ['<div class="col-sm-12"><p>', data.n, '<br><em>', data.d, '<em></p></div>'].join('\n');
                },
                footer: ''
            }
        },
        {
            displayKey: 'n',
            source: missions_basic.ttAdapter(),
            templates: {
                header: '<div class="col-sm-12"><h3 class="table-name"><a href="/g/xbx/db/basic-missions">Basic Missions</a></h3></div>',
                suggestion: function (data) {
                    return ['<div class="col-sm-12"><p>', data.n, '<br><em>', data.d, '<em></p></div>'].join('\n');
                },
                footer: ''
            }
        },
        {
            displayKey: 'n',
            source: missions_normal.ttAdapter(),
            templates: {
                header: '<div class="col-sm-12"><h3 class="table-name"><a href="/g/xbx/db/normal-missions">Normal Missions</a></h3></div>',
                suggestion: function (data) {
                    return ['<div class="col-sm-12"><p>', data.d, '<br><em>', data.n, '</em></p></div>'].join('\n');
                },
                footer: ''
            }
        },
        {
            displayKey: 'n',
            source: squad_tasks.ttAdapter(),
            templates: {
                header: '<div class="col-sm-12"><h3 class="table-name"><a href="/g/xbx/db/squad-tasks">Squad Tasks</a></h3></div>',
                suggestion: function (data) {
                    return ['<div class="col-sm-12"><p>', data.n, '<br><em>', data.d, '</em></p></div>'].join('\n');
                },
                footer: ''
            }
        })
        .on('typeahead:selected', function (event, data, dataset) {
            window.location.href = data.l;
        });
});
// public
module.exports = {
    init: function () {
    }
}
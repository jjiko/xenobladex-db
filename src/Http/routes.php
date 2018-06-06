<?php
Route::group(['middleware' => 'bindings'], function () {
  Route::get('admin/xbx/bestiary-materials', 'Jiko\XBXDB\Admin\Http\Controllers\AdminPageController@bestiaryMaterials');
  Route::get('admin/frontiernav', function () {
    $frontiernav = new \Jiko\XBXDB\Support\Helpers\FrontierNav();
    //return $frontiernav->csvToJson('Jiko/XBXDB/src/storage/oblivia.csv',false);
    return $frontiernav->importV2('Jiko/XBXDB/src/storage/sylvalum_v2.json');
  });

  Route::group(['prefix' => '/g/xbx/db'], function () {
    Route::get('all.json', 'DataController@all');
    Route::get('arts.json', 'DataController@arts');
    Route::get('bestiary.json', 'DataController@bestiary');
    Route::get('class_skills.json', 'DataController@skills');
    Route::get('engineering.json', 'DataController@engineering');
    Route::get('materials.json', 'DataController@materials');
    Route::get('missions_affinity.json', 'DataController@missionsAffinity');
    Route::get('missions_basic.json', 'DataController@missionsBasic');
    Route::get('missions_normal.json', 'DataController@missionsNormal');
    Route::get('squad_tasks.json', 'DataController@squadTasks');
    Route::get('tyrants.json', 'DataController@tyrants');

    // 302
    Route::get('basic-missions/{any}', function ($request) {
      return Redirect::to('/g/xbx/db/basic-mission/' . $request, 301);
    })->where('any', '.*');
    Route::get('normal-missions/{any}', function ($request) {
      return Redirect::to('/g/xbx/db/normal-mission/' . $request, 301);
    })->where('any', '.*');
    Route::get('arts/{any}', function ($request) {
      return Redirect::to('/g/xbx/db/art/' . $request, 301);
    })->where('any', '.*');
    Route::get('skills/{any}', function ($request) {
      return Redirect::to('/g/xbx/db/skill/' . $request, 301);
    })->where('any', '.*');
    Route::get('materials/{any}', function ($request) {
      return Redirect::to('/g/xbx/db/material/' . $request, 301);
    })->where('any', '.*');
    Route::get('squad-tasks/{any}', function ($request) {
      return Redirect::to('/g/xbx/db/squad-task/' . $request, 301);
    })->where('any', '.*');
    Route::get('tyrants/{any}', function ($request) {
      return Redirect::to('/g/xbx/db/tyrant/' . $request, 301);
    })->where('any', '.*');

    Route::get('/', 'XbxDbController@index')->name('xbxdb');
    Route::get('affinity-missions', 'AffinityMissionsController@index')->name('affinity_missions_index');
    Route::get('affinity-mission/{affinity_mission}-{slug}', 'AffinityMissionsController@show')->name('missions.affinity-mission');
    Route::get('arts', 'ArtsController@index')->name('arts_index');
    Route::get('art/{arts}', 'ArtsController@show')->name('arts.art');
    Route::get('basic-missions', 'BasicMissionsController@index')->name('basic_missions_index');
    Route::get('basic-mission/{basic_mission}-{slug}', 'BasicMissionsController@show')->name('missions.basic-mission');
    Route::get('bestiary', 'BestiaryController@index')->name('bestiary_index');
    Route::get('bestiary/{bestiary}-{slug}', 'BestiaryController@show')->name('bestiary.indigen');
    Route::get('bestiary/{bestiary_category}', 'BestiaryController@index');
    Route::get('engineering', 'EngineeringController@index')->name('engineering_index');
    Route::get('engineering/cat/{engineering_category}', 'EngineeringController@category');
    Route::get('engineering/{engineering}-{slug}', 'EngineeringController@show');
    Route::get('engineering/{engineering_name}', function ($value) {
      if ($model = Jiko\XBXDB\Models\Engineering::where('name', urldecode($value))->first()) {
        return Redirect::to(sprintf('/g/xbx/db/engineering/%s-%s', $model->id, $value), 301);
      }

      // @todo mark as 404
      return Redirect::to('/g/xbx/db/engineering');
    });
    Route::get('frontiernav', 'FrontierNavController@index')->name('frontiernav_index');
    Route::get('frontiernav/{frontiernav_map}', 'FrontierNavController@show')->name('frontiernav_map');
    Route::get('materials', 'MaterialsController@index')->name('materials_index');
    Route::get('material/{materials}-{slug}', 'MaterialsController@show');
    Route::get('normal-missions', 'NormalMissionsController@index')->name('normal_missions_index');
    Route::get('normal-mission/{normal_mission}-{slug}', 'NormalMissionsController@show');
    Route::get('skills', 'SkillsController@index')->name('skills_index');
    Route::get('skill/{skills}-{slug}', 'SkillsController@show');
    Route::get('squad-tasks', 'SquadTasksController@index')->name('squad_tasks_index');
    Route::get('squad-task/{squad_task_collection}', 'SquadTasksController@show');
    Route::get('tyrants/{tyrants_category}', 'BestiaryController@tyrantsByCategory');
    Route::get('tyrant/{bestiary}-{slug}', 'BestiaryController@showTyrant');
    Route::get('tyrants', 'BestiaryController@tyrants')->name('tyrants_index');
    //Route::get('{table}', 'XenobladeXDBController@category');
    //Route::get('{table}/{slug}', 'XenobladeXDBController@show')->where('slug', '^[^0-9].+');
    //Route::get('squad-tasks/{id}', 'XenobladeXDBController@showSquadTasks');
    //Route::get('{table}/{id}-{slug}', 'XenobladeXDBController@show');
  });
});
<?php
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

  Route::get('/', ['as' => 'xbxdb', 'uses' => 'XbxDbController@index']);
  Route::get('affinity-missions', ['as' => 'affinity_missions_index', 'uses' => 'AffinityMissionsController@index']);
  Route::get('affinity-mission/{affinity_mission}-{slug}', ['as' => 'missions.affinity-mission', 'uses' => 'AffinityMissionsController@show']);
  Route::get('arts', ['as' => 'arts_index', 'uses' => 'ArtsController@index']);
  Route::get('art/{arts}', ['as' => 'arts.art', 'uses' => 'ArtsController@show']);
  Route::get('basic-missions', ['as' => 'basic_missions_index', 'uses' => 'BasicMissionsController@index']);
  Route::get('basic-mission/{basic_mission}-{slug}', ['as' => 'missions.basic-mission', 'uses' => 'BasicMissionsController@show']);
  Route::get('bestiary', ['as' => 'bestiary_index', 'uses' => 'BestiaryController@index']);
  Route::get('bestiary/{bestiary}-{slug}', ['as' => 'bestiary.indigen', 'uses' => 'BestiaryController@show']);
  Route::get('bestiary/{bestiary_category}', 'BestiaryController@index');
  Route::get('engineering', ['as' => 'engineering_index', 'uses' => 'EngineeringController@index']);
  Route::get('engineering/cat/{engineering_category}', 'EngineeringController@category');
  Route::get('engineering/{engineering}-{slug}', 'EngineeringController@show');
  Route::get('engineering/{engineering_name}', function($value){
    if($model = Jiko\XBXDB\Models\Engineering::where('name', urldecode($value))->first()) {
      return Redirect::to(sprintf('/g/xbx/db/engineering/%s-%s', $model->id, $value), 301);
    }

    // @todo mark as 404
    return Redirect::to('/g/xbx/db/engineering');
  });
  Route::get('frontiernav', ['as' => 'frontiernav_index', 'uses' => 'FrontierNavController@index']);
  Route::get('frontiernav/{frontiernav_map}', ['as' => 'frontiernav_map', 'uses' => 'FrontierNavController@show']);
  Route::get('materials', ['as' => 'materials_index', 'uses' => 'MaterialsController@index']);
  Route::get('material/{materials}-{slug}', 'MaterialsController@show');
  Route::get('normal-missions', ['as' => 'normal_missions_index', 'uses' => 'NormalMissionsController@index']);
  Route::get('normal-mission/{normal_mission}-{slug}', 'NormalMissionsController@show');
  Route::get('skills', ['as' => 'skills_index', 'uses' => 'SkillsController@index']);
  Route::get('skill/{skills}-{slug}', 'SkillsController@show');
  Route::get('squad-tasks', ['as' => 'squad_tasks_index', 'uses' => 'SquadTasksController@index']);
  Route::get('squad-task/{squad_task_collection}', 'SquadTasksController@show');
  Route::get('tyrants/{tyrants_category}', 'BestiaryController@tyrantsByCategory');
  Route::get('tyrant/{bestiary}-{slug}', 'BestiaryController@showTyrant');
  Route::get('tyrants', ['as' => 'tyrants_index', 'uses' => 'BestiaryController@tyrants']);
  //Route::get('{table}', 'XenobladeXDBController@category');
  //Route::get('{table}/{slug}', 'XenobladeXDBController@show')->where('slug', '^[^0-9].+');
  //Route::get('squad-tasks/{id}', 'XenobladeXDBController@showSquadTasks');
  //Route::get('{table}/{id}-{slug}', 'XenobladeXDBController@show');
});
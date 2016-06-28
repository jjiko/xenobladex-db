<?php
Route::get('maintenance', function(){
  $collection = \Jiko\XBXDB\Models\Materials::with('bestiary')->get();
  $collection2 = \Jiko\XBXDB\Models\Bestiary::with('drops')->get();
  \DB::connection('xbx')->enableQueryLog();
  foreach($collection2 as $model) {
    if($model->drops->count() < 1) {
      if($model->drop_1 !== null) {
        $drop = DB::connection('xbx')->select('select * from materials where lower(name) = :name', ['name' => strtolower($model->drop_1)]);
        if($drop) {
          $materials[] = collect($drop)->first()->id;
        }
      }
      if($model->drop_2 !== null) {
        $drop = DB::connection('xbx')->select('select * from materials where lower(name) = :name', ['name' => strtolower($model->drop_2)]);
        if($drop) {
          $materials[] = collect($drop)->first()->id;
        }
      }
      if($model->drop_3 !== null) {
        $drop = DB::connection('xbx')->select('select * from materials where lower(name) = :name', ['name' => strtolower($model->drop_3)]);
        if($drop) {
          $materials[] = collect($drop)->first()->id;
        }
      }
      if($model->drop_4 !== null) {
        $drop = DB::connection('xbx')->select('select * from materials where lower(name) = :name', ['name' => strtolower($model->drop_4)]);
        if($drop) {
          $materials[] = collect($drop)->first()->id;
        }
      }
      if($model->drop_5 !== null) {
        $drop = DB::connection('xbx')->select('select * from materials where lower(name) = :name', ['name' => strtolower($model->drop_5)]);
        if($drop) {
          $materials[] = collect($drop)->first()->id;
        }
      }
      if($model->drop_6 !== null) {
        $drop = DB::connection('xbx')->select('select * from materials where lower(name) = :name', ['name' => strtolower($model->drop_6)]);
        if($drop) {
          $materials[] = collect($drop)->first()->id;
        }
      }
      if($model->drop_7 !== null) {
        $drop = DB::connection('xbx')->select('select * from materials where lower(name) = :name', ['name' => strtolower($model->drop_7)]);
        if($drop) {
          $materials[] = collect($drop)->first()->id;
        }
      }
      if(!isset($materials)) {
        continue;
      }
      foreach($materials as $material_id) {
        echo $material_id."<br>";
        $model->drops()->attach($material_id);
      }
      dd("stop.. ".$model->id);
    }
  }
  return view('xbx::maintenance.index')
    ->with('collection', $collection)
    ->with('collection2', $collection2);
});
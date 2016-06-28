<?php
namespace Jiko\XBXDB\Http\Controllers;

use Jiko\Http\Controllers\Controller;

use Illuminate\Support\Facades\Cache;

use Jiko\XBXDB\Models\AffinityMissions;
use Jiko\XBXDB\Models\Arts;
use Jiko\XBXDB\Models\Bestiary;
use Jiko\XBXDB\Models\BasicMissions;
use Jiko\XBXDB\Models\Engineering;
use Jiko\XBXDB\Models\Materials;
use Jiko\XBXDB\Models\NormalMissions;
use Jiko\XBXDB\Models\Skills;
use Jiko\XBXDB\Models\SquadTasks;

class DataController extends Controller
{
  public function all()
  {
    $r = Cache::remember('all_json', 120, function(){
      $r = (object) [];
      $categories = ['arts', 'bestiary', 'tyrants', 'engineering', 'materials', 'basic_missions', 'normal_missions', 'affinity_missions', 'skills', 'squad_tasks'];
      foreach($categories as $category) {
        $r->{$category} = (object) [
          'title' => ucwords(str_replace('_',' ',$category)),
          'href' => route($category."_index"),
          'items' => []
        ];
      }

      foreach(Arts::get() as $row) {
        $r->arts->items[] = (object)[
          'n' => $row->name,
          'd' => $row->class_rank,
          'l' => sprintf("/g/xbx/db/art/%d-%s", $row->id, urlencode($row->name))
        ];
      }

      foreach (Bestiary::normal()->get() as $row) {
        $r->bestiary->items[] = (object)[
          'n' => sprintf("%s (%s, %s) lv.%s", $row->name, $row->genus, $row->type, $row->lv),
          'd' => sprintf("%s:%s", $row->continent, $row->location),
          'l' => sprintf("/g/xbx/db/bestiary/%s-%s", $row->id, urlencode($row->name))
        ];
      }

      foreach (Bestiary::tyrants()->get() as $row) {
        $r->tyrants->items[] = (object)[
          'n' => sprintf("%s (%s) lv.%s", $row->name, $row->location, $row->lv),
          'd' => sprintf("%s:%s", $row->continent, $row->location),
          'l' => sprintf("/g/xbx/db/%s/%s-%s", 'tyrant', $row->id, urlencode($row->name))
        ];
      }

      foreach (Engineering::get() as $row) {
        $r->engineering->items[] = (object)[
          'n' => sprintf("%s (%s)", $row->name, $row->category),
          'd' => $row->description,
          'l' => sprintf("/g/xbx/db/engineering/%s-%s", $row->id, urlencode($row->name))
        ];
      }

      foreach (Materials::with('bestiary')->get() as $material) {
        $beast_list = [];
        foreach ($material->bestiary as $beast) {
          $beast_list[] = $beast->name;
        }
        $r->materials->items[] = (object)[
          'n' => $material->name,
          'd' => join(', ', $beast_list),
          'l' => sprintf("/g/xbx/db/material/%s-%s", $material->id, urlencode($material->name))
        ];
      }

      foreach (AffinityMissions::get() as $row) {
        $r->affinity_missions->items[] = (object)[
          'n' => $row->name,
          'd' => sprintf("%s (%s)", $row->client, $row->client_location),
          'l' => sprintf("/g/xbx/db/affinity-mission/%d-%s", $row->id, urlencode($row->name))
        ];
      }

      foreach (BasicMissions::get() as $row) {
        $r->basic_missions->items[] = (object)[
          'n' => $row->name,
          'd' => $row->objectives,
          'l' => sprintf("/g/xbx/db/basic-mission/%d-%s", $row->id, urlencode($row->name))
        ];
      }

      foreach (NormalMissions::get() as $row) {
        $r->normal_missions->items[] = (object)[
          'n' => $row->name,
          'd' => $row->objectives,
          'l' => sprintf("/g/xbx/db/%s/%d-%s", 'normal-mission', $row->id, urlencode($row->name))
        ];
      }

      foreach (Skills::get() as $row) {
        $r->skills->items[] = (object)[
          'n' => $row->name,
          'd' => $row->class_rank,
          'l' => sprintf("/g/xbx/db/%s/%d-%s", 'skill', $row->id, urlencode($row->name))
        ];
      }

      foreach (SquadTasks::get() as $row) {
        $r->squad_tasks->items[] = (object)[
          'n' => "Squad Task " . $row->name,
          'd' => sprintf("%s %s (%s:%s)", $row->objective, $row->target, $row->region, $row->location),
          'l' => sprintf("/g/xbx/db/%s/%s", 'squad-task', urlencode($row->name))
        ];
      }

      return $r;
    });

    return response()->json($r);
  }
  public function arts()
  {
    $searchable_results = [];
    $class_skills = Arts::get();
    foreach ($class_skills as $row) {
      $searchable_results[] = (object)[
        'n' => $row->name,
        'd' => $row->class_rank,
        'l' => sprintf("/g/xbx/db/art/%d-%s", $row->id, urlencode($row->name))
      ];
    }
    return response()->json($searchable_results);
  }

  public function bestiary()
  {
    $searchable_results = [];
    $results = Bestiary::normal()->get();
    foreach ($results as $row) {
      $searchable_results[] = (object)[
        'n' => sprintf("%s (%s, %s) lv.%s", $row->name, $row->genus, $row->type, $row->lv),
        'd' => sprintf("%s:%s", $row->continent, $row->location),
        'l' => sprintf("/g/xbx/db/bestiary/%s-%s", $row->id, urlencode($row->name))
      ];
    }
    return response()->json($searchable_results);
  }

  public function engineering()
  {
    $searchable_results = [];
    $results = Engineering::get();
    foreach ($results as $row) {
      $searchable_results[] = (object)[
        'n' => sprintf("%s (%s)", $row->name, $row->category),
        'd' => $row->description,
        'l' => sprintf("/g/xbx/db/engineering/%s-%s", $row->id, urlencode($row->name))
      ];
    }
    return response()->json($searchable_results);
  }

  public function materials()
  {
    $searchable_results = [];
    $results = Materials::with('bestiary')->get();
    foreach ($results as $material) {
      $beast_list = [];
      foreach ($material->bestiary as $beast) {
        $beast_list[] = $beast->name;
      }
      $searchable_results[] = (object)[
        'n' => $material->name,
        'd' => join(', ', $beast_list),
        'l' => sprintf("/g/xbx/db/material/%s-%s", $material->id, urlencode($material->name))
      ];
    }
    return response()->json($searchable_results);
  }

  public function missionsAffinity()
  {
    $missions = AffinityMissions::get();

    foreach ($missions as $row) {
      $searchable_results[] = (object)[
        'n' => $row->name,
        'd' => sprintf("%s (%s)", $row->client, $row->client_location),
        'l' => sprintf("/g/xbx/db/affinity-mission/%d-%s", $row->id, urlencode($row->name))
      ];
    }
    return response()->json($searchable_results);
  }

  public function missionsBasic()
  {
    $missions = BasicMissions::get();

    foreach ($missions as $row) {
      $searchable_results[] = (object)[
        'n' => $row->name,
        'd' => $row->objectives,
        'l' => sprintf("/g/xbx/db/basic-mission/%d-%s", $row->id, urlencode($row->name))
      ];
    }
    return response()->json($searchable_results);
  }

  public function missionsNormal()
  {
    $normal_missions = NormalMissions::get();
    foreach ($normal_missions as $row) {
      $searchable_results[] = (object)[
        'n' => $row->name,
        'd' => $row->objectives,
        'l' => sprintf("/g/xbx/db/%s/%d-%s", 'normal-mission', $row->id, urlencode($row->name))
      ];
    }

    return response()->json($searchable_results);
  }

  public function skills()
  {
    $searchable_results = [];
    $class_skills = Skills::get();
    foreach ($class_skills as $row) {
      $searchable_results[] = (object)[
        'n' => $row->name,
        'd' => $row->class_rank,
        'l' => sprintf("/g/xbx/db/%s/%d-%s", 'skill', $row->id, urlencode($row->name))
      ];
    }
    return response()->json($searchable_results);
  }

  public function squadTasks()
  {
    $searchable_results = [];
    $squad_tasks = SquadTasks::get();
    foreach ($squad_tasks as $row) {
      $searchable_results[] = (object)[
        'n' => "Squad Task " . $row->name,
        'd' => sprintf("%s %s (%s:%s)", $row->objective, $row->target, $row->region, $row->location),
        'l' => sprintf("/g/xbx/db/%s/%s", 'squad-task', urlencode($row->name))
      ];
    }
    return response()->json($searchable_results);
  }

  public function tyrants()
  {
    $searchable_results = [];
    $results = Bestiary::tyrants()->get();
    foreach ($results as $row) {
      $searchable_results[] = (object)[
        'n' => sprintf("%s (%s) lv.%s", $row->name, $row->location, $row->lv),
        'd' => sprintf("%s:%s", $row->continent, $row->location),
        'l' => sprintf("/g/xbx/db/%s/%s-%s", 'tyrant', $row->id, urlencode($row->name))
      ];
    }
    return response()->json($searchable_results);
  }
}
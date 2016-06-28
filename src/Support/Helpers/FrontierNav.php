<?php

namespace Jiko\XBXDB\Support\Helpers;

use Jiko\XBXDB\Models\AffinityMissions;
use Jiko\XBXDB\Models\FrontierNav as FrontierNavModel;
use Jiko\XBXDB\Models\Bestiary;
use Jiko\XBXDB\Models\NormalMissions;

class FrontierNav
{
  /**
   * Import V1 json to database
   * @param $data
   * @return \Illuminate\Http\JsonResponse
   */
  public function importV1($data)
  {
    $import = [];
    $x_inc = 0;
    $pre = "a";
    foreach ($data->segments as $key => $type) {
      $k = preg_replace('/\d+/u', '', $key);
      $i = preg_replace('/\D+/u', '', $key);
      if ($k != $pre) {
        $pre = $k;
        $x_inc++;
      }

      $import[] = (object)[
        'map' => 'primordia',
        'key' => $k,
        'inc' => $i,
        'x' => ($data->coordinatex * $x_inc),
        'y' => ($data->coordinatesy->{$key}),
        'type' => $type,
        'type_id' => null,
        'data' => "{}"
      ];
    }

    foreach ($import as $v) {
      if ($model = FrontierNavModel::firstOrCreate(['map' => $v->map, 'key' => $v->key, 'inc' => $v->inc])) {
        $model->update((array)$v);
        continue;
      }
      $model->create((array)$v);
    }
    return response()->json($import);
  }

  /**
   * Import V2 json to database
   * @param $filename
   * @return \Illuminate\Http\JsonResponse
   * @internal param $data
   */
  public function importV2($filename)
  {
    $data = json_decode(file_get_contents(base_path($filename)));
    $import = [];
    $missing = [];
    $x_inc = 0;
    $pre = "a";

    // fix missing defaults/assume segments only
    if(!property_exists($data, "coordinatesy")) {
      $segments = $data;
      // assume map from filename
      $filename = str_replace('_', ' ', $filename);
      preg_match('/\/([a-z]+\W[a-z]+?)\Wv2\.json/i', $filename, $matches);

      $data = (object) [
        'map' => $matches[1],
        'coordinatex' => 39,
        'coordinatesy' => null,
        'segments' => $segments
      ];
    }
    if(is_null($data->coordinatesy)) {
      // build y coordinates
      foreach($data->segments as $k => $d) {
        $data->coordinatesy[$k] = "0px";
      }
      $data->coordinatesy = (object) $data->coordinatesy;
    }

    foreach ($data->segments as $key => $v) {
      $k = preg_replace('/\d+/u', '', $key);
      $i = preg_replace('/\D+/u', '', $key);
      if ($k != $pre) {
        $pre = $k;
        $x_inc++;
      }

      $tmp = (object)[
        'map' => $data->map,
        'key' => $k,
        'inc' => $i,
        'x' => ($data->coordinatex * $x_inc),
        'y' => ($data->coordinatesy->{$key}),
        'type' => $v->type
      ];
      switch ($v->type) {
        case "tyrant":
          if (empty($v->data->level)) {
            $v->data->level = (int)preg_replace('/\D+/u', '', $v->data->name);
          }
          $v->data->name = trim(preg_replace('/[\d\(\)]/u', '', $v->data->name));
          if (!$v->data->bestiary = Bestiary::tyrants()->where('name', $v->data->name)->first()) {
            $missing[] = [
              "name" => $v->data->name,
              "type" => $v->type,
              "coord" => [$k, $i]
            ];
          }
          break;
        case "affinity":
          $clean = trim(preg_replace("/\([\D]+\)$/", '', $v->data->name));
          if (!$v->data->model = AffinityMissions::where('name', $clean)->first()) {
            $missing[] = [
              "name" => $clean,
              "type" => $v->type,
              "coord" => [$k, $i]
            ];
          }
          break;

        case "mission":
          $clean = trim(preg_replace("/\([\D]+\)$/", '', $v->data->name));
          if (!$v->data->modal = NormalMissions::where('name', $clean)->first()) {
            $missing[] = [
              "name" => $clean,
              "type" => $v->type,
              "coord" => [$k, $i]
            ];
          }
      }
      $tmp->data = json_encode($v->data);
      $import[] = $tmp;
    }

    foreach ($import as $v) {
      if ($model = FrontierNavModel::firstOrCreate(['map' => $v->map, 'key' => $v->key, 'inc' => $v->inc])) {
        $model->update((array)$v);
        continue;
      }
      $model->create((array)$v);
    }

    return response()->json(["missing" => $missing]);
  }

  public function import($data, $version = 1)
  {
    $method = "importV" . $version;
    return $this->$method($data);
  }

  /**
   * Convert v1 file to v2
   * @param $data
   * @return \Illuminate\Http\JsonResponse
   */
  public function update($data)
  {
    $update = (object)[
      "segments" => (object)[]
    ];
    $x_inc = 0;
    $pre = "a";
    foreach ($data->segments as $key => $type) {
      $k = preg_replace('/\d+/u', '', $key);
      $i = preg_replace('/\D+/u', '', $key);
      if ($k != $pre) {
        $pre = $k;
        $x_inc++;
      }
      $update->segments->{$key} = (object)[
        'type' => $type,
        'data' => (object)[]
      ];
      switch ($type) {
        case "affinity":
          $update->segments->{$key}->data->requirements = "";
          break;

        case "fn":
          $update->segments->{$key}->data->id = "Site X0X";
          $update->segments->{$key}->data->requirements = "";
          $update->segments->{$key}->data->production = "";
          $update->segments->{$key}->data->revenue = "";
          $update->segments->{$key}->data->combat_support = "";
          $update->segments->{$key}->data->sightseeing_spots = "";
          $update->segments->{$key}->data->mineable_resources = "";
          break;

        case "mission":
          $update->segments->{$key}->data->name = "";
          $update->segments->{$key}->data->client = "";
          $update->segments->{$key}->data->requirements = "";
          break;

        case "treasure":
          $update->segments->{$key}->data->requirements = "";
          $update->segments->{$key}->data->rewards = "";
          break;

        case "tyrant":
          $update->segments->{$key}->data->name = "";
          $update->segments->{$key}->data->subcategory = "";
          $update->segments->{$key}->data->appears = "";
          $update->segments->{$key}->data->location = "";
          break;
      }
    }
    return response()->json($update);
  }

  public function csvToJson($filename, $resetCoordinates = true)
  {
    $data = array_map('str_getcsv', file(base_path($filename)));
//    return response()->json($data);
    $types = [
      "character hangout" => "character hangout",
      "heart-to-heart" => "heart-to-heart",
      "affinity mission" => "affinity",
      "affinity shift" => "affinity shift",
      "fn" => "fn",
      "mission" => "mission",
      "treasure" => "treasure",
      "tyrant" => "tyrant",
      "uncategorized" => "uncategorized"
    ];
    $jsonV2 = (object)[
      "coordinatex" => 39,
      "coordinatesy" => (object)[],
      "segments" => (object)[]
    ];
    foreach ($data as $idx => $row) {
      $key = strtolower($row[0]);
      $rowV2 = (object)[
        "type" => null,
        "data" => (object)[]
      ];
      $c1 = explode(":", $row[1]);
      if (preg_match("/fn/i", $row[1])) {
        $type = "fn";
      } else {
        $type = strtolower($c1[0]);
      }
      $rowV2->type = $types[$type];
      switch ($rowV2->type) {
        case "affinity shift":
          $rowV2->data->name = str_replace("Affinity Shift: ", '', $row[1]);
          $rowV2->data->requirements = str_replace("Quest Required: ", '', $row[2]);
          break;

        case "affinity":
          $rowV2->data->name = str_replace("Affinity Mission: ", '', $row[1]);
          $rowV2->data->requirements = str_replace("Requirements: ", '', $row[2]);
          break;

        case "character hangout":
          $rowV2->data->name = str_replace("Character Hangout: ", '', $row[1]);
          break;

        case "fn":
          $rowV2->data->id = preg_replace('/\D+/u', '', $row[1]);
          $rowV2->data->requirements = "";
          $rowV2->data->production = "";
          $rowV2->data->revenue = "";
          $rowV2->data->combat_support = "";
          $rowV2->data->sightseeing_spots = "";
          $rowV2->data->mineable_resources = "";
          foreach ($row as $i => $column) {
            if (preg_match("/mechanical level/i", $column)) {
              $rowV2->data->requirements = str_replace("Mechanical Level: ", '', $column);
            }
            if (preg_match("/production/i", $column)) {
              $rowV2->data->production = preg_replace("/Production: /i", '', $column);
            }
            if (preg_match("/revenue/i", $column)) {
              $rowV2->data->revenue = preg_replace("/revenue: /i", '', $column);
            }
            if (preg_match("/combat/i", $column)) {
              $rowV2->data->combat_support = preg_replace("/Combat Support: /i", '', $column);
            }
            if (preg_match("/sightseeing/i", $column)) {
              $rowV2->data->sightseeing_spots = preg_replace("/Combat Support: /i", '', $column);
            }
            if (preg_match("/resources/i", $column)) {
              $rowV2->data->mineable_resources = preg_replace("/Mineable Resources: /i", '', $column);
            }
          }
          break;

        case "heart-to-heart":
          $rowV2->data->name = str_replace("Heart-to-Heart: ", '', $row[1]);
          $rowV2->data->affinity = str_replace("Affinity: ", '', $row[2]);
          $rowV2->data->appears = str_replace("Appears: ", '', $row[3]);
          break;

        case "mission":
          $rowV2->data->name = str_replace("Mission: ", '', $row[1]);
          $rowV2->data->client = $row[2];
          $rowV2->data->requirements = $row[3];
          break;

        case "treasure":
          $rowV2->data->type = trim($c1[1]);
          $rowV2->data->requirements = trim(str_replace("Requires:", '', $row[2]));
          if(isset($row[3])) {
            $rowV2->data->rewards = trim(str_replace("Rewards:", '', $row[3]));
          }
          break;

        case "tyrant":
          $rowV2->data->name = str_replace("Tyrant: ", '', $row[1]);
          $rowV2->data->subcategory = "";
          $rowV2->data->appears = "";
          $rowV2->data->location = "";
          foreach ($row as $i => $column) {
            if (preg_match("/appears/i", $column)) {
              $rowV2->data->appears = preg_replace("/appears: /i", '', $column);
            }
            if (preg_match("/subcategory/i", $column)) {
              $rowV2->data->subcategory = preg_replace("/Subcategory: /i", '', $column);
            }
            if (preg_match("/location/i", $column)) {
              $rowV2->data->location = preg_replace("/location: /i", '', $column);
            }
          }
          break;

        case "uncategorized":
          $rowV2->data->name = str_replace("Uncategorized: ", '', $row[1]);
          break;
      }
      if ($resetCoordinates) {
        $jsonV2->coordinatesy->$key = 0;
      }
      $jsonV2->segments->$key = $rowV2;
    }
    return response()->json($jsonV2->segments);
  }
}
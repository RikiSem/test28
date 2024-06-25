<?php

namespace App\Http\Controllers;

use App\Http\Reps\ModelRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ModelsController extends Controller
{
    public function get(): array
    {
        $result = [];
        foreach (ModelRepository::getAllModels() as $key => $model) {
            $result[$key]['model'] = $model->name;
            $result[$key]['mark'] = $model->mark->name;
        }

        return $result;
    }
}

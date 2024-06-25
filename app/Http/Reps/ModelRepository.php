<?php


namespace App\Http\Reps;


use App\Models\CarModel;
use Illuminate\Database\Eloquent\Collection;

class ModelRepository
{
    public static function getAllModels(): Collection
    {
        return CarModel::get();
    }

    public static function createModelIfNotExist(string $name, int $markId): CarModel
    {
        $model = self::getModelByName($name);
        if (empty($model)) {
            $model = self::createModel($name, $markId);
        }

        return $model;
    }

    public static function createModel(string $name, int $markId): CarModel
    {
        return CarModel::create([
            'name' => $name,
            'mark_id' => $markId,
        ]);
    }

    public static function getModelByName(string $name): CarModel|null
    {
        return CarModel::where('name', '=', $name)->first();
    }
}

<?php


namespace App\Http\Reps;


use App\Models\Car;
use Illuminate\Database\Eloquent\Collection;


class CarRepository
{
    public static function getAllCars(): Collection
    {
        return Car::get();
    }

    public static function deleteCar(array $data): string
    {
        $car = self::getCarById($data['id']);
        if (empty($car)) {
            $result = sprintf('Машины с id %s не существует', $data['id']);
        } else {
            $result = $car->delete();
        }

        return $result;
    }

    public static function createCar(array $data)
    {
        $mark = MarkRepository::createMarkIfNotExist($data['mark']);
        $model = ModelRepository::createModelIfNotExist($data['model'], $mark->id);
        Car::create([
            'mark_id' => $mark->id,
            'model_id' => $model->id,
        ]);
    }

    public static function getCarById(int $id): Car|null
    {
        return Car::where('id', '=', $id)->first();
    }

    public static function updateCar(array $data): Car|string
    {
        $car = self::getCarById($data['id']);
        if (!empty($car)) {

            if (isset($data['mark'])) {
                $mark = MarkRepository::createMarkIfNotExist($data['mark']);
                $newMark = $mark->id;
            } else {
                $newMark = $car->mark;
            }

            if (isset($data['model'])) {
                $model = ModelRepository::createModelIfNotExist($data['model'], $newMark);
                $newModel = $model->id;
            } else {
                $newModel = $car->model;
            }

            $result = $car->update([
                'mark_id' => $newMark,
                'model_id' => $newModel,
            ]);
        } else {
            $result = sprintf('Машины с id %s не существует', $data['id']);
        }

        return $result;
    }
}

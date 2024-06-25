<?php

namespace App\Http\Controllers;

use App\Http\Reps\CarRepository;
use App\Models\Car;
use Illuminate\Http\Request;
use function Symfony\Component\HttpKernel\Debug\push;

class CarsController extends Controller
{

    public function get()
    {
        $result = [];
        foreach (CarRepository::getAllCars() as $key => $car) {
            $result[$key]['id'] = $car->id;
            $result[$key]['mark'] = $car->model->mark->name;
            $result[$key]['model'] = $car->model->name;
        }

        return $result;
    }

    public function create(Request $request)
    {
        $data = $this->validateFields($request->all(), Car::CAR_FIELD);

        if (!isset($data['errors'])) {
            CarRepository::createCar($data['request']);
        }

        return $data;
    }

    public function update(Request $request)
    {

        $fieldsArray = Car::CAR_FIELD;
        array_push($fieldsArray, 'id');
        $data = $this->validateFields($request->all(), $fieldsArray);

        if (!isset($data['errors'])) {
            $result = CarRepository::updateCar($data['request']);
        } else {
            $result = $data;
        }

        return $result;
    }

    public function delete(Request $request)
    {
        $data = $this->validateFields($request->all(), ['id']);

        if (!isset($data['errors'])) {
            $data = CarRepository::deleteCar($data['request']);
        }

        return $data;
    }

    private function validateFields(array $requestData, array $fields): array
    {
        $result = [];
        foreach ($requestData as $key => $item) {
            if (in_array($key, $fields)) {
                $result['request'][$key] = $item;
            } else {
                $result['errors'][] = sprintf('Указан неверный параметр %s', $key);
            }
        }

        return $result;
    }
}

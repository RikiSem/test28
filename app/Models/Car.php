<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $guarded = [];

    public const CAR_FIELD = [
        'mark',
        'model'
    ];

    public function model()
    {
        return $this->hasOne(CarModel::class, 'id', 'model_id');
    }
}

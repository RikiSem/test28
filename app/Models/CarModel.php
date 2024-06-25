<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function mark()
    {
        return $this->hasOne(CarMark::class, 'id', 'mark_id');
    }
}

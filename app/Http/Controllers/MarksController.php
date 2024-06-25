<?php

namespace App\Http\Controllers;

use App\Http\Reps\MarkRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class MarksController extends Controller
{
    public function get(): Collection
    {
        return MarkRepository::getAllMarks();
    }
}

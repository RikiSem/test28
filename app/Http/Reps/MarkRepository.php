<?php


namespace App\Http\Reps;


use App\Models\CarMark;
use Illuminate\Database\Eloquent\Collection;

class MarkRepository
{
    public static function getAllMarks(): Collection
    {
        return CarMark::select('id', 'name')->get();
    }

    public static function createMarkIfNotExist(string $name): CarMark
    {
        $mark = self::getMarkByName($name);
        if (empty($mark)) {
            $mark = self::createMark($name);
        }

        return $mark;
    }

    public static function createMark(string $name): CarMark
    {
        return CarMark::create([
            'name' => $name
        ]);
    }

    public static function getMarkByName(string $name): CarMark|null
    {
        return CarMark::where('name', '=', $name)->first();
    }

}

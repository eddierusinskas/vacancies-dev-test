<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    /**
     * Fillable fields
     *
     * @var string[]
     */
    protected $fillable = [
        "title",
        "description",
        "location",
        "salary_from",
        "salary_to"
    ];
}

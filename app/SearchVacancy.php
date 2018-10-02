<?php

namespace ReclutaTI;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class SearchVacancy extends Model
{
    use Searchable;
}

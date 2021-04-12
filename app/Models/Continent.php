<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Continent extends Model
{
    use HasFactory;

    protected $table = 'continents';

    protected $primaryKey = 'code';

    protected $keyType = 'string';

    public $timestamps = false;

    public $incrementing = false;

    public function countries() {
        return $this->hasMany(Country::class, 'continent_code', 'code');
    }
}

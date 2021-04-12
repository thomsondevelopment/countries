<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table = 'countries';

    protected $primaryKey = 'country_id';

    public $timestamps = false;

    protected $fillable = [
        'code',
        'name',
        'full_name',
        'iso3',
        'number',
        'continent_code',
        'display_order'
    ];

    public function continent() {
        return $this->belongsTo(Continent::class, 'continent_code', 'code');
    }
}

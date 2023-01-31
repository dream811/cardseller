<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $table = 'country_list';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'is_use',
        'is_del',
    ];

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    protected $table = 'state_list';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'country_id',
        'is_use',
        'is_del',
    ];
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

}

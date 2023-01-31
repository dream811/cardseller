<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Notice extends Model
{
    use HasFactory;
    protected $table = 'notice_list';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'subject', 'content', 'created_at', 'updated_at', 'is_popup', 'is_del'];
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    use HasFactory;
    protected $table = 'faq_list';
    protected $primaryKey = 'id';
    protected $fillable = ['question', 'answer', 'is_del'];
}

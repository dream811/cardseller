<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QNA extends Model
{
    use HasFactory;
    protected $table = 'qna_list';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['user_id', 'user_name', 'subject', 'content', 'requested_date', 'answer', 'is_answer', 'is_check', 'answered_date', 'type', 'is_del'];
}

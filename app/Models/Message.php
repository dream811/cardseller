<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $table = 'message_list';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['sender_id', 'sender_name', 'receiver_id', 'receiver_name', 'subject', 'content', 'send_date', 'is_read', 'read_date', 'is_del'];
}

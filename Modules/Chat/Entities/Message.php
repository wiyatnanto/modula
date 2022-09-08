<?php

namespace Modules\Chat\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $table = 'chat_messages';
    protected $primaryKey = 'id';

    protected $fillable=[
        'sender_id',
        'receiver_id',
        'conversation_id',
        'read',
        'type',
        'body',

    ];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
    
    protected static function newFactory()
    {
        return \Modules\Chat\Database\factories\MessageFactory::new();
    }
}

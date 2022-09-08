<?php

namespace Modules\Chat\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Conversation extends Model
{
    use HasFactory;

    protected $table = 'chat_conversations';
    protected $primaryKey = 'id';

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'last_time_message'
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    protected static function newFactory()
    {
        return \Modules\Chat\Database\factories\ConversationFactory::new();
    }
}

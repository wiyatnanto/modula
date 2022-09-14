<?php

namespace Modules\Chat\Http\Livewire\Chat;
use Livewire\Component;

use App\Models\User;
use Modules\Chat\Entities\Conversation;
use Modules\Chat\Entities\Message;

class ChatList extends Component
{
    public $auth_id;
    public $conversations;
    public $receiverInstance;
    public $name;
    public $selectedConversation;

    protected $listeners = [
        'chatUserSelected',
        'refresh' => '$refresh',
        'resetComponent',
    ];

    public function resetComponent()
    {
        // dd('resetComponent');
        $this->selectedConversation = null;
        $this->receiverInstance = null;
    }

    public function chatUserSelected(Conversation $conversation, $receiverId)
    {
        $this->selectedConversation = $conversation;
        $receiverInstance = User::find($receiverId);
        $this->emit('refresh');
        $this->emitTo(
            'chat::chat.chatbox',
            'loadConversation',
            $this->selectedConversation,
            $receiverInstance
        );
    }
    public function getChatUserInstance(Conversation $conversation, $request)
    {
        $this->auth_id = auth()->id();

        if ($conversation->sender_id == $this->auth_id) {
            $this->receiverInstance = User::firstWhere(
                'id',
                $conversation->receiver_id
            );
        } else {
            $this->receiverInstance = User::firstWhere(
                'id',
                $conversation->sender_id
            );
        }

        if (isset($request)) {
            return $this->receiverInstance->$request;
        }
    }
    public function mount()
    {
        $this->auth_id = auth()->id();
        $this->conversations = Conversation::where('sender_id', $this->auth_id)
            ->orWhere('receiver_id', $this->auth_id)
            ->orderBy('last_time_message', 'DESC')
            ->get();
    }

    public function render()
    {
        return view('chat::livewire.chat.chat-list');
    }
}

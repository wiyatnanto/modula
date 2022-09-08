<?php

namespace Modules\Chat\Http\Livewire\Chat;
use Livewire\Component;
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
        $this->selectedConversation = null;
        $this->receiverInstance = null;

        # code...
    }

    public function chatUserSelected(Conversation $conversation, $receiverId)
    {
        //  dd($conversation,$receiverId);
        $this->selectedConversation = $conversation;
        $receiverInstance = User::find($receiverId);
        $this->emitTo(
            'chat.chatbox',
            'loadConversation',
            $this->selectedConversation,
            $receiverInstance
        );
        $this->emitTo(
            'chat.send-message',
            'updateSendMessage',
            $this->selectedConversation,
            $receiverInstance
        );

        # code...
    }
    public function getChatUserInstance(Conversation $conversation, $request)
    {
        # code...
        $this->auth_id = auth()->id();
        //get selected conversation

        if ($conversation->sender_id == $this->auth_id) {
            $this->receiverInstance = User::firstWhere(
                'id',
                $conversation->receiver_id
            );
            # code...
        } else {
            $this->receiverInstance = User::firstWhere(
                'id',
                $conversation->sender_id
            );
        }

        if (isset($request)) {
            return $this->receiverInstance->$request;
            # code...
        }
    }
    public function mount()
    {
        $this->auth_id = auth()->id();
        $this->conversations = Conversation::where('sender_id', $this->auth_id)
            ->orWhere('receiver_id', $this->auth_id)
            ->orderBy('last_time_message', 'DESC')
            ->get();

        # code...
    }

    public function render()
    {
        return view('chat::livewire.chat.chat-list');
    }
}

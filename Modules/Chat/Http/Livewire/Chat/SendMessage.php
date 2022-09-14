<?php

namespace Modules\Chat\Http\Livewire\Chat;

use Livewire\Component;

use Modules\Chat\Events\MessageSent;
use Modules\Chat\Entities\Conversation;
use Modules\Chat\Entities\Message;
use App\Models\User;

class SendMessage extends Component
{
    public $selectedConversation;
    public $receiverInstance;
    public $body = "COBA";
    public $createdMessage;
    protected $listeners = [
        'updateSendMessage',
        'dispatchMessageSent',
        'resetComponent',
    ];

    public function resetComponent()
    {
        $this->selectedConversation = null;
        $this->receiverInstance = null;
    }

    function updateSendMessage(Conversation $conversation, User $receiver)
    {
        $this->selectedConversation = $conversation;
        $this->receiverInstance = $receiver;
    }

    public function sendMessage()
    {
        if ($this->body == null) {
            return null;
        }

        $this->createdMessage = Message::create([
            'conversation_id' => $this->selectedConversation->id,
            'sender_id' => auth()->id(),
            'receiver_id' => $this->receiverInstance->id,
            'body' => $this->body,
        ]);

        $this->selectedConversation->last_time_message = $this->createdMessage->created_at;
        $this->selectedConversation->save();
        $this->emitTo('chat::chat.chatbox', 'pushMessage', $this->createdMessage->id);

        $this->emitTo('chat::chat.chat-list', 'refresh');
        $this->reset('body');

        $this->emitSelf('dispatchMessageSent');
    }

    public function dispatchMessageSent()
    {
        broadcast(
            new MessageSent(
                Auth()->user(),
                $this->createdMessage,
                $this->selectedConversation,
                $this->receiverInstance
            )
        );
    }
    public function render()
    {
        return view('chat::livewire.chat.send-message');
    }
}

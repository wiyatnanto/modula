<?php

namespace Modules\Chat\Http\Livewire\Chat;

use Livewire\Component;

use Modules\Chat\Events\MessageRead;
use Modules\Chat\Entities\Conversation;
use Modules\Chat\Entities\Message;
use App\Models\User;

class Chatbox extends Component
{
    public $selectedConversation;
    public $receiver;
    public $messages;
    public $paginateVar = 10;
    public $height;

    // protected $listeners = [ 'loadConversation', 'pushMessage', 'loadmore', 'updateHeight', "echo-private:chat.1,MessageSent"=>'broadcastedMessageReceived'];

    public function getListeners()
    {
        $auth_id = auth()->user()->id;
        return [
            // "echo:chat.{$auth_id},Modules\\Chat\\Events\\MessageSent" => 'broadcastedMessageReceived',
            // "echo:chat.{$auth_id},Modules\\Chat\\Events\\MessageRead" => 'broadcastedMessageRead',
            'loadConversation', 'pushMessage', 'loadmore', 'updateHeight','resetComponent','broadcastedMessageReceived','broadcastedMessageRead'
        ];
    }

    public function resetComponent()
    {
        $this->selectedConversation = null;
        $this->receiverInstance = null;
    }

    public function broadcastedMessageRead($event)
    {
        // dd($event);
        if ($this->selectedConversation) {
            if (
                (int) $this->selectedConversation->id ===
                (int) $event['conversation_id']
            ) {
                $this->dispatchBrowserEvent('markMessageAsRead');
            }
        }
    }

    function broadcastedMessageReceived($event)
    {
        // dd($event);
        $this->emitTo('chat::chat.chat-list', 'refresh');

        $broadcastedMessage = Message::find($event['message']);
        if ($this->selectedConversation) {
            if (
                (int) $this->selectedConversation->id ===
                (int) $event['conversation_id']
            ) {
                $broadcastedMessage->read = 1;
                $broadcastedMessage->save();
                $this->pushMessage($broadcastedMessage->id);
                $this->emitSelf('broadcastMessageRead');
            }
        }
    }

    public function broadcastMessageRead()
    {
        broadcast(
            new MessageRead(
                $this->selectedConversation->id,
                $this->receiverInstance->id
            )
        );
    }

    public function pushMessage($messageId)
    {
        $newMessage = Message::find($messageId);
        $this->messages->push($newMessage);
        $this->dispatchBrowserEvent('rowChatToBottom');
    }

    function loadmore()
    {
        $this->paginateVar = $this->paginateVar + 10;
        $this->messages_count = Message::where(
            'conversation_id',
            $this->selectedConversation->id
        )->count();

        $this->messages = Message::where(
            'conversation_id',
            $this->selectedConversation->id
        )
            ->skip($this->messages_count - $this->paginateVar)
            ->take($this->paginateVar)
            ->orderBy('created_at', 'asc')
            ->get();

        $height = $this->height;
        $this->dispatchBrowserEvent('updatedHeight', $height);
    }

    function updateHeight($height)
    {
        $this->height = $height;
    }

    public function loadConversation(Conversation $conversation, User $receiver)
    {
        $this->selectedConversation = $conversation;
        $this->receiverInstance = $receiver;

        $this->emitTo(
            'chat::chat.send-message',
            'updateSendMessage',
            $conversation,
            $receiver
        );

        $this->messages_count = Message::where(
            'conversation_id',
            $this->selectedConversation->id
        )->count();
        $this->messages = Message::where(
            'conversation_id',
            $this->selectedConversation->id
        )
            ->skip($this->messages_count - $this->paginateVar)
            ->take($this->paginateVar)
            ->orderBy('created_at', 'asc')
            ->get();

        $this->dispatchBrowserEvent('chatSelected');
        Message::where('conversation_id', $this->selectedConversation->id)
            ->where('receiver_id', auth()->user()->id)
            ->update(['read' => 1]);

        $this->emitSelf('broadcastMessageRead');
        $this->emitTo(
            'chat::chat.chat-list',
            'refresh'
        );
        $this->dispatchBrowserEvent('perfectScrollbar');
    }

    public function render()
    {
        return view('chat::livewire.chat.chatbox');
    }
}

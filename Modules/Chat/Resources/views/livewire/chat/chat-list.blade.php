<div>
    @if (count($conversations) > 0)
        <ul class="list-unstyled chat-list px-1">
            @foreach ($conversations as $conversation)
                <li class="chat-item pe-1" wire:key="{{ $conversation->id }}">
                    <a type="button" class="d-flex align-items-center"
                        wire:click="$emit('chatUserSelected', {{ $conversation }},{{ $this->getChatUserInstance($conversation, $name = 'id') }})">
                        <figure class="mb-0 me-2">
                            <img src="https://via.placeholder.com/37x37" class="img-xs rounded-circle" alt="user">
                            <div class="status online"></div>
                        </figure>
                        <div class="d-flex justify-content-between flex-grow-1 border-bottom">
                            <div>
                                <p class="text-body @if (count($conversation->messages->where('read', 0)->where('receiver_id', Auth()->user()->id))) fw-folder @endif">
                                    {{ $this->getChatUserInstance($conversation, $name = 'name') }}
                                </p>
                                <p class="text-muted tx-13">{{ $conversation->messages->last()->body }}</p>
                            </div>
                            <div class="d-flex flex-column align-items-end">
                                <p class="text-muted tx-13 mb-1">
                                    {{ $conversation->messages->last()->created_at->shortAbsoluteDiffForHumans() }}</p>
                                @if (count($conversation->messages->where('read', 0)->where('receiver_id', Auth()->user()->id)))
                                    <div class="badge rounded-pill bg-primary ms-auto">
                                        {{ count($conversation->messages->where('read', 0)->where('receiver_id', Auth()->user()->id)) }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </a>
                </li>
            @endforeach
            </li>
        </ul>
    @else
        <div class="text-muted tx-13">Tidak ada percakapan</div>
    @endif
</div>

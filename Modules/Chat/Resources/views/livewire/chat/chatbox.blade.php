<div class="col-lg-8 chat-content">
    @if ($selectedConversation)
        <div class="chat-header border-bottom pb-2">
            <div class="d-flex justify-content-between">
                <div class="d-flex align-items-center">
                    <i data-feather="corner-up-left" id="backToChatList"
                        class="icon-lg me-2 ms-n2 text-muted d-lg-none"></i>
                    <figure class="mb-0 me-2">
                        <img src="https://via.placeholder.com/43x43" class="img-sm rounded-circle" alt="image">
                        <div class="status online"></div>
                        <div class="status online"></div>
                    </figure>
                    <div>
                        <p>{{ $receiverInstance->name }}</p>
                        <p class="text-muted tx-13">Front-end Developer</p>
                    </div>
                </div>
                <div class="d-flex align-items-center me-n1">
                    <a href="#">
                        <i data-feather="video" class="icon-lg text-muted me-3" data-bs-toggle="tooltip"
                            title="Start video call"></i>
                    </a>
                    <a href="#">
                        <i data-feather="phone-call" class="icon-lg text-muted me-0 me-sm-3" data-bs-toggle="tooltip"
                            title="Start voice call"></i>
                    </a>
                    <a href="#" class="d-none d-sm-block">
                        <i data-feather="user-plus" class="icon-lg text-muted" data-bs-toggle="tooltip"
                            title="Add to contacts"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="chat-body" x-ref="chatbody" x-data x-init="() => {
            var ps = new PerfectScrollbar($refs.chatbody);
            /*$refs.chatbody.addEventListener('ps-scroll-y', () => {
                if (ps.reach.y === 'start') {
                    window.livewire.emit('loadmore');
                }
            });*/
        }">
            <ul class="messages">
                @if ($messages)
                    @foreach ($messages as $message)
                        <li class="message-item {{ auth()->id() == $message->sender_id ? 'me' : 'friend' }}"
                            wire:key="{{ $message->id }}">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava4-bg.webp" class="img-xs rounded-circle" alt="avatar">
                            <div class="content">
                                <div class="message">
                                    <div class="bubble">
                                        <p>{{ $message->body }}</p>
                                    </div>
                                    <span>{{ $message->created_at->format('m: i a') }}</span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
        <div class="chat-footer">
            @livewire('chat::chat.send-message')
        </div>
    @endif
</div>
@push('script')
    <script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.min.js"></script>
@endpush

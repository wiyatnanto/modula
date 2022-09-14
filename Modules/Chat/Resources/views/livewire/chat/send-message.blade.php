<div class="d-flex" x-data x-init="() => {
    window.addEventListener('updatedHeight', event => {
        let old = event.detail.height;
        let newHeight = $('.chat-content .chat-body')[0].scrollHeight;
        let height = $('.chat-content .chat-body').scrollTop(newHeight - old);
        window.livewire.emit('updateHeight', {
            height: height,
        });
    });
}">
    <div>
        <button type="button" class="btn border btn-icon rounded-circle me-2" data-bs-toggle="tooltip" title="Emoji">
            <x-crud::atoms.icon icon="smile" class="text-muted" />
        </button>
    </div>
    <div class="d-none d-md-block">
        <button type="button" class="btn border btn-icon rounded-circle me-2" data-bs-toggle="tooltip"
            title="Attatch files">
            <x-crud::atoms.icon icon="paperclip" class="text-muted" />
        </button>
    </div>
    <div class="d-none d-md-block">
        <button type="button" class="btn border btn-icon rounded-circle me-2" data-bs-toggle="tooltip"
            title="Record you voice">
            <x-crud::atoms.icon icon="phone-alt" class="text-muted" />
        </button>
    </div>
    <form class="search-form flex-grow-1 me-2">
        <div class="input-group">
            <input type="text" class="form-control rounded-pill" id="chatForm" placeholder="Type a message"
                wire:model="body">
        </div>
    </form>
    <div>
        <button type="button" class="btn btn-primary btn-icon rounded-circle" wire:click.prevent="sendMessage">
            <x-crud::atoms.icon icon="paper-plane" class="text-white" />
        </button>
    </div>
</div>

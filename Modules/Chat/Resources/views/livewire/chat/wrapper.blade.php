<div class="row chat-wrapper">
    <div class="col-md-12">
        <div class="card h-100">
            <div class="card-body">
                <div class="row position-relative h-100">
                    <div class="col-lg-4 chat-aside border-end-lg">
                        <div class="aside-content" x-data x-init="() => {
                            if ($('.chat-aside .chat-list-wrapper').length) {
                                const sidebarBodyScroll = new PerfectScrollbar('.chat-aside .chat-list-wrapper');
                            }
                            {{-- if ($('.chat-content .chat-body').length) {
                                const sidebarBodyScroll = new PerfectScrollbar('.chat-content .chat-body');
                            }
                            $('.chat-list .chat-item').each(function(index) {
                                $(this).on('click', function() {
                                    $('.chat-content').toggleClass('show');
                                });
                            });
                            $('#backToChatList').on('click', function(index) {
                                $('.chat-content').toggleClass('show');
                            }); --}}
                            window.addEventListener('rowChatToBottom', event => {
                                {{-- $('.chat-content .chat-body .messages li:last-child').hide(); --}}
                                $('.chat-content .chat-body .messages li:last-child').addClass('animate__animated animate__bounceInRight animate__fast')
                                $('.chat-content .chat-body').scrollTop($('.chat-content .chat-body')[0].scrollHeight);
                            })
                        }">
                            <div class="aside-header">
                                <div class="d-flex justify-content-between align-items-center pb-2 mb-2">
                                    <div class="d-flex align-items-center">
                                        <figure class="me-2 mb-0">
                                            <img src="https://via.placeholder.com/43x43" class="img-sm rounded-circle"
                                                alt="profile">
                                            <div class="status online"></div>
                                        </figure>
                                        <div>
                                            <h6>{{ Auth::user()->name }}</h6>
                                            <p class="text-muted tx-13">{{ Auth::user()->getRoleNames()->first() }}</p>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="dropdownMenuButton"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="icon-lg text-muted pb-3px" data-feather="settings"
                                                data-bs-toggle="tooltip" title="Settings"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                                    data-feather="eye" class="icon-sm me-2"></i> <span
                                                    class="">View Profile</span></a>
                                            <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                                    data-feather="edit-2" class="icon-sm me-2"></i> <span
                                                    class="">Edit Profile</span></a>
                                            <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                                    data-feather="aperture" class="icon-sm me-2"></i> <span
                                                    class="">Add status</span></a>
                                            <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                                    data-feather="settings" class="icon-sm me-2"></i> <span
                                                    class="">Settings</span></a>
                                        </div>
                                    </div>
                                </div>
                                <form class="search-form">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <x-crud::atoms.icon icon="search" />
                                        </span>
                                        <input type="text" class="form-control" id="searchForm"
                                            placeholder="{{ __('Search chat ...') }}">
                                    </div>
                                </form>
                            </div>
                            <div class="aside-body">
                                <p class="text-muted mb-1 mt-2">{{ __('Percakapan Terakhir') }}</p>
                                <div class="chat-list-wrapper">
                                    @livewire('chat::chat.chat-list')
                                </div>
                            </div>
                        </div>
                    </div>
                    @livewire('chat::chat.chatbox')
                </div>
            </div>
        </div>
    </div>
</div>
@push('style')
    <style>
        body {
            overflow: hidden !important;
        }
    </style>
@endpush
@push('script')
@endpush

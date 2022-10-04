<form class="search-form">
    <div class="input-group">
        <div class="input-group-text">
            <x-crud::atoms.icon icon="search" />
        </div>
        <input type="text" class="form-control" id="navbarForm"
            placeholder="{{ __('theme::messages.search_placeholder') }}">
    </div>
</form>

<div>
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/crud/build') }}">Builder</a></li>
            <li class="breadcrumb-item active" aria-current="page">Config</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12">
            <div class="card h-auto">
                <div class="card-body">
                    <x-crud::molecules.tabs active="info">
                        <x-crud::molecules.tab title="Info" name="info">
                            <livewire:crud::builder.info name="{{ $name }}" />
                        </x-crud::molecules.tab>
                        <x-crud::molecules.tab title="Database" name="database">
                            <livewire:crud::builder.sql name="{{ $name }}" />
                        </x-crud::molecules.tab>
                        <x-crud::molecules.tab title="Table" name="table">
                            <livewire:crud::builder.table name="{{ $name }}" />
                        </x-crud::molecules.tab>
                        <x-crud::molecules.tab title="Form" name="form">
                            <livewire:crud::builder.form name="{{ $name }}" />
                        </x-crud::molecules.tab>
                        <x-crud::molecules.tab title="Permission" name="permission">
                            <livewire:crud::builder.permission name="{{ $name }}" />
                        </x-crud::molecules.tab>
                        <x-crud::molecules.tab title="Publish" name="publish">
                            <livewire:crud::builder.publish name="{{ $name }}" />
                        </x-crud::molecules.tab>
                    </x-crud::molecules.tabs>
                </div>
            </div>
        </div>
    </div>
</div>

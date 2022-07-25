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
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="flex-grow-1">
                            <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('crud/build') }}">
                                        <x-crud::atoms.icon icon="mdi mdi-arrow-left" size="14"/>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" id="info-line-tab" data-bs-toggle="tab" href="#info"
                                        role="tab" aria-controls="info" aria-selected="true">Info</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="sql-line-tab" data-bs-toggle="tab" href="#sql"
                                        role="tab" aria-controls="sql" aria-selected="false">SQL</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="table-line-tab" data-bs-toggle="tab" href="#table"
                                        role="tab" aria-controls="table" aria-selected="false">Table</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="form-line-tab" data-bs-toggle="tab" href="#form"
                                        role="tab" aria-controls="form" aria-selected="false">Form</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="permission-line-tab" data-bs-toggle="tab" href="#permission"
                                        role="tab" aria-controls="permission" aria-selected="false">Permission</a>
                                </li>
                            </ul>
                            <div class="tab-content mt-3" id="lineTabContent">
                                <div class="tab-pane fade show active" id="info" role="tabpanel"
                                    aria-labelledby="info-line-tab">
                                    <livewire:crud::builder.info name="{{ $name }}" />
                                </div>
                                <div class="tab-pane fade" id="sql" role="tabpanel"
                                    aria-labelledby="sql-line-tab">
                                    <livewire:crud::builder.sql name="{{ $name }}" />
                                </div>
                                <div class="tab-pane fade" id="table" role="tabpanel"
                                    aria-labelledby="table-line-tab">...</div>
                                <div class="tab-pane fade" id="form" role="tabpanel"
                                    aria-labelledby="form-line-tab">...</div>
                                <div class="tab-pane fade" id="permission" role="tabpanel"
                                    aria-labelledby="permission-line-tab">...</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@extends('layouts.app')

@section('content')
<div class="tab-content">
    <div class="tab-pane fade show active" id="config" role="tabpanel" aria-labelledby="profile-line-tab">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        @include('Acore.builder.tab',array('active'=>'template','type'=> $type))
                        <div class="p-2">
                        @if($attach =='system')
                        
                        <div class="alert alert-primary mt-3">
                            <p> <strong>Tips !</strong> If you want to use custom template , you can start by generating files template .<br /> If files generated , system will automatic swith from <b>datatables</b> to <b> jQuery Table </b> CRUD
                                <a href="{{ url('builder/attach/'.$row->module_name.'?do=attach') }}" class="btn btn-xs btn-danger">Generate template files ? </a>
                            <p>
                        </div>
                        @else
                        <div class="alert alert-primary mt-3">
                            <p> <strong>Tips !</strong> If you want to use template system , click here : </b>
                                <a href="{{ url('builder/attach/'.$row->module_name.'?do=deattach') }}" class=""> Use Template System ? </a>
                            <p>
                        </div>
                        @endif
                        @if($attach =='custom')
                        {!! Form::open(array('url'=>'builder/savetemplate/'.$module_name, 'class'=>'form-horizontal','id'=>'fTable')) !!}
                        <div class="mt-3" id="table">
                            <h4> Table ( Grid ) </h4>
                            <div class="infobox fade in">
                                <p> File Location : <span class="text-info"> /resources/views/{{ $module_name}}/table.blade.php</span> </p>
                            </div>
                            <textarea class="form-control code-editor" id="code-editor" name="table" rows="20">{{ $template['table'] }}</textarea>
                            <br /> <button class="btn btn-xs btn-success" type="submit"> Save Change </button>
                        </div>
                        <div class="mt-3" id="form">
                            <h4> Form </h4>
                            <div class="infobox fade in">
                                <p> File Location : <span class="text-info"> /resources/views/{{ $module_name}}/form.blade.php</span> </p>
                            </div>
                            <textarea class="form-control" rows="20" name="form" id="code-editor_2">{{ $template['form'] }}</textarea>
                            <br /> <button class="btn btn-xs btn-success" type="submit"> Save Change </button>
                        </div>
                        <div class="mt-3" id="view">
                            <h4> View Detail </h4>
                            <div class="infobox fade in">
                                <p> File Location : <span class="text-info"> /resources/views/{{ $module_name}}/view.blade.php</span> </p>
                            </div>
                            <textarea class="form-control" rows="20" name="view" id="code-editor_3">{{ $template['view'] }}</textarea>
                            <br /> <button class="btn btn-xs btn-success" type="submit"> Save Change </button>
                        </div>
                        <input type="hidden" name="path" value="{{ $row->module_name }}" />
                        <input type="hidden" name="module_id" value="{{ $row->module_id }}" />
                        {!! Form::close() !!}
                        @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@if($attach =='custom')
<script type="text/javascript" src="{{ asset('sximo5/js/plugins/editarea/edit_area/edit_area_full.js') }}"></script>

<script type="text/javascript">
    editAreaLoader.init({
        id: "code-editor" // textarea id
            ,
        syntax: "html" // syntax to be uses for highgliting
            ,
        start_highlight: true // to display with highlight mode on start-up
    });
    editAreaLoader.init({
        id: "code-editor_2" // textarea id
            ,
        syntax: "html" // syntax to be uses for highgliting
            ,
        start_highlight: true // to display with highlight mode on start-up
    });
    editAreaLoader.init({
        id: "code-editor_3" // textarea id
            ,
        syntax: "html" // syntax to be uses for highgliting
            ,
        start_highlight: true // to display with highlight mode on start-up
    });
    $(document).ready(function() {
        <
        ?
        php echo SximoHelpers::sjForm('fTable'); ? >

    })
</script>
@endif
<style type="text/css">
    .tab-content textarea {
        font-size: 12px;
    }

    #editor {
        border: solid 1px #eee !important;
    }

    .area_toolbar {
        background-color: #fff !important;
    }
</style>
@stop
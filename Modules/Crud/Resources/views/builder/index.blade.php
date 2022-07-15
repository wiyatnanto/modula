@extends('theme::backend.layouts.master')

@section('content')
<style type="text/css">
    .motile-ribbon .card-body .mdi {
        font-size: 50px;
        color: #0c1427;
        margin-left: 15px;
    }

    .motile-ribbon .card-body .card-label {
        margin-top: 22px;
    }

    .motile-ribbon .card-body .card-label a span {
        white-space: pre-line;
        color: #0c1427;
        font-size: 17px;
    }

    .motile-ribbon .card-body .card-label a small {
        font-size: 13px;
        color: #7987a1;
    }
</style>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="motile-ribbon">
                    <section>
                        <div class="row flex-grow-1">
                            <div class="col-md-3 grid-margin stretch-card">
                                <div class="card shadow-none">
                                    <div class="card-body p-1">
                                        <div class="d-flex align-items-start">
                                            <span class="align-self-start me-3">
                                                <i class="mdi mdi-cube-outline"></i>
                                            </span>
                                            <div class="card-label">
                                                <a href="{{ url('builder/create') }}" onclick="SximoModal(this.href,'Create Module'); return false;" class="clear">
                                                    <span class="h4 block m-t-xs">{{ Lang::get('core.btn_create') }} Module
                                                    </span> <small> {{ Lang::get('core.fr_createmodule') }} </small>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 grid-margin stretch-card">
                                <div class="card shadow-none">
                                    <div class="card-body p-1">
                                        <div class="d-flex align-items-start">
                                            <span class="align-self-start me-3">
                                                <i class="mdi mdi-vector-arrange-below"></i>
                                            </span>
                                            <div class="card-label">
                                                <a href="{{ url('builder/package') }}" class="clear post_url">
                                                    <span class="h4 block m-t-xs">{{ Lang::get('core.btn_backup') }} Module
                                                    </span> <small> {{ Lang::get('core.fr_backupmodule') }} </small>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 grid-margin stretch-card">
                                <div class="card shadow-none">
                                    <div class="card-body p-1">
                                        <div class="d-flex align-items-start">
                                            <span class="align-self-start me-3">
                                                <i class="mdi mdi-database"></i>
                                            </span>
                                            <div class="card-label">
                                                <a href="{{ url('root/database') }}" class="clear ">
                                                    <span class="h4 block m-t-xs">PHP MyAdmin
                                                    </span> <small> Manage Database Table </small>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 grid-margin stretch-card">
                                <div class="card shadow-none">
                                    <div class="card-body p-1">
                                        <div class="d-flex align-items-start">
                                            <span class="align-self-start me-3">
                                                <i class="mdi mdi-vector-point"></i>
                                            </span>
                                            <div class="card-label">
                                                <a href="{{ url('root/api') }}" class="clear post_url">
                                                    <span class="h4 block m-t-xs"> RestAPI
                                                    </span> <small> Token / Authentication </small>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="card shadow-none mb-2">
                    <div class="card-body">
                        <div class="mb-2 unziped">
                            {!! Form::open(array('url'=>'builder/install/', 'class'=>'breadcrumb-search','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
                            <h5 class="mb-2">Select File <small>( Module zip installer ) </small></h5>
                            <p> <input type="file" name="installer" required style="float:left;"> <button type="submit" class="btn btn-xs btn-primary" style="float:left;"> Upload & Install</button></p>
                            </form>
                        </div>
                    </div>
                </div>
                @if($type =='core')
                <div class="infobox infobox-info fade in">
                    <button type="button" class="close" data-dismiss="alert"> x </button>
                    <p> Do not <b>Rebuild</b> or Change any Core Module </p>
                </div>
                @endif
                <div class="table-responsive" style="min-height:400px; padding-bottom: 200px;">
                    {!! Form::open(array('url'=>'builder/package#', 'class'=>'form-horizontal' ,'ID' =>'SximoTable' )) !!}
                    @if(count($rowData) >=1)
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="checkall form-check-input" style="font-size: 14px;margin-left: -1.55em;" name="ids[]" id="checkAll">
                                        <label class="form-check-label" for="checkAll"></label>
                                    </div>
                                </th>
                                <th>Module</th>
                                <th>Type</th>
                                <th>Controller</th>
                                <th>Database</th>
                                <th>PRI</th>
                                <th>Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rowData as $row)
                            <tr>
                                <td>
                                    <div class="btn-group ">
                                        <div class="dropdown">
                                            <button class="btn btn-xs btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Aksi
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{ url('crud/builder/config/'.$row->name)}}"> {{ Lang::get('core.btn_edit') }}</a>
                                                @if($type != 'core')
                                                <a class="dropdown-item" href="{{ url($row->name)}}"> {{ Lang::get('core.btn_view') }} Module </a>
                                                <a class="dropdown-item" href="{{ url('crud/builder/duplicate/'.$row->id)}}" onclick="SximoModal(this.href,'Duplicate/Clone Module'); return false;"> {{ Lang::get('core.btn_duplicate') }} </a>
                                                @endif
                                                @if($type != 'core')
                                                <a class="dropdown-item" href="javascript://ajax" onclick="SximoConfirmDelete('{{ url('crud/builder/destroy/'.$row->id)}}')"> {{ Lang::get('core.btn_remove') }}</a>
                                                @endif
                                            </ul>
                                        </div>
                                </td>
                                <td>
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="ids form-check-input" name="ids[]" id="checkChecked" value="{{ $row->id }}">
                                        <label class="form-check-label" for="checkChecked"></label>
                                    </div>
                                </td>
                                <td>{{ $row->title }} </td>
                                <td>{{ $row->type }} </td>
                                <td>{{ $row->name }} </td>

                                <td>{{ $row->db }} </td>
                                <td>{{ $row->db_key }} </td>
                                <td>{{ $row->created_at }} </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! Form::close() !!}
                </div>
                @else
                <p class="text-center" style="padding:50px 0;">{{ Lang::get('core.norecord') }}
                    <br /><br />
                    <a href="{{ url('builder/create')}}" onclick="SximoModal(this.href,'Create Module'); return false;" class="btn btn-default btn-sm "><i class="fa fa-plus"></i> {{ Lang::get('core.fr_createmodule') }} </a>
                </p>
                @endif
            </div>
        </div>
    </div>
</div>
<script language='javascript'>
    $(function() {
        $('.post_url').click(function(e) {
            e.preventDefault();
            if (($('.ids', $('#SximoTable')).is(':checked')) == false) {
                alert($(this).attr('data-title') + " not selected");
                return false;
            }
            $('#SximoTable').attr({
                'action': $(this).attr('href')
            }).submit();
        });
        $('.checkall').click(function(){
            if($(this).is(":checked") == false){
                $('.ids').prop('checked', false)   
            }
            else {
                $('.ids').prop('checked', true)
            }
        });
    });
</script>
@endsection
@push('scripts')
<script src="{{ asset('motile/vendors/jquery-jcombo/jquery.jCombo.min.js') }}"></script>
<script src="{{ asset('motile/vendors/simpleclone/simpleclone.js') }}"></script>
@endpush
@extends('theme::backend.layouts.master')

@section('content')
<div class="tab-content">
    <div class="tab-pane fade show active" id="config" role="tabpanel" aria-labelledby="profile-line-tab">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        @include('crud::builder.tab',array('active'=>'sql' ))
                        {!! Form::open(array('url'=>'crud/builder/savesql/'.$name, 'class'=>'form-horizontal ' ,'id'=>'crudsql' , 'parsley-validate'=>'','novalidate'=>' ')) !!}
                        <div class="mb-3 mt-3 p-2">
                            <label for="ipt" class="form-label col-md-3"> Master Table </label>
                            <div class="col-md-12">
                                <select class="select2-select form-select input-sm" name="db">
                                    <option value="{{ $table }}"> {{ $table }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 p-2">
                            <label for="ipt" class="form-label col-md-3"> Join Table </label>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th> Table</th>
                                            <th> Master Key </th>
                                            <th> Joined Key</th>
                                            <th> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($join_table))
                                        @foreach($join_table as $key=>$val)
                                        <tr class="clone clonedInput">
                                            <td class="ps-0">
                                                {!! Form::select('table[]', $tables , $key ,
                                                array('class'=>'select2-select form-select', 'required'=>'true' ));
                                                !!}
                                            </td>
                                            <td><input type="text" name="master[]" value="{{ $val['master']}}" placeholder="Master Table Key " class="form-control input-sm" /></td>
                                            <td><input type="text" name="join[]" value="{{ $val['join']}}" placeholder="Joined Table Key " class="form-control input-sm" /></td>
                                            <td>
                                                <a href="#" class="btn btn-xs" onclick="$(this).parents('.clonedInput').remove(); return false">asdassa<i class="fa fa-minus"></i></a>
                                                <input name="counter[]" type="hidden" value="" />
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr class="clone clonedInput">
                                            <td class="ps-0">
                                                {!! Form::select('table[]', $tables , '' ,
                                                array('class'=>'select2-select form-select', 'required'=>'true' ));
                                                !!}
                                            </td>
                                            <td><input type="text" name="master[]" placeholder="Master Table Key " class="form-control input-sm" /></td>
                                            <td><input type="text" name="join[]" placeholder="Joined Table Key " class="form-control input-sm" /></td>
                                            <td>
                                                <a href="#" class="btn btn-xs" onclick="$(this).parents('.clonedInput').remove(); return false"><i class="fa fa-minus"></i></a>
                                                <input name="counter[]" type="hidden" value="" />
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>

                                </table>
                                <a href="javascript:void(0)" class="btn btn-xs btn-secondary btn-icon-text addC mt-2" rel=".clone">Add Join Table <i class="btn-icon-append" data-feather="plus"></i></a>
                        </div>
                        <div class="mb-3 p-2">
                            <label for="ipt" class="form-label col-md-3"></label>
                            <div class="col-md-12">
                                <button type="submit" name="submit" class="btn btn-xs btn-primary btn-icon-text">Update Module <i class="btn-icon-append" data-feather="save"></i></button>
                                {{-- <button type="submit" class="btn btn-xs btn-primary"> Re-Save SQL & Configuration</button> --}}
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{{ $row->id }}" />
                        <input type="hidden" name="name" value="{{ $row->name }}" />
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script src="{{ asset('modules/crud/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('modules/crud/vendor/jquery-jcombo/jquery.jCombo.min.js') }}"></script>
<script src="{{ asset('modules/crud/vendor/simpleclone/simpleclone.js') }}"></script>
<script src="{{ asset('modules/crud/vendor/parsley/parsley.min.js') }}"></script>
<script src="{{ asset('modules/crud/vendor/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('modules/crud/vendor/jquery.form/jquery.form.min.js') }}"></script>

<script src="{{ asset('modules/theme/backend/vendors/select2/select2.min.js') }}"></script>
<script src="{{ asset('modules/theme/backend/vendors/jquery.toast/jquery.toast.min.js') }}"></script>

<script>
    $(function() {
        $('a.addC').relCopy({});
        var formSQL = $('#crudsql'); 
        formSQL.parsley();
        formSQL.submit(function(){         
          if(formSQL.parsley().isValid()){      
            var options = { 
              dataType: 'json', 
              beforeSubmit : function() {
              },
              success: function( data ) {
				if(data.status == 'success')
				{
					$.toast({
						text: data.message,
						position: 'top-center',
						loaderBg: '#0bb197'
					});
				} else {
					$.toast({
						text: 'Something error',
						position: 'top-center',
						loaderBg: '#0bb197'
					});
				}
              }  
            }  
            $(this).ajaxSubmit(options); 
            return false;                 
          } else {
            return false;
          }   
        });
    })
</script>
@endpush
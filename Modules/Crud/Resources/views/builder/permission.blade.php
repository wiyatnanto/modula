@extends('theme::backend.layouts.master')

@section('content')
    <div class="tab-content">
        <div class="tab-pane fade show active" id="config" role="tabpanel" aria-labelledby="profile-line-tab">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            {!! Form::open(['url' => 'crud/builder/savepermission/' . $name, 'class' => 'form-horizontal', 'id' => 'fPermission']) !!}
                            @include('crud::builder.tab', ['active' => 'permission', 'type' => $type])
                            <table class="table table-striped mt-3" id="table">
                                <thead class="no-border">
                                    <tr>
                                        <th field="name1" width="20">No</th>
                                        <th field="name2">Group </th>
                                        <?php foreach($tasks as $item=>$val) {?>
                                        <th field="name3" data-hide="phone"><?php echo $val; ?> </th>
                                        <?php }?>

                                    </tr>
                                </thead>
                                <tbody class="no-border-x no-border-y">
                                    <?php $i=0; foreach($access as $gp) {?>
                                    <tr>
                                        <td width="20"><?php echo ++$i; ?>
                                            <input type="hidden" name="role_id[]" value="<?php echo $gp['role_id']; ?>" />
                                        </td>
                                        <td><?php echo $gp['role_name']; ?> </td>
                                        <?php foreach($tasks as $item=>$val) {?>
                                        <td class="">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="checkChecked"
                                                    name="<?php echo $item; ?>[<?php echo $gp['role_name']; ?>]"
                                                    class="c<?php echo $gp['role_id']; ?> minimal-green" type="checkbox"
                                                    value="1" <?php if ($gp[$item] == 1) {
                                                        echo ' checked="checked" ';
                                                    } ?> />
                                                <label class="form-check-label" for="checkChecked">

                                                </label>
                                            </div>
                                        </td>
                                        <?php }?>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                            <div class="infobox infobox-danger fade in">
                                <button type="button" class="close" data-dismiss="alert"> x </button>
                                <h5>Please Read !</h5>
                                <ol>
                                    <li> If you want users <strong>only</strong> able to access they own records , then
                                        <strong>Global</strong> must be <code>uncheck</code> </li>
                                    <li> When you using this feature , Database table must have
                                        <strong><code>EntryBy</code></strong> field </li>
                                </ol>
                            </div>
                            <button type="submit" class="btn btn-xs btn-primary btn-icon-text" id="saveLayout"> Save
                                Changes <i class="btn-icon-append" data-feather="save"></i></button>
                            <input name="id" type="hidden" id="id" value="<?php echo $row->id; ?>" />
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $(document).ready(function() {

            $(".checkAll").click(function() {
                var cblist = $(this).attr('rel');
                var cblist = $(cblist);
                if ($(this).is(":checked")) {
                    cblist.prop("checked", !cblist.is(":checked"));
                } else {
                    cblist.removeAttr("checked");
                }

            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {

            <
            ?
            php echo SximoHelpers::sjForm('fPermission'); ? >

        })
    </script>

@stop

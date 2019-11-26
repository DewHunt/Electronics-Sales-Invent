@extends('admin.layouts.master')

<?php
    use App\UserMenu;
?>

@section('content')
    <div style="padding-bottom: 10px;"></div>

    @php
        $message = Session::get('msg');
    @endphp

    @if (isset($message))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Success!</strong> {{ $message }}
        </div>
    @endif

    @php
        Session::forget('msg');
    @endphp

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6"><h4 class="card-title">{{$title}}</h4> </div>
                        <div class="col-md-6 text-right">
                            <a style="margin-left: 0px; font-size: 16px;" class="btn btn-outline-info btn-lg"  href="{{ route($goBackLink) }}">
                                <i class="fa fa-arrow-circle-left"></i> Go Back
                            </a>
                            <a style="margin-left: 0px; font-size: 16px;" class="btn btn-outline-info btn-lg" href="{{ route('userMenu.ActionLinkAdd',$menuId) }}">
                                <i class="fa fa-plus-circle"></i> Add New
                            </a>
                        </div>
                    </div>                   
                </div>

                <div class="card-body">                
                    <div class="table-responsive">
                        <table id="menusTable" class="table table-bordered table-striped"  name="menusTable">
                            <thead>
                                <tr>
                                    <th width="50px">Sl</th>
                                    <th>Name</th>
                                    <th>Parent</th>
                                    <th>Link</th>
                                    <th width="60px">Order</th>
                                    <th width="60px">Status</th>
                                    <th width="60px">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                @php
                                    $sl = 0;
                                @endphp
                            	@foreach($menus as $menu)
                                    @php
                                        $parentMenu = UserMenu::where('id',$menu->parentmenuId)->first();
                                        $sl++;
                                    @endphp                    	
                            	<tr>
                                    <td>{{ $sl }}</td>
                                    <td>{{ $menu->actionName }}</td>
                                    <td>{{ $parentMenu->menuName }}</td>
                                    <td>{{ $menu->actionLink }}</td>
                                    <td>{{ $menu->orderBy }}</td>
                                    <td>
                                        <span class="switchery-demo m-b-30" onclick="statusChange({{ $menu->id }})">
                                        <input type="checkbox" {{ $menu->actionStatus ? 'checked':'' }} class="js-switch" data-color="#00c292" data-switchery="true" style="display: none;" >
                                        </span>
                                    </td>
                                    <td class="text-nowrap">
                                        <a href="{{ route('userMenu.ActionLinkEdit',['parentMenu'=>$menuId,'actionMenuId'=>$menu->id]) }}" data-toggle="tooltip" data-original-title="Edit" data-id="{{ $menu->id }}"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>

                                        <a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Delete" data-id="{{$menu->id}}"  data-token="{{ csrf_token() }}"> <i class="fa fa-trash text-danger"></i> </a>
                                    </td>
                                </tr>
                            	@endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')

    <!-- This is data table -->
    <script src="{{ asset('/public/admin-elite/assets/node_modules/datatables/jquery.dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var updateThis ;

            // Switchery
            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            $('.js-switch').each(function() {
                new Switchery($(this)[0], $(this).data());
            });

            var table = $('#menusTable').DataTable( {
                "order": [[ 0, "asc" ]]
            } );

            table.on('order.dt search.dt', function () {
                table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();          

            //ajax delete code
            $('#menusTable tbody').on( 'click', 'i.fa-trash', function () {
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });

                usermenuId = $(this).parent().data('id');
                var menu = this;
                swal({   
                    title: "Are you sure?",   
                    text: "You will not be able to recover this imaginary file!",   
                    type: "warning",   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "Yes, delete it!",   
                    cancelButtonText: "No, cancel plx!",   
                    closeOnConfirm: false,   
                    closeOnCancel: false 
                }, function(isConfirm){   
                    if (isConfirm) {     
                       $.ajax({
                            type: "POST",
                           url : "{{ route('usermenuAction.delete') }}",
                            data : {usermenuId:usermenuId},
                           
                            success: function(response) {
                                swal({
                                    title: "<small class='text-success'>Success!</small>", 
                                    type: "success",
                                    text: "Menu Deleted Successfully!",
                                    timer: 1000,
                                    html: true,
                                });
                                table
                                    .row( $(menu).parents('tr'))
                                    .remove()
                                    .draw();
                            },
                            error: function(response) {
                                error = "Failed.";
                                swal({
                                    title: "<small class='text-danger'>Error!</small>", 
                                    type: "error",
                                    text: error,
                                    timer: 1000,
                                    html: true,
                                });
                            }
                        });    
                    } else { 
                        swal({
                            title: "Cancelled", 
                            type: "error",
                            text: "Your menu is safe :)",
                            timer: 1000,
                            html: true,
                        });    
                    } 
                });
            }); 

        });
                
        //ajax status change code
        function statusChange(menu_id) {
            $.ajax({
                    type: "GET",
                    url: "{{ route('usermenuAction.status', 0) }}",
                    data: "menu_id=" + menu_id,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        swal({
                            title: "<small class='text-success'>Success!</small>", 
                            type: "success",
                            text: "Status successfully updated!",
                            timer: 1000,
                            html: true,
                        });
                    },
                    error: function(response) {
                        error = "Failed.";
                        swal({
                            title: "<small class='text-danger'>Error!</small>", 
                            type: "error",
                            text: error,
                            timer: 2000,
                            html: true,
                        });
                    }
                });
            }

            function summernote(){
                $('.summernote').summernote({
                    height: 200, // set editor height
                    minHeight: null, // set minimum height of editor
                    maxHeight: null, // set maximum height of editor
                    focus: false // set focus to editable area after initializing summernote
                });
            }
    </script>
@endsection
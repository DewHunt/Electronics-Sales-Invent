@extends('admin.layouts.masterIndex')

@section('card_body')
    <div class="card-body">
        <div class="table-responsive">
            @php
                $sl = 0;
            @endphp

            <table id="categoriesTable" class="table table-bordered table-striped"  name="categoriesTable">
                <thead>
                    <tr>
                        <th width="20px">SL</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Parent</th>
                        <th width="20px">Status</th>
                        <th width="20px">Action</th>
                    </tr>
                </thead>
                <tbody id="">
                	
                </tbody>
            </table>
        </div>
    </div>

    <!-- sample modal content for show category-->
    <div id="showCategory" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Show Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="container" id="showContent">
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
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

            var table = $('#categoriesTable').DataTable( {
                "order": [[0, "asc"]]
            } );

            table.on('order.dt search.dt', function () {
                table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();

            //ajax
            

            //ajax show code
            $('#categoriesTable tbody').on( 'click', 'i.fa-eye', function () { 
                updateThis = this;
                category_id = $(this).parent().data('id');
                $.ajax({
                    type: "GET",
                    url: "{{ route('categorySetup.index') }}" + "/" + category_id + "/edit",
                    data: "category_id=" + category_id,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function(response) {                        
                        category = response.category;
                        showFunction(category);
                    },
                    error: function(response) {
                        error = "Something wrong.";
                        swal({
                            title: "<small class='text-danger'>Error!</small>", 
                            type: "error",
                            text: error,
                            timer: 1000,
                            html: true,
                        });
                    }
                });              
            });

            //seperate the show function to understand
            function showFunction(category){
                if(category.categoryStatus == 1) 
                    categoryStatus =    `<div class="form-group row">
                                    <span class="badge badge-pill badge-success">Active</span>
                                </div>`;
                else
                    categoryStatus =    `<div class="form-group row">
                                    <span class="badge badge-pill badge-danger">In-active</span>
                                </div>`
                var content =   `<div class="form-group row">
                                    <label class="col-sm-4 col-form-label form-control"><b>Category name</b></label>
                                    <div class="col-sm-8 form-control">`+category.categoryName+`</div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label form-control"><b>Category position</b></label>
                                    <div class="col-sm-8 form-control">`+category.position+`</div>
                                </div>`+categoryStatus;

                $('#showContent').html(content);
                $("#showCategory").modal(); 
            }
            
            //ajax delete code
            $('#categoriesTable tbody').on( 'click', 'i.fa-trash', function () {
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });

                category_id = $(this).parent().data('id');
                var category = this;
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
                            type: "DELETE",
                            url: "{{ route('categorySetup.index') }}" + "/" + category_id,
                            // data: "category_id=" + category_id,
                            dataType: "JSON",
                            data: {
                                id:category_id
                            },
                            cache:false,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                swal({
                                    title: "<small class='text-success'>Success!</small>", 
                                    type: "success",
                                    text: "Category deleted Successfully!",
                                    timer: 1000,
                                    html: true,
                                });
                                table
                                    .row( $(category).parents('tr'))
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
                            text: "Your category is safe :)",
                            timer: 1000,
                            html: true,
                        });    
                    } 
                });
            }); 

        });
                
        //ajax status change code
        function statusChange(category_id) {
            $.ajax({
                    type: "GET",
                    url: "{{ route('categorySetup.status', 0) }}",
                    data: "category_id=" + category_id,
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
    </script>
@endsection
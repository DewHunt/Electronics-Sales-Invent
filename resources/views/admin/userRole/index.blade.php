@extends('admin.layouts.masterIndex')

@section('card_body')
    <div class="card-body">
        <div class="table-responsive">            
            <table id="usersTable" class="table table-bordered table-striped"  name="usersTable">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>User Name</th>
                        <th>status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    @php
                        $sl = 0;
                    @endphp
                	@foreach($userRoles as $role)
                        @php
                            $sl++;
                        @endphp                          
                        <tr>
                            <td>{{ $sl }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                <?php echo \App\Link::status($role->id,$role->status)?>
                            </td>
                            <td class="text-nowrap">
                            <?php echo \App\Link::action($role->id)?>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('custom-js')
    <script>
        $(document).ready(function() {
            var updateThis ;

            // Switchery
            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            $('.js-switch').each(function() {
                new Switchery($(this)[0], $(this).data());
            });

            var table = $('#usersTable').DataTable( {
                "order": [[ 0, false]]
            } );

            table.on('order.dt search.dt', function () {
                table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();

            //ajax
            
            //ajax delete code
            $('#usersTable tbody').on( 'click', 'i.fa-trash', function () {
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });

                userRole_id = $(this).parent().data('id');
                var user = this;
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
                            url: "{{ route('userRole.delete') }}",
                            data: {userRoleId:userRole_id},
                            success: function(response) {
                                swal({
                                    title: "<small class='text-success'>Success!</small>", 
                                    type: "success",
                                    text: "user deleted Successfully!",
                                    timer: 1000,
                                    html: true,
                                });
                                table
                                    .row( $(user).parents('tr'))
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
        function statusChange(userRole_id) {
            $.ajax({
                type: "GET",
                url: "{{ route('userRole.changeuserRoleStatus', 0) }}",
                data: "userRole_id=" + userRole_id,
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
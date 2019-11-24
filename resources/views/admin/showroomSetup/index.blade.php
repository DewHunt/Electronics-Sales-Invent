@extends('admin.layouts.master')

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

    <div class="card">            
        <div class="card-header">
            <div class="row">
                <div class="col-md-6"><h4 class="card-title">{{ $title }}</h4></div>
                <div class="col-md-6">  
                    <span class="shortlink">
                        <a style="font-size: 16px;" class="btn btn-outline-info btn-lg" href="{{ route('showroomSetup.add')}}">
                            <i class="fa fa-plus-circle"></i> Add new
                        </a>
                    </span>                     
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="showroomTable" class="table table-bordered table-striped"  name="showroomTable">
                    <thead>
                        <tr>
                            <th width="20px">SL</th>
                            <th>Name</th>
                            <th>Contact Person</th>
                            <th>Website</th>
                            <th width="20px">Phone</th>
                            <th>Address</th>
                            <th width="20px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    	@php
                    		$sl = 0;
                    	@endphp
                    	@foreach ($showrooms as $showroom)
	                    	@php
	                    		$sl++;
	                    	@endphp
	                    	<tr>
		                    	<td>{{ $sl }}</td>
	                    		<td>{{ $showroom->name }}</td>
	                    		<td>{{ $showroom->contact_person }}</td>
	                    		<td>{{ $showroom->website }}</td>
	                    		<td>{{ $showroom->phone }}</td>
	                    		<td>{{ $showroom->address }}</td>
	                    		<td>
	                    			@php
	                    				echo \App\Link::action($showroom->id);
	                    			@endphp
	                    		</td>
	                    	</tr>
                    	@endforeach
                    </tbody>
                </table>
            </div>
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

            var table = $('#showroomTable').DataTable( {
                "order": [[0, "asc"]]
            } );

            table.on('order.dt search.dt', function () {
                table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();         

            //ajax delete code
            $('#showroomTable tbody').on( 'click', 'i.fa-trash', function () {
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });

                showroomId = $(this).parent().data('id');
                var tableRow = this;
                swal({   
                    title: "Are you sure?",   
                    text: "You will not be able to recover this information!",   
                    type: "warning",   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "Yes, delete it!",   
                    cancelButtonText: "No, cancel plx!",   
                    closeOnConfirm: false,   
                    closeOnCancel: false 
                },
                function(isConfirm){   
                    if (isConfirm) {
                        $.ajax({
                            type: "POST",
                            url : "{{ route('showroomSetup.delete') }}",
                            data : {showroomId:showroomId},
                           
                            success: function(response) {
                                swal({
                                    title: "<small class='text-success'>Success!</small>", 
                                    type: "success",
                                    text: "Showroom Deleted Successfully!",
                                    timer: 1000,
                                    html: true,
                                });
                                table
                                    .row( $(tableRow).parents('tr'))
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
                    }
                    else
                    { 
                        swal({
                            title: "Cancelled", 
                            type: "error",
                            text: "Your Showrrom is safe :)",
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
                    url: "{{ route('showroomSetup.status', 0) }}",
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
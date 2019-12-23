@extends('admin.layouts.masterIndex')

@section('card_body')
    <div class="card-body">
        <div class="table-responsive">
            @php
                $sl = 0;
            @endphp

            <table id="dataTable" class="table table-bordered table-striped"  name="transferTable">
                <thead>
                    <tr>
                        <th width="20px">SL</th>
                        <th>Transfer No.</th>
                        <th>Transfer Date.</th>
                        <th>Host</th>
                        <th>Destination</th>
                        <th>Quanty</th>
                        <th width="20px">Action</th>
                    </tr>
                </thead>
                <tbody id="">
                	@php
                		$sl = 0;
                	@endphp
                	@foreach ($transfers as $transfer)
                        @php
                            $host = DB::table('view_store_and_showroom')
                                ->select('name as hostName')
                                ->where('type',$transfer->host_type)
                                ->where('id',$transfer->host_id)
                                ->first();
                            $destination = DB::table('view_store_and_showroom')
                                ->select('name as destinationName')
                                ->where('type',$transfer->destination_type)
                                ->where('id',$transfer->destination_id)
                                ->first();
                        @endphp
                		<tr class="row_{{ $transfer->id }}">
	                		<td>{{ $sl++ }}</td>
	                		<td>{{ $transfer->transfer_no }}</td>
	                		<td>{{ $transfer->date }}</td>
	                		<td>{{ @$host->hostName }}</td>
                            <td>{{ @$destination->destinationName }}</td>
	                		<td>{{ $transfer->total_qty }}</td>
	                		<td>
	                			@php
	                				echo \App\Link::action($transfer->id);
	                			@endphp 
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

            //ajax delete code
            $('#dataTable tbody').on( 'click', 'i.fa-trash', function () {
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });

                transferId = $(this).parent().data('id');
                // console.log(liftingId);
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
                            url : "{{ route('transferProduct.delete') }}",
                            data : {transferId:transferId},
                           
                            success: function(response) {
                                swal({
                                    title: "<small class='text-success'>Success!</small>", 
                                    type: "success",
                                    text: "Transfer Deleted Successfully!",
                                    timer: 1000,
                                    html: true,
                                });
                                $('.row_'+transferId).remove();
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
                            text: "This Transfer Is Safe :)",
                            timer: 1000,
                            html: true,
                        });    
                    } 
                });
            });
        });
    </script>
@endsection
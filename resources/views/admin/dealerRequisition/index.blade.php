@extends('admin.layouts.masterIndex')

@section('card_body')
    <div class="card-body">
        <div class="table-responsive">
            @php
                $sl = 0;
            @endphp

            <table id="dataTable" class="table table-bordered table-striped" name="dealerRequisitionTable">
                <thead>
                    <tr>
                        <th width="20px">SL</th>
                        <th>Date</th>
                        <th>Requisition No.</th>
                        <th>Dealer Name</th>
                        <th>Total Qty</th>
                        <th>Total Amount</th>
                        <th width="20px">Action</th>
                    </tr>
                </thead>
                <tbody id="">
                    @php
                        $sl = 1;
                    @endphp
                    @foreach ($dealerRequisitions as $dealerRequisition)
                        <tr class="row_{{ $dealerRequisition->id }}">
                            <td>{{ $sl++ }}</td>
                            <td>{{ date('d-m-Y', strtotime($dealerRequisition->date)) }}</td>
                            <td>{{ $dealerRequisition->requisition_no }}</td>
                            <td>{{ $dealerRequisition->dealerName }}</td>
                            <td>{{ $dealerRequisition->total_qty }}</td>
                            <td>{{ $dealerRequisition->total_amount }}</td>
                            <td>
                                @php
                                    echo \App\Link::action($dealerRequisition->id);
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

                dealerRequisitionId = $(this).parent().data('id');
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
                            url : "{{ route('dealerRequisition.delete') }}",
                            data : {dealerRequisitionId:dealerRequisitionId},
                           
                            success: function(response) {
                                swal({
                                    title: "<small class='text-success'>Success!</small>", 
                                    type: "success",
                                    text: "Dealer Requisition Deleted Successfully!",
                                    timer: 1000,
                                    html: true,
                                });
                                $('.row_'+dealerRequisitionId).remove();
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
                            text: "Dealer Requisition Is Safe :)",
                            timer: 1000,
                            html: true,
                        });    
                    } 
                });
            });
        });
    </script>
@endsection
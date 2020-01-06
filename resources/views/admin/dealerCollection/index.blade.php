@extends('admin.layouts.masterIndex')

@section('card_body')
    <div class="card-body">
        <div class="table-responsive">
            <table id="dataTable" class="table table-bordered table-striped"  name="dealerTable">
                <thead>
                    <tr>
                        <th width="20px">SL</th>
                        <th>Dealer Name</th>
                        <th width="70px">Contact</th>
                        <th width="100px">Payment No</th>
                        <th width="100px">Date</th>
                        <th width="110px">Money Reciept</th>
                        <th width="90px">Type</th>
                        <th width="90px">Payment</th>
                        <th width="170px">Remarks</th>
                        <th width="70px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $sl = 1;
                    @endphp
                    @foreach ($dealerCollections as $dealerCollection)
                        <tr class="row_{{ $dealerCollection->id }}">
                            <td>{{ $sl++ }}</td>
                            <td>{{ $dealerCollection->dealerName }}</td>
                            <td>{{ $dealerCollection->dealerMobile }}</td>
                            <td>{{ $dealerCollection->payment_no }}</td>
                            <td>{{ date('Y-m-d', strtotime($dealerCollection->payment_date)) }}</td>
                            <td>{{ $dealerCollection->money_receipt_no }}</td>
                            <td>{{ $dealerCollection->money_receipt_type }}</td>
                            <td align="right">{{ $dealerCollection->payment_amount }}</td>
                            <td>{{ $dealerCollection->remarks }}</td>
                            <td>
                                @php
                                    echo \App\Link::action($dealerCollection->id);
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

                dealerCollectionId = $(this).parent().data('id');
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
                            url : "{{ route('dealerCollection.delete') }}",
                            data : {dealerCollectionId:dealerCollectionId},
                           
                            success: function(response) {
                                swal({
                                    title: "<small class='text-success'>Success!</small>", 
                                    type: "success",
                                    text: "Dealer Collection Deleted Successfully!",
                                    timer: 1000,
                                    html: true,
                                });
                                $('.row_'+dealerCollectionId).remove();
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
                            text: "Dealer Collection Is Safe :)",
                            timer: 1000,
                            html: true,
                        });    
                    } 
                });
            });
        });
    </script>
@endsection
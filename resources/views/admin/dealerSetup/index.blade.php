@extends('admin.layouts.masterIndex')

@section('card_body')
    <div class="card-body">
        <div class="table-responsive">
            @php
                $sl = 0;
            @endphp

            <table id="dataTable" class="table table-bordered table-striped"  name="dealerTable">
                <thead>
                    <tr>
                        <th width="20px">SL</th>
                        <th>Dealer Name</th>
                        <th width="70px">Code</th>
                        <th width="100px">District</th>
                        <th width="120px">Upazila</th>
                        <th width="110px">Territory Name</th>
                        <th width="90px">Type</th>
                        <th width="80px">Mobile</th>
                        <th width="110px">Address</th>
                        <th width="20px">Status</th>
                        <th width="20px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $sl = 0;
                    @endphp
                    @foreach ($dealers as $dealer)
                        <tr class="row_{{ $dealer->id }}">
                            <td>{{ $sl++ }}</td>
                            <td>{{ $dealer->name }}</td>
                            <td>{{ $dealer->code }}</td>
                            <td>{{ $dealer->districtName }} / {{ $dealer->districtBanglaName }}</td>
                            <td>{{ $dealer->upazilaName }} / {{ $dealer->upazilaBanglaName }}</td>
                            <td>{{ $dealer->territoryName }}</td>
                            <td>{{ $dealer->type }}</td>
                            <td>{{ $dealer->mobile }}</td>
                            <td>{{ $dealer->address }}</td>
                            <td>
                                <?php echo \App\Link::status($dealer->id,$dealer->status)?>
                            </td>
                            <td>
                                @php
                                    echo \App\Link::action($dealer->id);
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

                dealerId = $(this).parent().data('id');
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
                            url : "{{ route('dealerSetup.delete') }}",
                            data : {dealerId:dealerId},
                           
                            success: function(response) {
                                swal({
                                    title: "<small class='text-success'>Success!</small>", 
                                    type: "success",
                                    text: "Dealer Deleted Successfully!",
                                    timer: 1000,
                                    html: true,
                                });
                                $('.row_'+dealerId).remove();
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
                            text: "Your Dealer Is Safe :)",
                            timer: 1000,
                            html: true,
                        });    
                    } 
                });
            });
        });
                
        //ajax status change code
        function statusChange(dealerId) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: "{{ route('dealerSetup.status') }}",
                data: {dealerId:dealerId},
                success: function(response) {
                    swal({
                        title: "<small class='text-success'>Success!</small>", 
                        type: "success",
                        text: "Status Successfully Updated!",
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
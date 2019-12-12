@extends('admin.layouts.master')

@section('content')
    <div style="padding-bottom: 10px;"></div>

    @php
        use App\InvoiceSetup;
        use App\CashCollection;
    @endphp

    @php
        $message = Session::get('msg');
        $erroMesege = Session::get('err_msg')
    @endphp

    @if (isset($message))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Success!</strong> {{ $message }}
        </div>
    @endif

    @if (isset($erroMesege))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Oops! </strong> {{ $erroMesege }}
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
                        <a style="font-size: 16px;" class="btn btn-outline-info btn-lg" href="{{ route($addNewLink)}}">
                            <i class="fa fa-plus-circle"></i> Add New
                        </a>
                    </span>                     
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table table-bordered table-striped"  name="showroomTable">
                    <thead>
                        <tr>
                            <th width="20px">SL</th>
                            <th>Collection Date</th>
                            <th>Collection No</th>
                            <th>Invoice No</th>
                            <th>Invoice Amount</th>
                            <th>Collection Amount</th>
                            <th>Due</th>
                            <th width="70px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($cashCollections as $collection)
                        @php
                            $i++;
                            $collectionDate = date('d-m-Y',strtotime($collection->collection_date));
                            $invoice = InvoiceSetup::where('id',$collection->invoice_id)->first();

                            $previousCashCollectionAmount = CashCollection::where('id', '<', $collection->id)->where('invoice_id',$collection->invoice_id)->sum('collection_amount');

                            if($collection->previous_collection > 0 ){
                                $currentDue =$collection->invoice_amount - ($previousCashCollectionAmount + $collection->collection_amount);
                            }else{
                                $currentDue = $collection->invoice_amount - $collection->collection_amount;
                            }
                            
                        @endphp
                            <tr class="row_{{$collection->id}}">
                                <td>{{$i}}</td>
                                <td>{{$collectionDate}}</td>
                                <td>{{$collection->collection_no}}</td>
                                <td>{{@$invoice->invoice_no}}</td>
                                <td>{{$collection->invoice_amount}}</td>
                                <td>{{$collection->collection_amount}}</td>
                                <td>{{$currentDue}}</td>
                                <td>
                                    @php
                                        echo \App\Link::action($collection->id);
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

            //ajax delete code
            $('#dataTable tbody').on( 'click', 'i.fa-trash', function () {
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });

                collectionId = $(this).parent().data('id');
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
                            url : "{{ route('cashCollection.delete') }}",
                            data : {collectionId:collectionId},
                           
                            success: function(response) {
                                swal({
                                    title: "<small class='text-success'>Success!</small>", 
                                    type: "success",
                                    text: "Collection Deleted Successfully!",
                                    timer: 1000,
                                    html: true,
                                });
                                $('.row_'+collectionId).remove();
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
                
    </script>
@endsection
@extends('admin.layouts.master')

@section('content')
    @php
        use App\Product;
        use App\CustomerRegistrationSetup;
        use App\ShowroomSetup;
    @endphp
    <style type="text/css">
        .blockTitle span{
            font-weight: bold;
        }
    </style>
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

    @if( count($errors) > 0 )
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Oops!</strong> {{ $errors->first() }}
        </div>
    @endif

    <form class="form-horizontal" action="{{ route($formLink) }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6"><h4 class="card-title">{{ $title }}</h4></div>
                    <div class="col-md-6 text-right">
                        <a class="btn btn-outline-info btn-lg" href="{{ route($goBackLink) }}">
                            <i class="fa fa-arrow-circle-left"></i> Go Back
                        </a>
                        <button type="submit" class="btn btn-outline-info btn-lg waves-effect"><i class="fa fa-save"></i> {{ $buttonName }}</button>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <input type="hidden" value="print" name="print">
                <div class="row">
                    <div class="col-md-6">
                        <label for="from-date">Invoice Date</label>
                        <input  type="text" class="form-control add_datepicker" name="invoiceDate" placeholder="Select Date From">
                    </div>

                    <div class="col-md-6">
                        <label for="purchase-type">Purchase Type</label>
                        <div class="form-group {{ $errors->has('purchaseType') ? ' has-danger' : '' }}">
                           <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" value="Cash" name="purchaseType" class="product purchaseType" required> Cash
                            </label>
                        </div>

                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" value="Short Installment" name="purchaseType" class="product purchaseType"> Short Installment
                            </label>
                        </div>

                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" value="Long Installment" name="purchaseType" class="product purchaseType"> Long Installment
                            </label>
                        </div>
                        @if ($errors->has('purchaseType'))
                            @foreach($errors->get('purchaseType') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                    </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="customer-product-name">Customer & Product Name</label>
                        <div class="form-group" id="prodct-select-menu">
                            <select class="form-control chosen-select" name="customerProductId" id="customerProductId">
                                <option value="">Select Product</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="customer-product-serial">Product Serial</label>
                        <div class="form-group" id="prodct-serial-select-menu">
                            <select class="form-control chosen-select" name="productSerial" id="productSerial">
                                <option value="">Select Product Serial</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @if(@$print == 'print')
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6"><h4 class="card-title">Customer Invoice</h4></div>
                    <div class="col-md-6 text-right">
                        <a target="_blank" class="btn btn-outline-info btn-lg" href="{{ route('invoiceSetup.printInvoice',$invoice->id) }}">
                            <i class="fa fa-print"></i> Print Invoice
                        </a>

                         <a target="_blank" class="btn btn-outline-info btn-lg" href="{{ route('invoiceSetup.printChalan',$invoice->id) }}">
                            <i class="fa fa-print"></i> Print Chalan
                        </a>
                    </div>
                </div>
            </div>

            
            <div class="card-body" style="padding-bottom: 50px;">
                @php
                    $customer = CustomerRegistrationSetup::where('id',$invoice->customer_id)->first();
                    $showRoom = ShowroomSetup::where('id',$getCustomerProduct->showroom_id)->first();
                    $invoiceDate = date('d-m-Y',strtotime($invoice->created_at));
                @endphp
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="blockTitle"><span>Invoice No</span> #{{@$invoice->invoice_no}}</h5>
                        <h5 class="blockTitle"><span>Invoice Date :</span> {{@$invoiceDate}}</h5>
                    </div>

                    <div class="col-md-6" style="text-align: right;">
                        <h5 class="blockTitle" style="border-bottom: 1px solid #333;display: inline-block;padding-bottom: 5px;"><span>Invoice To</span></h5>
                        <h4>{{ $customer->name}}</h4>
                        <h4>{{ $customer->phone_no}}</h4>
                        <h4>{{$invoice->customer_product_usage_address }}</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-borderless table-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th width="190px">Showroom</th>
                                    <th>Code</th>
                                    <th width="220px">Name</th>
                                    <th>Price</th>
                                    <th width="112px">Model</th>
                                    <th>Color</th>
                                    <th width="60px">Warranty</th>
                                    <th style="text-align: center;" width="115px">Purchase Date</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>{{$showRoom->name}}</td>
                                    <td>{{$productInfo->code}}</td>
                                    <td>{{$productInfo->name}}</td>
                                    <td>{{$invoice->customer_product_price}}</td>
                                    <td>{{$invoice->customer_product_model}}</td>
                                    <td>{{$invoice->customer_product_color}}</td>
                                    <td align="center">{{$invoice->customer_product_waranty}}</td>
                                    <td align="center">{{$invoice->customer_product_purchase_date}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
 
@endsection

@section('custom-js')
    <script type="text/javascript">
        $(document).ready(function () {
            $("form").submit(function(e)
            {
                if (!$("input[name='purchaseType']").is(':checked'))
                {
                    e.preventDefault();
                    swal("Please! Select Purchase Type", "", "warning");   
                }
                else
                {
                    if (!$("#customerProductId").val())
                    {
                        e.preventDefault();
                        swal("Please! Select A Product", "", "warning");   
                    }
                    else
                    {
                        if (!$("#productSerial").val())
                        {
                            e.preventDefault();
                            swal("Please! Select Product Serial", "", "warning");   
                        }
                    }
                }

            });
        });

        $("input[type='radio']").click(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });            
            
            var purchaseType = $("input[name='purchaseType']:checked").val();

            $.ajax({
                type:'post',
                url:'{{ route('invoiceSetup.getAllProduct') }}',
                data:{purchaseType:purchaseType},
                success:function(data){
                    $('#prodct-select-menu').html(data);
                    $(".chosen-select").chosen();
                }
            });
        });

        $(document).on('change', '#customerProductId', function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            var customerProductId = $('#customerProductId').val();

            $.ajax({
                type:'post',
                url:'{{ route('invoiceSetup.getAllProductSerial') }}',
                data:{customerProductId:customerProductId},
                success:function(data){
                    $('#prodct-serial-select-menu').html(data);
                    $(".chosen-select").chosen();
                }
            });
        });
    </script>
@endsection

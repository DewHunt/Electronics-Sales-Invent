@extends('admin.layouts.master')

@section('content')
    <style type="text/css">
        .blockTitle{
            color: #333;
            font-family: tahoma;
            border-bottom: 1px solid #a2a2a2;
            display: inline-block;
            padding-bottom: 6px;
        }
    </style>

    <div style="padding-bottom: 10px;"></div>

    <form class="form-horizontal" action="{{ route($formLink) }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="customerProductId" value="{{$customerProduct->id}}">
        <input type="hidden" name="customerId" value="{{$customerProduct->customer_id}}">

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6"><h4 class="card-title">{{ $title }}</h4></div>
                    <div class="col-md-6 text-right">
                        <a class="btn btn-outline-info btn-lg" onclick="GoBack()">
                            <i class="fa fa-arrow-circle-left"></i> Go Back
                        </a>
                    </div>
                </div>
            </div>

            @php
                $purchaseDate =  date('d-m-Y',strtotime($customerProduct->purchase_date));
            @endphp
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="text-center" style="font-weight: bold;font-family: tahoma">Product Description</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('productId') ? ' has-danger' : '' }}">
                            <label for="productId">Product Name</label>
                            <select class="form-control chosen-select product" name="productId" data-placeholder="Select Product">
                                <option value="">Select Product</option>
                                @foreach ($products as $product)
                                @php
                                    if($product->id == $customerProduct->product_id){
                                        $selected = "selected";
                                    }else{
                                      $selected = "";  
                                    }
                                @endphp
                                  <option value="{{$product->id}}" {{$selected}}>{{$product->name}} ({{$product->code}})</option>
                                @endforeach
                            </select>
                            @if ($errors->has('productId'))
                                @foreach($errors->get('productId') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('productModel') ? ' has-danger' : '' }}">
                                    <label for="nick-name">Product Model</label>
                                    <input type="text" class="form-control productModel" name="productModel" value="{{ $customerProduct->product_model }}" required readonly="">
                                    @if ($errors->has('productModel'))
                                        @foreach($errors->get('productModel') as $error)
                                            <div class="form-control-feedback">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('warranty') ? ' has-danger' : '' }}">
                                    <label for="warranty">Warranty</label>
                                    <input type="number" name="warranty" class="form-control warranty" value="{{$customerProduct->warranty}}" readonly>
                                    @if ($errors->has('warranty'))
                                        @foreach($errors->get('warranty') as $error)
                                            <div class="form-control-feedback">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('cashPrice') ? ' has-danger' : '' }}">
                                    <label for="cash-price">Cash Price</label>
                                    <input type="number" name="cashPrice" class="form-control cashPrice" value="{{$customerProduct->cash_price}}" readonly>
                                    @if ($errors->has('cashPrice'))
                                        @foreach($errors->get('cashPrice') as $error)
                                            <div class="form-control-feedback">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('showroomId') ? ' has-danger' : '' }}">
                            <label for="showroom-id">Showroom</label>
                            <select class="form-control chosen-select" name="showroomId">
                                <option value="">Select Showroom</option>
                                @foreach ($showrooms as $showroom)
                                 @php
                                    if($showroom->id == $customerProduct->showroom_id){
                                        $selected = "selected";
                                    }else{
                                      $selected = "";  
                                    }
                                @endphp
                                    <option value="{{$showroom->id}}" {{$selected}}>{{$showroom->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('showroomId'))
                                @foreach($errors->get('showroomId') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                 <div class="form-group {{ $errors->has('purchaseDate') ? ' has-danger' : '' }}">
                                    <label for="purchase-date">Purchase Date</label>
                                    <input type="text" name="purchaseDate" class="form-control datepicker" value="{{$purchaseDate}}" readonly="">
                                    @if ($errors->has('purchaseDate'))
                                        @foreach($errors->get('purchaseDate') as $error)
                                            <div class="form-control-feedback">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="purchase-type">Purchase Type</label>
                                 <div class="form-group {{ $errors->has('purchaseType') ? ' has-danger' : '' }}">
                                     <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" value="Cash" name="purchaseType" class="purchaseType" required {{ $customerProduct->purchase_type == "Cash" ? 'checked' : '' }}> Cash
                                        </label>
                                    </div>

                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" value="Installment" name="purchaseType" class="purchaseType" {{ $customerProduct->purchase_type == "Installment" ? 'checked' : '' }}> Installment
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
                    </div>
                </div>

                <div class="row installmentRow">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('deposite') ? ' has-danger' : '' }}">
                                    <label for="deposite">Deposite</label>
                                    <input type="number" class="form-control" name="deposite" value="{{ $customerProduct->deposite }}">
                                    @if ($errors->has('deposite'))
                                        @foreach($errors->get('deposite') as $error)
                                            <div class="form-control-feedback">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('installmentPrice') ? ' has-danger' : '' }}">
                                    <label for="installment-price">Installment Price</label>
                                    <input type="number" class="form-control" name="installmentPrice" value="{{ $customerProduct->installment_price }}">
                                    @if ($errors->has('installmentPrice'))
                                        @foreach($errors->get('installmentPrice') as $error)
                                            <div class="form-control-feedback">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                           <div class="col-md-6">
                                <div class="form-group {{ $errors->has('totalInstallment') ? ' has-danger' : '' }}">
                                    <label for="total-installment">Total Installment</label>
                                    <input type="number" class="form-control" name="totalInstallment" value="{{ $customerProduct->total_installment }}">
                                    @if ($errors->has('totalInstallment'))
                                        @foreach($errors->get('totalInstallment') as $error)
                                            <div class="form-control-feedback">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('monthlyInstallmentAmount') ? ' has-danger' : '' }}">
                                    <label for="monthly-installment-amount">Monthly Installment Amount</label>
                                    <input type="number" class="form-control" name="monthlyInstallmentAmount" value="{{ $customerProduct->monthly_installment_amount }}">
                                    @if ($errors->has('monthlyInstallmentAmount'))
                                        @foreach($errors->get('monthlyInstallmentAmount') as $error)
                                            <div class="form-control-feedback">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group {{ $errors->has('productUsageAddress') ? ' has-danger' : '' }}">
                            <label for="product-usage-address">Product Usage Address</label>
                            <textarea name="productUsageAddress" class="form-control" rows="5">{{ $customerProduct->product_usage_address }}</textarea>
                            @if ($errors->has('productUsageAddress'))
                                @foreach($errors->get('productUsageAddress') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-outline-info btn-lg waves-effect"><i class="fa fa-save"></i> {{ $buttonName }}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('custom-js')
    <script type="text/javascript">
    /*code for product info*/
        $(document).on('change', '.product', function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            var productId = $('.product option:selected').val();
            if(productId != ''){
                $.ajax({
                    type:'post',
                    url:'{{ route('customerRegistration.getProductInfo') }}',
                    data:{productId:productId},
                    success:function(data){
                        var product = data.product;
                        $('.productModel').val(product.model_no);
                        $('.cashPrice').val(product.price);
                        $('.warranty').val(product.warranty);
                    }
                });
            }else{
               $('.productModel').val('');
               $('.cashPrice').val(''); 
               $('.warranty').val(''); 
            }
        });

    /*end code for product info*/

    </script>

@endsection
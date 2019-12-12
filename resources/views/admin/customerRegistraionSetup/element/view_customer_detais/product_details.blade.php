@php
use App\Product;
use App\ShowroomSetup;
@endphp
<style type="text/css">
    .productTable th{
        font-size: 11px;
    }
</style>
<h4 class="text-center ">Previous Product List</h4>
<table class="table table-bordered table-sm productTable">
    <thead class="thead-dark">
        <tr>
            <th>Showroom</th>
            <th width="90px">Purchase Date</th>
            <th width="90px">Purchase Type</th>
            <th>Name</th>
            <th>Model</th>
            <th>Price</th>
            <th>Deposite</th>
            <th width="100px">Installment Price</th>
            <th width="100px">Total Installment</th>
            <th width="100px">Mothly Installment</th>
            <th width="50px" class="text-center">Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($customerProducts as $customerProduct)
             @php
                $purchaseDate =  date('d-m-Y',strtotime($customerProduct->purchase_date));
                $productDetails= Product::where('id',$customerProduct->product_id)->first();
                $showroomDetails= ShowroomSetup::where('id',$customerProduct->showroom_id)->first();
             @endphp
        <tr>
            <td>{{ $showroomDetails->name }}</td>
            <td>{{ $purchaseDate }}</td>
            <td>{{ $customerProduct->purchase_type }}</td>
            <td>{{ $productDetails->name }}</td>
            <td>{{ $customerProduct->product_model }}</td>
            <td>{{ $customerProduct->cash_price }}</td>
            <td>{{ $customerProduct->deposite }}</td>
            <td>{{ $customerProduct->installment_price }}</td>
            <td>{{ $customerProduct->total_installment }}</td>
            <td>{{ $customerProduct->monthly_installment_amount }}</td>
            <td align="center">
                <a href="{{route('customerRegistraionSetup.editCustomerProduct',['customerId'=>$customer->id,'productId'=>$customerProduct->id])}}" data-toggle="tooltip" title="Edi This Product" class="btn btn-success btn-sm">Edit</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="row">
    <div class="col-md-12">
        <h4 class="text-center ">Previous Guarantor List</h4>
        <table class="table table-bordered table-sm productTable">
            <thead class="thead-dark">
                <tr>
                    <th>Product</th>
                    <th width="80px">Model</th>
                    <th>Name</th>
                    <th>Phone No</th>
                    <th width="150px">Present Address</th>
                    <th width="150px">Permanent Address</th>
                    <th class="text-center" width="205px">Choose As New Guarantor</th>
                    <th width="50px" class="text-center">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($customerGuarantor as $guarantor)
                     @php
                        $productDetails= Product::where('id',$guarantor->product_id)->first();
                     @endphp
                <tr>
                    <td>{{@$productDetails->name}}</td>
                    <td>{{@$productDetails->model_no}}</td>
                    <td>{{@$guarantor->gurantor_name}}</td>
                    <td>{{@$guarantor->gurantor_phone_no}}</td>
                    <td>{{@$guarantor->guarantor_present_address}}</td>
                    <td>{{@$guarantor->guarantor_permanent_address}}</td>
                    <td align="center">
                        <a href="javascript:void(0)" data-toggle="tooltip" title="Select As New First Guarantor" class="btn btn-info btn-sm" onclick="FirstGurantor({{$guarantor->id}})">1st Guarantor</a>
                        <a href="javascript:void(0)" data-toggle="tooltip" title="Select As New Second Guarantor" class="btn btn-info btn-sm" onclick="SecondGurantor({{$guarantor->id}})">2nd Guarantor</a>
                    </td>
                    <td align="center">
                        <a href="{{route('customerRegistraionSetup.editGuarantor',['customerId'=>$customer->id,'guarantorId'=>$guarantor->id])}}" data-toggle="tooltip" title="Edi This Guarantor" class="btn btn-success btn-sm">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-12"></div>
</div>

<div class="row">
    <div class="col-md-12 text-right">
        <a style="font-size: 16px;" class="btn btn-outline-info btn-lg newProductLinkButton" href="javascript:void(0)">
            <i class="fa fa-plus-circle"></i> Create New Product
        </a>

        <a style="font-size: 16px;" class="btn btn-outline-info btn-lg removeBlockButton" href="javascript:void(0)">
            <i class="fa fa-trash"></i> Remove Block
        </a>
    </div>
</div>

<div class="row newProductBlock">
    <input type="hidden" class="hiddenProduct" name="hiddenProduct">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-center" style="font-weight: bold;font-family: tahoma">New Product</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('productId') ? ' has-danger' : '' }}">
                    <label for="productId">Product Name</label>
                    <select class="form-control chosen-select product" name="productId" data-placeholder="Select Product">
                        <option value="">Select Product</option>
                        @foreach ($products as $product)
                          <option value="{{$product->id}}">{{$product->name}} ({{$product->code}})</option>
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
                <div class="form-group {{ $errors->has('showroomId') ? ' has-danger' : '' }}">
                    <label for="showroom-id">Showroom</label>
                    <select class="form-control chosen-select" name="showroomId">
                        <option value="">Select Showroom</option>
                        @foreach ($showrooms as $showroom)
                            <option value="{{$showroom->id}}">{{$showroom->name}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('showroomId'))
                        @foreach($errors->get('showroomId') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('productModel') ? ' has-danger' : '' }}">
                            <label for="nick-name">Product Model</label>
                            <input type="text" class="form-control productModel" name="productModel" value="{{ old('productModel') }}" required readonly="">
                            @if ($errors->has('productModel'))
                                @foreach($errors->get('productModel') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('warranty') ? ' has-danger' : '' }}">
                            <label for="warranty">Warranty</label>
                            <input type="number" name="warranty" class="form-control warranty" readonly>
                            @if ($errors->has('warranty'))
                                @foreach($errors->get('warranty') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group {{ $errors->has('purchaseDate') ? ' has-danger' : '' }}">
                    <label for="purchase-date">Purchase Date</label>
                    <input type="text" name="purchaseDate" class="form-control add_datepicker" readonly="">
                    @if ($errors->has('purchaseDate'))
                        @foreach($errors->get('purchaseDate') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('cashPrice') ? ' has-danger' : '' }}">
                            <label for="cash-price">Cash Price</label>
                            <input type="number" name="cashPrice" class="form-control cashPrice" readonly>
                            @if ($errors->has('cashPrice'))
                                @foreach($errors->get('cashPrice') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('mrpPrice') ? ' has-danger' : '' }}">
                            <label for="mrp-price">Mrp Price</label>
                            <input type="number" name="mrpPrice" class="form-control mrpPrice" readonly>
                            @if ($errors->has('mrpPrice'))
                                @foreach($errors->get('mrpPrice') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
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
                                <input type="radio" value="Installment" name="purchaseType" class="product purchaseType"> Installment
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

        <div class="row installmentRow">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('deposite') ? ' has-danger' : '' }}">
                            <label for="deposite">Deposite</label>
                            <input type="number" class="form-control deposite" name="deposite" value="{{ old('deposite') }}">
                            @if ($errors->has('deposite'))
                                @foreach($errors->get('deposite') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('installmentPrice') ? ' has-danger' : '' }}">
                            <label for="haire-price">Haire Price</label>
                            <input type="number" class="form-control installmentPrice" name="installmentPrice" value="{{ old('installmentPrice') }}">
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
                            <input type="number" class="form-control totalInstallment" name="totalInstallment" value="{{ old('totalInstallment') }}" oninput="monthlyInstallment()">
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
                            <input type="number" class="form-control monthlyInstallmentAmount" name="monthlyInstallmentAmount" value="{{ old('monthlyInstallmentAmount') }}">
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
                    <textarea name="productUsageAddress" class="form-control" style="min-height: 123px;" required=""></textarea>
                    @if ($errors->has('productUsageAddress'))
                        @foreach($errors->get('productUsageAddress') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>



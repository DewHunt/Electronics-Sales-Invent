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

                <div class="col-md-3">
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

                <div class="col-md-3">
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

        <div class="col-md-6">
            <div class="row">
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

                <div class="col-md-6">
                    <label for="purchase-type">Purchase Type</label>
                     <div class="form-group {{ $errors->has('purchaseType') ? ' has-danger' : '' }}">
                         <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" value="Cash" name="purchaseType" class="purchaseType" required> Cash
                            </label>
                        </div>

                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" value="Installment" name="purchaseType" class="purchaseType"> Installment
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
                        <input type="number" class="form-control" name="deposite" value="{{ old('deposite') }}">
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
                        <input type="number" class="form-control" name="installmentPrice" value="{{ old('installmentPrice') }}">
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
                        <input type="number" class="form-control" name="totalInstallment" value="{{ old('totalInstallment') }}">
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
                        <input type="number" class="form-control" name="monthlyInstallmentAmount" value="{{ old('monthlyInstallmentAmount') }}">
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
                <textarea name="productUsageAddress" class="form-control" rows="5"></textarea>
                @if ($errors->has('productUsageAddress'))
                    @foreach($errors->get('productUsageAddress') as $error)
                        <div class="form-control-feedback">{{ $error }}</div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
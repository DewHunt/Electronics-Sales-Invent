@extends('admin.layouts.masterAddEdit')

@section('card_body')
    <style type="text/css">
        .chosen-single{
            height: 35px !important;
        }
    </style>
    @php
    	$serialNo = "";    	
        use App\Lifting;

        $purchaseBy = Auth::user()->name;

        $maxLifting = Lifting::max('id');

        if (@$maxLifting)
        {
            $serialNo = 1000000 + $maxLifting + 1;
        }
        else
        {
            $serialNo = 1000000 + 1;
        }
    @endphp

    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <label for="sl-no">SL No</label>
                        <div class="form-group {{ $errors->has('serialNo') ? ' has-danger' : '' }}">
                            <input type="text" class="form-control" name="serialNo" value="{{ $serialNo }}" required readonly/>
                            @if ($errors->has('serialNo'))
                                @foreach($errors->get('serialNo') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="vouchar-no">Voucher No</label>
                        <div class="form-group {{ $errors->has('voucharNo') ? ' has-danger' : '' }}">
                            <input type="text" class="form-control" name="voucharNo" value="{{ old('voucharNo') }}" required>
                            @if ($errors->has('voucharNo'))
                                @foreach($errors->get('voucharNo') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="supplier">Supplier</label>
                        <div class="form-group {{ $errors->has('vendorId') ? ' has-danger' : '' }}">
                            <select class="form-control chosen-select" name="vendorId" required="">
                                <option value=" ">Select Supplier</option>
                                @foreach ($vendors as $vendor)
                                    <option value="{{$vendor->id}}">{{ $vendor->name }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('vendorId'))
                                @foreach($errors->get('vendorId') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="vaouchar-date">Vouchar Date</label>
                        <div class="form-group {{ $errors->has('voucherDate') ? ' has-danger' : '' }}">
                            <input type="text" class="form-control add_datepicker" name="voucherDate" value="{{ old('voucherDate') }}" readonly>
                            @if ($errors->has('voucherDate'))
                                @foreach($errors->get('voucherDate') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="purchase-by">Purchase By</label>
                        <div class="form-group {{ $errors->has('purchaseBy') ? ' has-danger' : '' }}">
                            <input  type="text" class="form-control" name="purchaseBy" value="{{ $purchaseBy }}" required readonly>
                            @if ($errors->has('purchaseBy'))
                                @foreach($errors->get('purchaseBy') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="submission-date">Submission Date</label>
                        <div class="form-group {{ $errors->has('submissionDate') ? ' has-danger' : '' }}">
                            <input type="text" class="form-control add_datepicker" name="submissionDate" value="{{ old('submissionDate') }}" readonly>
                            @if ($errors->has('submissionDate'))
                                @foreach($errors->get('submissionDate') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="supplier">Products</label>
                        <div class="form-group {{ $errors->has('product_d') ? ' has-danger' : '' }}">
                            <select class="form-control chosen-select" id="product" name="product_d">
                                <option value="">Select Product</option>
                                @foreach ($products as $product)
                                    <option value="{{$product->id}}">{{ $product->name }} ( {{ $product->code }} - {{ $product->color }} - {{ $product->model_no }}  )</option>
                                @endforeach
                            </select>

                            @if ($errors->has('product_d'))
                                @foreach($errors->get('product_d') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="product-serial-no">Products Serial No.</label>
                        <div class="form-group {{ $errors->has('product_serial_no') ? ' has-danger' : '' }}">
                            <input  type="text" class="form-control" id="product_serial_no" name="product_serial_no" value="">
                            @if ($errors->has('product_serial_no'))
                                @foreach($errors->get('product_serial_no') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label for=""></label>
                        <div class="form-group">
	                        <input type="hidden" class="row_count" value="0">
	                        <span class="btn btn-outline-success add_item" style="width: 100%;">
	                            <i class="fa fa-arrow-down"></i> Add More
	                        </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label for=""></label>
                        <div class="form-group">
                            <table class="table table-bordered table-striped gridTable" >
                                <thead>
                                    <tr>
                                        <th>Product Name & Code</th>
                                        <th width="160px">Model</th>
                                        <th width="100px">Color</th>
                                        <th width="160px">Serial No</th>
                                        <th width="80px">Price</th>
                                        <th width="90px">MRP Price</th>
                                        <th width="110px">Higher Price</th>
                                        <th width="80px">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <label for="supplier">Total Quantity</label>
                        <div class="form-group">
                        	<input style="text-align: right;" class="form-control totalQty" type="number" name="totalQty" value="0" readonly>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="supplier">Total Price</label>
                        <div class="form-group">
                        	<input style="text-align: right;" class="form-control totalPrice" type="number" name="totalPrice" value="0" readonly>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="supplier">Total MRP Price</label>
                        <div class="form-group">
                            <input style="text-align: right;" class="form-control totalMrpPrice" type="number" name="totalMrpPrice" value="0" readonly>
                        </div>
                    </div>             <div class="col-md-3">
                        <label for="supplier">Total Higher Price</label>
                        <div class="form-group">
                            <input style="text-align: right;" class="form-control totalHairePrice" type="number" name="totalHairePrice" value="0" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
    <script type="text/javascript">
        $(".add_item").click(function () {
            var productId = $("#product option:selected").val();
            var serialNo = $("#product_serial_no").val();

        	if (productId == "" || serialNo == "")
        	{
                swal("Please! Select A Product And Enter Serial Number", "", "warning");
        	}
        	else
        	{
	        	var row_count = $('.row_count').val();
	            var total = parseInt(row_count) + 1; 
	            $(".gridTable tbody").append(
	            	'<tr id="itemRow_' + total + '">' +                
		                '<td>'+
		                	'<input class="productId_'+total+'" type="hidden" name="productId[]" value="">'+
		                	'<input class="productName_'+total+'" type="text" name="productName[]" value="" readonly>'+
		                '</td>'+
		                '<td>'+
		                	'<input class="productModel_'+total+'" type="text" name="productModel[]" value="" readonly>'+
		                '</td>'+
		                '<td>'+
		                	'<input class="productColor_'+total+'" type="text" name="productColor[]" value="" readonly>'+
		                '</td>'+
		                '<td>'+
		                	'<input class="productSerialNo_'+total+'" type="text" name="productSerialNo[]" value="" required>'+
		                '</td>'+

		                '<td>'+
		                    '<input class="productQty_'+total+'" type="hidden" name="productQty[]" value="1">'+
		                    '<input style="text-align: right;" class="productPrice productPrice_'+total+'" type="number" name="productPrice[]" value="" oninput="findMrpHairePrice('+total+')" required>'+
                            '<input class="price_'+total+'" type="hidden" name="price[]" value="">'+
                        '</td>'+

                        '<td>'+
	                        '<input style="text-align: right;" class="productMrpPrice_'+total+'" type="number" name="productMrpPrice[]" value="" readonly>'+
                        '</td>'+

                        '<td>'+
	                        '<input style="text-align: right;" class="productHairePrice_'+total+'" type="number" name="productHairePrice[]" value="" readonly>'+
		                '</td>'+
		                '<td align="center">'+
		                	'<span class="btn btn-outline-danger btn-sm item_remove" onclick="itemRemove('+total+')" style="width: 100%;">'+
		                		'<i class="fa fa-trash"></i> Remove'+
		                	'</span>'+
		                '</td>'+
	                '</tr>'
	            );
	            $('.row_count').val(total);

	            $.ajax({
	                headers: {
	                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                },
	                type: "POST",
	                url: "{{ route('lifting.productInfo') }}",
	                data:{productId:productId},
	                success: function(response) {
	                    var product = response.product;

                        $('.productId_'+total).val(product.id);
                        $('.productName_'+total).val(product.name);
                        $('.productModel_'+total).val(product.model_no);
                        $('.productColor_'+total).val(product.color);
                        $('.productSerialNo_'+total).val(serialNo);
                        $('.price_'+total).val(product.price);
                        $('.productPrice_'+total).val(product.price);
                        $('.productMrpPrice_'+total).val(product.mrp_price);
                        $('.productHairePrice_'+total).val(product.haire_price);

			            var totalQty = parseFloat($('.totalQty').val()) + parseFloat($('.productQty_'+total).val());
			            var totalPrice = parseFloat($('.totalPrice').val()) + parseFloat($('.productPrice_'+total).val());
			            var totalMrpPrice = parseFloat($('.totalMrpPrice').val()) + parseFloat($('.productMrpPrice_'+total).val());
			            var totalHairePrice = parseFloat($('.totalHairePrice').val()) + parseFloat($('.productHairePrice_'+total).val());
	                    $('.totalQty').val(totalQty);
	                    $('.totalPrice').val(Math.round(totalPrice));
	                    $('.totalMrpPrice').val(Math.round(totalMrpPrice));
	                    $('.totalHairePrice').val(Math.round(totalHairePrice));
	                },
	                error: function(response) {

	                }
	            });

	            $('#product_serial_no').val('').focus();
        	}            
        });

        function findMrpHairePrice(i)
        {
            var totalPrice = parseFloat($('.totalPrice').val()) - parseFloat($('.price_'+i).val());
            var totalMrpPrice = parseFloat($('.totalMrpPrice').val()) - parseFloat($('.productMrpPrice_'+i).val());
            var totalHairePrice = parseFloat($('.totalHairePrice').val()) - parseFloat($('.productHairePrice_'+i).val());

            if ($(".productPrice_"+i).val() == "")
            {
                var price = 0
            }
            else
            {
                var price = parseFloat($(".productPrice_"+i).val());
            }

            var mrpPrice = price + (price * 8)/100;
            var hairePrice = mrpPrice + (mrpPrice * 12)/100;
            $(".productMrpPrice_"+i).val(Math.round(mrpPrice));
            $(".productHairePrice_"+i).val(Math.round(hairePrice));

            totalPrice = totalPrice + price;
            // alert(totalPrice);
            totalMrpPrice = totalMrpPrice + parseFloat($('.productMrpPrice_'+i).val());
            totalHairePrice = totalHairePrice + parseFloat($('.productHairePrice_'+i).val());

            $('.totalPrice').val(Math.round(totalPrice));
            $('.totalMrpPrice').val(Math.round(totalMrpPrice));
            $('.totalHairePrice').val(Math.round(totalHairePrice));
            $('.price_'+i).val(Math.round(price));
        }

        function itemRemove(i) {
            var totalQty = parseFloat($('.totalQty').val());
            var totalPrice = parseFloat($('.totalPrice').val());
            var totalMrpPrice = parseFloat($('.totalMrpPrice').val());
            var totalHairePrice = parseFloat($('.totalHairePrice').val());

            var quantity = parseFloat($('.productQty_'+i).val());
            var productPrice = parseFloat($('.productPrice_'+i).val());
            var productMrpPrice = parseFloat($('.productMrpPrice_'+i).val());
            var productHairePrice = parseFloat($('.productHairePrice_'+i).val());

            totalQty = totalQty - quantity;
            totalPrice = totalPrice - productPrice;
            totalMrpPrice = totalMrpPrice - productMrpPrice;
            totalHairePrice = totalHairePrice - productHairePrice;

            $('.totalQty').val(totalQty.toFixed(2));
            $('.totalPrice').val(totalPrice.toFixed(2));
            $('.totalMrpPrice').val(totalMrpPrice.toFixed(2));
            $('.totalHairePrice').val(totalHairePrice.toFixed(2));

            $("#itemRow_" + i).remove();
            $('#product_serial_no').val('').focus();
        }          
    </script>

@endsection
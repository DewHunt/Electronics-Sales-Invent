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
                                        <th width="10%">Model</th>
                                        <th width="10%">Color</th>
                                        <th width="150px">Serial No</th>
                                        <th width="100px">Price</th>
                                        <th width="80px">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                </tbody>

                                {{-- <tfoot>
                                    <tr>
                                        <th>Total Quantity</th>
                                        <td>
                                            <input class="total_qty" type="number" name="total_qty" value="1" readonly>
                                        </td>

                                        <th>Total Amount</th>
                                        <td>
                                            <input style="text-align: right;" class="total_amount" type="number" name="total_amount" value="0" readonly>
                                        </td>

                                        <td align="center">
                                            <input type="hidden" class="row_count" value="1">
                                            <span class="btn btn-outline-success add_item">
                                                <i class="fa fa-plus-circle"></i> Add More
                                            </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td rowspan="3" colspan="2"></td>
                                        <th>Discount</th>
                                        <td>
                                            <input style="text-align: right;" class="discount" type="number" name="discount" value="0" oninput="netAmount()">
                                        </td>

                                        <td rowspan="3" class="text-right" style="padding-top: 5px;">
                                            <div style="padding-top: 10px;">
                                                <button type="submit" class="btn btn-outline-info btn-md waves-effect">
                                                    <span style="font-size: 16px;">
                                                        <i class="fa fa-save"></i> Save Data
                                                    </span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Vat</th>
                                        <td>
                                            <input style="text-align: right;" class="vat" type="number" name="vat" value="0" oninput="netAmount()">
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Net Amount</th>
                                        <td>
                                            <input style="text-align: right;" class="net_amount" type="number" name="net_amount" value="0" readonly>
                                        </td>
                                    </tr>
                                </tfoot> --}}
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="supplier">Total Quantity</label>
                        <div class="form-group">
                        	<input style="text-align: right;" class="form-control totalQty" type="number" name="totalQty" value="0" readonly>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="supplier">Total Price</label>
                        <div class="form-group {{ $errors->has('productId') ? ' has-danger' : '' }}">
                        	<input style="text-align: right;" class="form-control totalPrice" type="number" name="totalPrice" value="0" readonly>
                        	<input style="text-align: right;" class="form-control totalMrpPrice" type="hidden" name="totalMrpPrice" value="0" readonly>
                        	<input style="text-align: right;" class="form-control totalHairePrice" type="hidden" name="totalHairePrice" value="0" readonly>
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
            var productId = $("#product :selected").val();
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
		                	'<input class="productSerialNo_'+total+'" type="text" name="productSerialNo[]" value="" readonly>'+
		                '</td>'+

		                '<td>'+
		                    '<input class="productQty productQty_'+total+'" type="hidden" name="productQty[]" value="1">'+
		                    '<input style="text-align: right;" class="productPrice productPrice_'+total+'" type="number" name="productPrice[]" value="" readonly>'+
	                        '<input class="productMrpPrice_'+total+'" type="hidden" name="productMrpPrice[]" value="">'+
	                        '<input class="productHairePrice_'+total+'" type="hidden" name="productHairePrice[]" value="">'+
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

			            var totalQty = parseFloat($('.totalQty').val()) + parseFloat($('.productQty_'+total).val());
			            var totalPrice = parseFloat($('.totalPrice').val()) + parseFloat(product.price);
			            var totalMrpPrice = parseFloat($('.totalMrpPrice').val()) + parseFloat(product.mrp_price);
			            var totalHairePrice = parseFloat($('.totalHairePrice').val()) + parseFloat(product.haire_price);

	                    $('.productId_'+total).val(product.id);
	                    $('.productName_'+total).val(product.name);
	                    $('.productModel_'+total).val(product.model_no);
	                    $('.productColor_'+total).val(product.color);
	                    $('.productSerialNo_'+total).val(serialNo);
	                    $('.productPrice_'+total).val(product.price);
	                    $('.productMrpPrice_'+total).val(product.mrp_price);
	                    $('.productHairePrice_'+total).val(product.haire_price);
	                    $('.totalQty').val(totalQty);
	                    $('.totalPrice').val(parseFloat(totalPrice).toFixed(2));
	                    $('.totalMrpPrice').val(parseFloat(totalMrpPrice).toFixed(2));
	                    $('.totalHairePrice').val(parseFloat(totalHairePrice).toFixed(2));
	                },
	                error: function(response) {

	                }
	            });

	            $('#product_serial_no').val('').focus();
        	}
            
        });

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

        // function row_sum() {
        //     var totalQty = $('.total_qty').val();
        //     var totalAmount = $('.total_amount').val();

        //     var quantity = $('.productQty'+i).val();
        //     var amount = $('.productPrice_'+i).val();

        //     totalQty = totalQty + quantity;
        //     totalAmount = totalAmount + amount;

        //     $('.totalQty').val(totalQty.toFixed(2));
        //     $('.totalAmount').val(totalAmount.toFixed(2));
        // }

        // function netAmount(){
        //     var net_amount = 0;
        //     var total_amount = parseFloat($(".total_amount").val());

        //     if($(".discount").val() == '')
        //     {
        //         alert("Discount Amount Can't Empty");
        //         var discount = 0;
        //         $(".discount").val(0);
        //     }
        //     else
        //     {
        //         if (parseFloat($(".discount").val()) > total_amount)
        //         {
        //             alert("You Can't Get Discount Greater Than Total Amount");
        //             $(".discount").val(0);
        //             var discount = 0;
        //         }
        //         else
        //         {
        //             var discount = parseFloat($(".discount").val());
        //         }
        //     }

        //     if(parseFloat($(".vat").val()) == '')
        //     {
        //         var vat = 0;
        //     }
        //     else
        //     {
        //         var vat = parseFloat($(".vat").val());
        //     }

        //     net_amount = (total_amount + vat) - discount;
        //     $('.net_amount').val(net_amount.toFixed(2));
        // }          
    </script>

@endsection
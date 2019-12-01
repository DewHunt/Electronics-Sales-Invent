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
                    <div class="col-6">
                        <label for="sl-no">SL No</label>
                        <div class="form-group {{ $errors->has('serialNo') ? ' has-danger' : '' }}">
                            <input type="text" class="form-control form-control-danger" name="serialNo" value="{{ $serialNo }}" required readonly/>
                            @if ($errors->has('serialNo'))
                                @foreach($errors->get('serialNo') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="col-6">
                        <label for="vouchar-no">Voucher No</label>
                        <div class="form-group {{ $errors->has('voucharNo') ? ' has-danger' : '' }}">
                            <input type="text" class="form-control form-control-danger" name="voucharNo" value="{{ old('voucharNo') }}" required>
                            @if ($errors->has('voucharNo'))
                                @foreach($errors->get('voucharNo') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <label for="supplier">Supplier</label>
                        <div class="form-group {{ $errors->has('vendorId') ? ' has-danger' : '' }}">
                            <select class="form-control form-control-danger chosen-select" name="vendorId" required="">
                                <option value=" ">Select Supplier</option>
                                @foreach ($vendors as $vendor)
                                    <option value="{{$vendor->id}}">{{ $vendor->vendorName }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('vendorId'))
                                @foreach($errors->get('vendorId') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="col-6">
                        <label for="vaouchar-date">Vouchar Date</label>
                        <div class="form-group {{ $errors->has('voucherDate') ? ' has-danger' : '' }}">
                            <input  type="text" class="form-control form-control-danger add_datepicker" name="voucherDate" value="{{ old('voucherDate') }}" readonly>
                            @if ($errors->has('voucherDate'))
                                @foreach($errors->get('voucherDate') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <label for="purchase-by">Purchase By</label>
                        <div class="form-group {{ $errors->has('purchaseBy') ? ' has-danger' : '' }}">
                            <input  type="text" class="form-control form-control-danger" name="purchaseBy" value="{{ $purchaseBy }}" required readonly>
                            @if ($errors->has('purchaseBy'))
                                @foreach($errors->get('purchaseBy') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="col-6">
                        <label for="submission-date">Submission Date</label>
                        <div class="form-group {{ $errors->has('submissionDate') ? ' has-danger' : '' }}">
                            <input  type="text" class="form-control form-control-danger add_datepicker" name="submissionDate" value="{{ old('submissionDate') }}" readonly>
                            @if ($errors->has('submissionDate'))
                                @foreach($errors->get('submissionDate') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <label for="supplier">Products</label>
                        <div class="form-group {{ $errors->has('productId') ? ' has-danger' : '' }}">
                            <select class="form-control form-control-danger chosen-select" id="product" name="productId" required="">
                                <option value=" ">Select Product</option>
                                @foreach ($products as $product)
                                    <option value="{{$product->id}}">{{ $product->name }} ( {{ $product->code }} - {{ $product->color }} - {{ $product->model_no }}  )</option>
                                @endforeach
                            </select>

                            @if ($errors->has('productId'))
                                @foreach($errors->get('productId') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="col-6">
                        <label for=""></label>
                        <div class="form-group">
	                        <input type="hidden" class="row_count" value="0">
	                        <span class="btn btn-outline-success add_item" style="width: 100%;">
	                            <i class="fa fa-plus-circle"></i> Add More
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
                                        <th width="10%">Color</th>
                                        <th width="150px">Serial No</th>
                                        <th width="100px">Amount</th>
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
                    <div class="col-6">
                        <label for="supplier">Total Quantity</label>
                        <div class="form-group">
                        	<input style="text-align: right;" class="form-control totalQty" type="number" name="totalQty" value="0" readonly>
                        </div>
                    </div>

                    <div class="col-6">
                        <label for="supplier">Total Amount</label>
                        <div class="form-group {{ $errors->has('productId') ? ' has-danger' : '' }}">
                        	<input style="text-align: right;" class="form-control totalAmount" type="number" name="totalAmount" value="0" readonly>
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
            var row_count = $('.row_count').val();
            var total = parseInt(row_count) + 1; 
            $(".gridTable tbody").append(
            	'<tr id="itemRow_' + total + '">' +                
	                '<td>'+
	                	'<input class="productId_'+total+'" type="hidden" name="productId[]" value="" required>'+
	                	'<input class="productName_'+total+'" type="text" name="productName[]" value="" required readonly>'+
	                '</td>'+
	                '<td>'+
	                	'<input class="productColor_'+total+'" type="text" name="productColor[]" value="" required readonly>'+
	                '</td>'+
	                '<td>'+
	                	'<input class="productSerialNo_'+total+'" type="text" name="productSerialNo[]" value="" required>'+
	                '</td>'+

	                '<td>'+
	                    '<input class="productQty productQty_'+total+'" type="hidden" name="productQty[]" value="1" required>'+
	                    '<input style="text-align: right;" class="productPrice productPrice_'+total+'" type="number" name="productPrice[]" value="" required readonly>'+
                        '<input class="productMrpPrice_'+total+'" type="hidden" name="productMrpPrice[]" value="" required>'+
                        '<input class="productHairePrice_'+total+'" type="hidden" name="productHairePrice[]" value="" required>'+
	                '</td>'+
	                '<td align="center">'+
	                	'<span class="btn btn-outline-danger btn-sm item_remove" onclick="itemRemove('+total+')" style="width: 100%;">'+
	                		'<i class="fa fa-trash"></i> Remove'+
	                	'</span>'+
	                '</td>'+
                '</tr>'+
                '</tr>'
            );
            $('.row_count').val(total);

            var productId = $("#product :selected").val();
            var totalQty = $('.totalQty').val();
            var quantity = $('.productQty_'+total).val();
            var totalAmount = $('.totalAmount').val();

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
                    $('.productName_'+total).val(product.name+' ( '+product.code+'-'+product.color+'-'+product.model_no+' )');
                    $('.productColor_'+total).val(product.color);
                    $('.productPrice_'+total).val(product.price);
                    $('.productMrpPrice_'+total).val(product.mrp_price);
                    $('.productHairePrice_'+total).val(product.haire_price);
                    $('.totalQty').val(parseFloat(totalQty) + parseFloat(quantity));
                    $('.totalAmount').val(parseFloat(totalAmount) + parseFloat(product.price));
                },
                error: function(response) {

                }
            });
        });

        function itemRemove(i) {
            var totalQty = parseFloat($('.totalQty').val());
            var totalAmount = parseFloat($('.totalAmount').val());

            var quantity = parseFloat($('.productQty_'+i).val());
            var amount = parseFloat($('.productPrice_'+i).val());

            totalQty = totalQty - quantity;
            totalAmount = totalAmount - amount;

            $('.totalQty').val(totalQty.toFixed(2));
            $('.totalAmount').val(totalAmount.toFixed(2));

            $("#itemRow_" + i).remove();
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
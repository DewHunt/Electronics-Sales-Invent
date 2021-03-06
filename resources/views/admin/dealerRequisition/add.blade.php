@extends('admin.layouts.masterAddEdit')

@section('card_body')
    <style type="text/css">
        .chosen-single{
            height: 35px !important;
        }
    </style>
    @php
    	$requisitionNo = "";   
        use App\DealerRequisition;

        $maxDealerRequisitionId = DealerRequisition::max('id');

        if (@$maxDealerRequisitionId)
        {
            $requisitionNo = 100000000 + $maxDealerRequisitionId + 1;
        }
        else
        {
            $requisitionNo = 100000000 + 1;
        }
    @endphp

    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <label for="requisition-no">Requisition No</label>
                <div class="form-group {{ $errors->has('requisitionNo') ? ' has-danger' : '' }}">
                    <input type="text" class="form-control" name="requisitionNo" value="{{ $requisitionNo }}" required readonly/>
                    @if ($errors->has('requisitionNo'))
                        @foreach($errors->get('requisitionNo') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <label for="requisition-date">Requisition Date</label>
                <div class="form-group {{ $errors->has('requisitionDate') ? ' has-danger' : '' }}">
                    <input type="text" class="form-control add_datepicker" name="requisitionDate" value="{{ old('requisitionDate') }}" readonly>
                    @if ($errors->has('requisitionDate'))
                        @foreach($errors->get('requisitionDate') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="dealer">Dealer</label>
                <div class="form-group {{ $errors->has('dealerId') ? ' has-danger' : '' }}">
                    <select class="form-control chosen-select" name="dealerId" required="">
                        <option value=" ">Select Dealer</option>
                        @foreach ($dealers as $dealer)
                            <option value="{{$dealer->id}}">{{ $dealer->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <label for="product">Products</label>
                <div class="form-group {{ $errors->has('product') ? ' has-danger' : '' }}">
                    <select class="form-control chosen-select product" id="product" name="product">
                        <option value="">Select Product</option>
                        @foreach ($products as $product)
                            <option value="{{$product->id}}">{{ $product->name }} ( {{ $product->code }} - {{ $product->color }} - {{ $product->model_no }}  )</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label for=""></label>
                <div class="form-group">
                    <input type="hidden" class="row_count" value="0">
                    <span class="btn btn-outline-success add_item" style="width: 100%;">
                        <i class="fa fa-arrow-down"></i> Add Product
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
                                <th width="200px">Model</th>
                                <th width="150px">Rate</th>
                                <th width="80px">Qty</th>
                                <th width="150px">Amount</th>
                                <th width="10px"><i class="fa fa-trash" style="color: white;"></i></th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="total-qty">Total Quantity</label>
                <div class="form-group">
                	<input style="text-align: right;" class="form-control totalQty" type="number" name="totalQty" value="0" readonly>
                </div>
            </div>

            <div class="col-md-6">
                <label for="taotal-amount">Total Amount</label>
                <div class="form-group">
                	<input style="text-align: right;" class="form-control totalAmount" type="number" name="totalAmount" value="0" readonly>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
    <script type="text/javascript">
        $(".add_item").click(function () {
            var productId = $("#product option:selected").val();

        	if (productId == "")
        	{
                swal("Please! Select A Product", "", "warning");
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
                            '<input style="text-align: right;" class="productPrice productPrice_'+total+'" type="text" name="productPrice[]" value="" required readonly>'+
                        '</td>'+
		                '<td>'+
		                	'<input style="text-align: right;" class="productQty productQty_'+total+'" type="number" name="productQty[]" value="" oninput="findTotalAmount('+total+')">'+
		                '</td>'+

                        '<td>'+
	                        '<input style="text-align: right;" class="amount amount_'+total+'" type="number" name="amount[]" value="" readonly>'+
                        '</td>'+
		                '<td align="center">'+
		                	'<span class="btn btn-outline-danger btn-sm item_remove" onclick="itemRemove('+total+')" style="width: 100%;">'+
		                		'<i class="fa fa-trash"></i>'+
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
	                url: "{{ route('dealerRequisition.productInfo') }}",
	                data:{productId:productId},
	                success: function(response) {
	                    var product = response.product;

                        $('.productId_'+total).val(product.id);
                        $('.productName_'+total).val(product.name);
                        $('.productModel_'+total).val(product.model_no);
                        $('.productPrice_'+total).val(product.price);
	                },
	                error: function(response) {

	                }
	            });
        	}            
        });

        function itemRemove(i) {
            var qty = parseInt($('.productQty_'+i).val());
            var amount = parseFloat($('.amount_'+i).val());

            var totalQty = parseInt($('.totalQty').val()) - qty;
            var totalAmount = parseFloat($('.totalAmount').val()) - amount;

            $('.totalQty').val(totalQty);
            $('.totalAmount').val(Math.round(totalAmount));

            $('#itemRow_'+i).remove();
        }

        function findTotalAmount(i)
        {
            var rate = parseFloat($('.productPrice_'+i).val());
            var qty = parseFloat($('.productQty_'+i).val());
            var amount = rate * qty;

            $('.amount_'+i).val(Math.round(amount));

            rowSum();
        }

        function rowSum()
        {
            var totalQty = 0;            
            var totalAmount = 0;            
            $(".productQty").each(function () {
                var stvalTotal = parseFloat($(this).val());
                // console.log(stval);
                totalQty += isNaN(stvalTotal) ? 0 : stvalTotal;
            });

            $(".amount").each(function () {
                var stvalAmount = parseFloat($(this).val());
                // console.log(stval);
                totalAmount += isNaN(stvalAmount) ? 0 : stvalAmount;
            });

            $('.totalQty').val(totalQty);
            $('.totalAmount').val(Math.round(totalAmount));
        }          
    </script>

@endsection
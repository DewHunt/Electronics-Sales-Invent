@extends('admin.layouts.masterAddEdit')

@section('card_body')
    <style type="text/css">
        .chosen-single{
            height: 35px !important;
        }
    </style>
    @php
    	$transferNo = "";    	
        use App\LiftingReturn;

        $maxLiftingReturn = LiftingReturn::max('id');

        if (@$maxLiftingReturn)
        {
            $serialNo = 1000000 + $maxLiftingReturn + 1;
        }
        else
        {
            $serialNo = 1000000 + 1;
        }

        $type = array('store'=>'Warehouse Transfer','showrooms'=>'Showroom');
    @endphp

    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <label for="transfer-no">Serial No</label>
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
                <label for="transfer-date">Date</label>
                <div class="form-group {{ $errors->has('liftingReturnDate') ? ' has-danger' : '' }}">
                    <input type="text" class="form-control add_datepicker" name="liftingReturnDate" value="" readonly>
                    @if ($errors->has('liftingReturnDate'))
                        @foreach($errors->get('liftingReturnDate') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <label for="supplier">Supplier</label>
                <div class="form-group">
                    <select class="form-control chosen-select destination" id="supplier" name="supplier">
                        <option value="">Select Supplier</option>
                        @foreach ($vendors as $vendor)
                            <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <label for="store-or-showroom">Stores Or Showrooms</label>
                <div class="form-group">
                    <select class="form-control chosen-select storeOrShowroom" id="storeOrShowroom" name="storeOrShowroom">
                        <option value="">Select Store Or Showrroms</option>
                        @foreach ($storeAndShowrooms as $storeAndShowroom)
                            <option value="{{ $storeAndShowroom->id }},{{ $storeAndShowroom->type }}">{{ $storeAndShowroom->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <label for="products">Products</label>
                <div class="form-group">
                    <select class="form-control chosen-select product" id="product" name="product">
                        <option value="">Select Product</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label for="remarks">Remarks</label>
                <div class="form-group {{ $errors->has('remarks') ? ' has-remarks' : '' }}">
                    <textarea class="form-control" name="remarks" rows="5"></textarea>
                    @if ($errors->has('remarks'))
                        @foreach($errors->get('remarks') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6"><h4>Lifting Products</h4></div>
            <div class="col-md-6"><h4>Return Products</h4></div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for=""></label>
                <div class="form-group">
                    <table class="table table-striped gridTable liftingProductTable">
                        <thead>
                            <tr>
                                <th class="text-center" width="160px">Name</th>
                                <th class="text-center" width="120px">Model No</th>
                                <th class="text-center" width="100px">Serial No</th>
                                <th class="text-center" width="70px">Action</th>
                            </tr>
                        </thead>

                        <tbody id="tbody">
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-6">
                <label for=""></label>
                <div class="form-group">
                    <table class="table table-striped gridTable liftingReturnProductTable">
                        <thead>
                            <tr>
                                <th class="text-center" width="160px">Name</th>
                                <th class="text-center" width="120px">Model No</th>
                                <th class="text-center" width="100px">Serial No</th>
                                <th class="text-center" width="70px">Action</th>
                            </tr>
                        </thead>

                        <tbody id="tbody">
                        </tbody>

                        <tfoot>
                            <tr>
                                <th style="text-align: center;">Total Quanity</th>
                                <td colspan="3"><input class="form-control totalQty" id="totalQty" type="text" name="totalQty" value="0" readonly></td>
                            </tr>
                            <tr>
                                <th style="text-align: center;">Total Price</th>
                                <td colspan="3"><input class="form-control totalPrice" id="totalPrice" type="text" name="totalPrice" value="0" readonly></td>
                            </tr>
                            <tr>
                                <th style="text-align: center;">Total MRP Price</th>
                                <td colspan="3"><input class="form-control totalMrpPrice" id="totalMrpPrice" type="text" name="totalMrpPrice" value="0" readonly></td>
                            </tr>
                            <tr>
                                <th style="text-align: center;">Total Higher Price</th>
                                <td colspan="3"><input class="form-control totalHigherPrice" id="totalHigherPrice" type="text" name="totalHigherPrice" value="0" readonly></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
    <script type="text/javascript">
        $(document).on('change', '#storeOrShowroom', function(){
            $('.liftingProductRow').remove();
            $('.liftingReturnProductRow').remove();
            $('#product').val("").trigger('chosen:updated');
        });

        $(document).on('change','#supplier',function(){
            $('.liftingProductRow').remove();
            $('.liftingReturnProductRow').remove();
            $('#product').val("").trigger('chosen:updated');
        });

        $(document).on('change', '#product', function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });            

            if ($('#supplier').val() == "")
            {
                swal('Please Select Supplier','','warning');
                $('#product').val("").trigger('chosen:updated');
            }
            else
            {
                if ($('#storeOrShowroom').val() == "")
                {
                    swal('Please Select Store Or Showroom','','warning');
                    $('#product').val("").trigger('chosen:updated');
                }
                else
                {
                    $('.liftingProductRow').remove();

                    var productId = $('#product').val();
                    var storeOrShowroom = $('#storeOrShowroom').val().split(',');
                    var vendorId = $('#supplier').val();
                    var storeOrShowroomId = storeOrShowroom[0];
                    var storeOrShowroomType = storeOrShowroom[1];

                    $.ajax({
                        type:'post',
                        url:'{{ route('liftingReturn.liftingProductInfo') }}',
                        data:{productId:productId,storeOrShowroomType:storeOrShowroomType,storeOrShowroomId:storeOrShowroomId,vendorId:vendorId},
                        success:function(data){
                            var liftingProducts = data.liftingProducts;

                            for (var liftingProduct of liftingProducts)
                            {
                                if (liftingProduct.id != parseInt($('.liftingReturnId_'+liftingProduct.id).val()))
                                {
                                    $(".liftingProductTable tbody").append(
                                        '<tr class="liftingProductRow" id="liftingProductRow_'+liftingProduct.id+'">' +
                                            '<td>'+
                                                '<input class="form-control liftingId_'+liftingProduct.id+'" type="hidden" value="'+liftingProduct.lifting_id+'" readonly>'+
                                                '<input class="form-control liftingProductId_'+liftingProduct.id+'" type="hidden" value="'+liftingProduct.product_id+'" readonly>'+
                                                '<input class="form-control liftingProductName_'+liftingProduct.id+'" type="text" value="'+liftingProduct.productName+'" data-toggle="tooltip" title="'+liftingProduct.productName+'" readonly>'+
                                                '<input class="form-control liftingProductPrice_'+liftingProduct.id+'" type="hidden" value="'+liftingProduct.price+'" readonly>'+
                                            '</td>'+
                                            '<td>'+
                                                '<input class="form-control liftingProductModelNo_'+liftingProduct.id+'" type="text" value="'+liftingProduct.model_no+'" data-toggle="tooltip" title="'+liftingProduct.model_no+'" readonly>'+
                                                '<input class="form-control liftingProductColor_'+liftingProduct.id+'" type="hidden" value="'+liftingProduct.color+'" readonly>'+
                                                '<input class="form-control liftingProductMrpPrice_'+liftingProduct.id+'" type="hidden" value="'+liftingProduct.mrp_price+'" readonly>'+
                                            '</td>'+
                                            '<td>'+
                                                '<input class="form-control liftingProductSerialNo_'+liftingProduct.id+'" type="text" value="'+liftingProduct.serial_no+'" data-toggle="tooltip" title="'+liftingProduct.serial_no+'" readonly>'+
                                                '<input class="form-control liftingProductQty_'+liftingProduct.id+'" type="hidden" value="'+liftingProduct.qty+'" readonly>'+
                                                '<input class="form-control liftingProductHigherPrice_'+liftingProduct.id+'" type="hidden" value="'+liftingProduct.haire_price+'" readonly>'+
                                            '</td>'+
                                            '<td align="center">'+
                                                '<span class="btn btn-success item_remove" onclick="liftingProductTransfer('+liftingProduct.id+')">Return</span>'+
                                            '</td>'+
                                        '</tr>'
                                    );
                                }
                            }
                        }
                    });          
                }               
            }
        });

        function liftingProductTransfer(liftingProductId)
        {
            var liftingId = $('.liftingId_'+liftingProductId).val();
            var productId = $('.liftingProductId_'+liftingProductId).val();
            var productName = $('.liftingProductName_'+liftingProductId).val();
            var modelNo = $('.liftingProductModelNo_'+liftingProductId).val();
            var serialNo = $('.liftingProductSerialNo_'+liftingProductId).val();
            var color = $('.liftingProductColor_'+liftingProductId).val();
            var qty = $('.liftingProductQty_'+liftingProductId).val();
            var price = $('.liftingProductPrice_'+liftingProductId).val();
            var mrpPrice = $('.liftingProductMrpPrice_'+liftingProductId).val();
            var higherPrice = $('.liftingProductHigherPrice_'+liftingProductId).val();

            $(".liftingReturnProductTable tbody").append(
                '<tr class="liftingReturnProductRow" id="liftingReturnProductRow_'+liftingProductId+'">'+
                    '<td>'+
                        '<input class="form-control liftingReturnId_'+liftingProductId+'" name="liftingProductId[]" type="hidden" value="'+liftingProductId+'" readonly>'+
                        '<input class="form-control liftingId_'+liftingProductId+'" name="liftingId[]" type="hidden" value="'+liftingId+'" readonly>'+
                        '<input class="form-control liftingReturnProductId_'+liftingProductId+'" name="productId[]" type="hidden" value="'+productId+'" readonly>'+
                        '<input class="form-control liftingReturnProductName_'+liftingProductId+'" name="productName[]" type="text" value="'+productName+'" data-toggle="tooltip" title="'+productName+'" readonly>'+
                        '<input class="form-control liftingReturnProductPrice_'+liftingProductId+'" name="productPrice[]" type="hidden" value="'+price+'" readonly>'+
                    '</td>'+
                    '<td>'+
                        '<input class="form-control liftingReturnProductModelNo_'+liftingProductId+'" name="productModelNo[]" type="text" value="'+modelNo+'" data-toggle="tooltip" title="'+modelNo+'" readonly>'+
                        '<input class="form-control liftingReturnProductColor_'+liftingProductId+'" name="productColor[]" type="hidden" value="'+color+'" readonly>'+
                        '<input class="form-control liftingReturnProductMrpPrice_'+liftingProductId+'" name="productMrpPrice[]" type="hidden" value="'+mrpPrice+'" readonly>'+
                    '</td>'+
                    '<td>'+
                        '<input class="form-control liftingReturnProductSerialNo_'+liftingProductId+'" name="productSerialNo[]" type="text" value="'+serialNo+'" data-toggle="tooltip" title="'+serialNo+'" readonly>'+
                        '<input class="form-control liftingReturnProductQty_'+liftingProductId+'" name="productQty[]" type="hidden" value="'+qty+'" readonly>'+
                        '<input class="form-control liftingReturnProductHigherPrice_'+liftingProductId+'" name="productHigherPrice" type="hidden" value="'+higherPrice+'" readonly>'+
                    '</td>'+
                    '<td align="center">'+
                        '<span class="btn btn-danger item_remove" onclick="liftingReturnProductRemove('+liftingProductId+')">Remove</span>'+
                    '</td>'+
                '</tr>'
            );

            var totalQty = parseInt($('#totalQty').val());
            totalQty = totalQty + parseInt(qty);
            $('#totalQty').val(totalQty);

            var totalPrice = parseInt($('#totalPrice').val());
            totalPrice = totalPrice + parseInt(price);
            $('#totalPrice').val(totalPrice);

            var totalMrpPrice = parseInt($('#totalMrpPrice').val());
            totalMrpPrice = totalMrpPrice + parseInt(mrpPrice);
            $('#totalMrpPrice').val(totalMrpPrice);

            var totalHigherPrice = parseInt($('#totalHigherPrice').val());
            totalHigherPrice = totalHigherPrice + parseInt(higherPrice);
            $('#totalHigherPrice').val(totalHigherPrice);

            $('#liftingProductRow_'+liftingProductId).remove();
        }

        function liftingReturnProductRemove(liftingProductId)
        {
            var liftingId = $('.liftingId_'+liftingProductId).val();
            var productId = $('.liftingReturnProductId_'+liftingProductId).val();
            var productName = $('.liftingReturnProductName_'+liftingProductId).val();
            var modelNo = $('.liftingReturnProductModelNo_'+liftingProductId).val();
            var serialNo = $('.liftingReturnProductSerialNo_'+liftingProductId).val();
            var color = $('.liftingReturnProductColor_'+liftingProductId).val();
            var qty = $('.liftingReturnProductQty_'+liftingProductId).val();
            var price = $('.liftingReturnProductPrice_'+liftingProductId).val();
            var mrpPrice = $('.liftingReturnProductMrpPrice_'+liftingProductId).val();
            var higherPrice = $('.liftingReturnProductHigherPrice_'+liftingProductId).val();

            $(".liftingProductTable tbody").append(
                '<tr class="liftingProductRow" id="liftingProductRow_'+liftingProductId+'">' +
                    '<td>'+
                        '<input class="form-control liftingId_'+liftingProductId+'" type="hidden" value="'+liftingId+'" readonly>'+
                        '<input class="form-control liftingProductId_'+liftingProductId+'" type="hidden" value="'+productId+'" readonly>'+
                        '<input class="form-control liftingProductName_'+liftingProductId+'" type="text" value="'+productName+'" data-toggle="tooltip" title="'+productName+'" readonly>'+
                        '<input class="form-control liftingProductPrice_'+liftingProductId+'" type="hidden" value="'+price+'" readonly>'+
                    '</td>'+
                    '<td>'+
                        '<input class="form-control liftingProductModelNo_'+liftingProductId+'" type="text" value="'+modelNo+'" data-toggle="tooltip" title="'+modelNo+'" readonly>'+
                        '<input class="form-control liftingProductColor_'+liftingProductId+'" type="hidden" value="'+color+'" readonly>'+
                        '<input class="form-control liftingProductMrpPrice_'+liftingProductId+'" type="hidden" value="'+mrpPrice+'" readonly>'+
                    '</td>'+
                    '<td>'+
                        '<input class="form-control liftingProductSerialNo_'+liftingProductId+'" type="text" value="'+serialNo+'" data-toggle="tooltip" title="'+serialNo+'" readonly>'+
                        '<input class="form-control liftingProductQty_'+liftingProductId+'" type="hidden" value="'+qty+'" readonly>'+
                        '<input class="form-control liftingProductHigherPrice_'+liftingProductId+'" type="hidden" value="'+higherPrice+'" readonly>'+
                    '</td>'+
                    '<td align="center">'+
                        '<span class="btn btn-success item_remove" onclick="liftingProductTransfer(' +liftingProductId+ ')">Return</span>'+
                    '</td>'+
                '</tr>'
            );

            var totalQty = parseInt($('#totalQty').val());
            totalQty = totalQty - parseInt(qty);
            $('#totalQty').val(totalQty);

            var totalPrice = parseInt($('#totalPrice').val());
            totalPrice = totalPrice - parseInt(price);
            $('#totalPrice').val(totalPrice);

            var totalMrpPrice = parseInt($('#totalMrpPrice').val());
            totalMrpPrice = totalMrpPrice - parseInt(mrpPrice);
            $('#totalMrpPrice').val(totalMrpPrice);

            var totalHigherPrice = parseInt($('#totalHigherPrice').val());
            totalHigherPrice = totalHigherPrice - parseInt(higherPrice);
            $('#totalHigherPrice').val(totalHigherPrice);

            $('#liftingReturnProductRow_'+liftingProductId).remove();
        }
    </script>
@endsection
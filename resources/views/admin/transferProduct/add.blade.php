@extends('admin.layouts.masterAddEdit')

@section('card_body')
    <style type="text/css">
        .chosen-single{
            height: 35px !important;
        }
    </style>
    @php
    	$transferNo = "";    	
        use App\Transfer;

        $maxTransfer = Transfer::max('id');

        if (@$maxTransfer)
        {
            $transferNo = 1000000 + $maxTransfer + 1;
        }
        else
        {
            $transferNo = 1000000 + 1;
        }

        $type = array('store'=>'Warehouse Transfer','showrooms'=>'Showroom');
    @endphp

    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <label for="host">Host</label>
                        <div class="form-group">
                            <select class="form-control chosen-select host" id="host" name="host">
                                <option value="">Select Host</option>
                                @foreach ($storeAndShowrooms as $storeAndShowroom)
                                    <option value="{{ $storeAndShowroom->id }},{{ $storeAndShowroom->type }}">{{ $storeAndShowroom->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="destination">Destination</label>
                        <div class="form-group" id="destination-select-menu">
                            <select class="form-control chosen-select destination" id="destination" name="destination">
                                <option value="">Select Destination</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
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
            </div>

            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
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
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="transfer-no">Transfer No</label>
                        <div class="form-group {{ $errors->has('transferNo') ? ' has-danger' : '' }}">
                            <input type="text" class="form-control" name="transferNo" value="{{ $transferNo }}" required readonly/>
                            @if ($errors->has('transferNo'))
                                @foreach($errors->get('transferNo') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="transfer-date">Transfer Date</label>
                        <div class="form-group {{ $errors->has('transferDate') ? ' has-danger' : '' }}">
                            <input type="text" class="form-control add_datepicker" name="transferDate" id="" value="" readonly>
                            @if ($errors->has('transferDate'))
                                @foreach($errors->get('transferDate') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6"><h4>Available Products</h4></div>
            <div class="col-md-6"><h4>Transfered Products</h4></div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for=""></label>
                <div class="form-group">
                    <table class="table table-striped gridTable availableProductTable">
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
                    <table class="table table-striped gridTable transferedProductTable">
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
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
    <script type="text/javascript">
        $(document).on('change', '#host', function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.availableProductRow').remove();
            $('.transferedProductRow').remove();
            $('#product').val("").trigger('chosen:updated');
            
            var host = $('#host').val().split(',');

            var hostId = host[0];
            var hostType = host[1];

            $.ajax({
                type:'post',
                url:'{{ route('transferProduct.storeAndShowroomInfo') }}',
                data:{hostId:hostId,hostType:hostType},
                success:function(data){
                    $('#destination-select-menu').html(data);
                    $(".chosen-select").chosen();
                }
            });
        });

        $(document).on('change','#supplier',function(){
            $('.availableProductRow').remove();
            $('.transferedProductRow').remove();
            $('#product').val("").trigger('chosen:updated');
        });

        $(document).on('change', '#product', function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });            

            if ($('#host').val() == "")
            {
                swal('Please Select Host','','warning');
                $('#product').val("").trigger('chosen:updated');
            }
            else
            {
                if ($('#supplier').val() == "")
                {
                    swal('Please Select Supplier','','warning');
                    $('#product').val("").trigger('chosen:updated');
                }
                else
                {
                    $('.availableProductRow').remove();

                    var productId = $('#product').val();
                    var host = $('#host').val().split(',');
                    var vendorId = $('#supplier').val();
                    var hostId = host[0];
                    var hostType = host[1];

                    $.ajax({
                        type:'post',
                        url:'{{ route('transferProduct.liftingProductInfo') }}',
                        data:{productId:productId,hostType:hostType,hostId:hostId,vendorId:vendorId},
                        success:function(data){
                            var liftingProducts = data.liftingProducts;

                            for (var liftingProduct of liftingProducts)
                            {
                                if (liftingProduct.id != parseInt($('.transferedId_'+liftingProduct.id).val()))
                                {
                                    $(".availableProductTable tbody").append(
                                        '<tr class="availableProductRow" id="availableProductRow_'+liftingProduct.id+'">' +
                                            '<td>'+
                                                '<input class="form-control availableProductId_'+liftingProduct.id+'" type="hidden" value="'+liftingProduct.product_id+'" readonly>'+
                                                '<input class="form-control availableProductName_'+liftingProduct.id+'" type="text" value="'+liftingProduct.productName+'" data-toggle="tooltip" title="'+liftingProduct.productName+'" readonly>'+
                                            '</td>'+
                                            '<td>'+
                                                '<input class="form-control availableProductModelNo_'+liftingProduct.id+'" type="text" value="'+liftingProduct.model_no+'" data-toggle="tooltip" title="'+liftingProduct.model_no+'" readonly>'+
                                                '<input class="form-control availableProductColor_'+liftingProduct.id+'" type="hidden" value="'+liftingProduct.color+'" readonly>'+
                                            '</td>'+
                                            '<td>'+
                                                '<input class="form-control availableProductSerialNo_'+liftingProduct.id+'" type="text" value="'+liftingProduct.serial_no+'" data-toggle="tooltip" title="'+liftingProduct.serial_no+'" readonly>'+
                                                '<input class="form-control availableProductQty_'+liftingProduct.id+'" type="hidden" value="'+liftingProduct.qty+'" readonly>'+
                                            '</td>'+
                                            '<td align="center">'+
                                                '<span class="btn btn-success item_remove" onclick="availableProductTransfer('+liftingProduct.id+')">Transfer</span>'+
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

        function availableProductTransfer(liftingProductId)
        {
            var productId = $('.availableProductId_'+liftingProductId).val();
            var productName = $('.availableProductName_'+liftingProductId).val();
            var modelNo = $('.availableProductModelNo_'+liftingProductId).val();
            var serialNo = $('.availableProductSerialNo_'+liftingProductId).val();
            var color = $('.availableProductColor_'+liftingProductId).val();
            var qty = $('.availableProductQty_'+liftingProductId).val();

            $(".transferedProductTable tbody").append(
                '<tr class="transferedProductRow" id="transferedProductRow_'+liftingProductId+'">'+
                    '<td>'+
                        '<input class="form-control transferedId_'+liftingProductId+'" name="liftingProductId[]" type="hidden" value="'+liftingProductId+'" readonly>'+
                        '<input class="form-control transferedProductId_'+liftingProductId+'" name="productId[]" type="hidden" value="'+productId+'" readonly>'+
                        '<input class="form-control transferedProductName_'+liftingProductId+'" name="productName[]" type="text" value="'+productName+'" data-toggle="tooltip" title="'+productName+'" readonly>'+
                    '</td>'+
                    '<td>'+
                        '<input class="form-control transferedProductModelNo_'+liftingProductId+'" name="productModelNo[]" type="text" value="'+modelNo+'" data-toggle="tooltip" title="'+modelNo+'" readonly>'+
                        '<input class="form-control transferedProductColor_'+liftingProductId+'" name="productColor[]" type="hidden" value="'+color+'" readonly>'+
                    '</td>'+
                    '<td>'+
                        '<input class="form-control transferedProductSerialNo_'+liftingProductId+'" name="productSerialNo[]" type="text" value="'+serialNo+'" data-toggle="tooltip" title="'+serialNo+'" readonly>'+
                        '<input class="form-control transferedProductQty_'+liftingProductId+'" name="productQty[]" type="hidden" value="'+qty+'" readonly>'+
                    '</td>'+
                    '<td align="center">'+
                        '<span class="btn btn-danger item_remove" onclick="transferProductRemove('+liftingProductId+')">Remove</span>'+
                    '</td>'+
                '</tr>'
            );

            var totalQty = parseInt($('#totalQty').val());

            totalQty = totalQty + parseInt(qty);
            $('#totalQty').val(totalQty);

            $('#availableProductRow_'+liftingProductId).remove();
        }

        function transferProductRemove(liftingProductId)
        {
            var productId = $('.transferedProductId_'+liftingProductId).val();
            var productName = $('.transferedProductName_'+liftingProductId).val();
            var modelNo = $('.transferedProductModelNo_'+liftingProductId).val();
            var serialNo = $('.transferedProductSerialNo_'+liftingProductId).val();
            var color = $('.transferedProductColor_'+liftingProductId).val();
            var qty = $('.transferedProductQty_'+liftingProductId).val();

            $(".availableProductTable tbody").append(
                '<tr class="availableProductRow" id="availableProductRow_'+liftingProductId+'">' +
                    '<td>'+
                        '<input class="form-control availableProductId_'+liftingProductId+'" type="hidden" value="'+productId+'" readonly>'+
                        '<input class="form-control availableProductName_'+liftingProductId+'" type="text" value="'+productName+'" data-toggle="tooltip" title="'+productName+'" readonly>'+
                    '</td>'+
                    '<td>'+
                        '<input class="form-control availableProductModelNo_'+liftingProductId+'" type="text" value="'+modelNo+'" data-toggle="tooltip" title="'+modelNo+'" readonly>'+
                        '<input class="form-control availableProductColor_'+liftingProductId+'" type="hidden" value="'+color+'" readonly>'+
                    '</td>'+
                    '<td>'+
                        '<input class="form-control availableProductSerialNo_'+liftingProductId+'" type="text" value="'+serialNo+'" data-toggle="tooltip" title="'+serialNo+'" readonly>'+
                        '<input class="form-control availableProductQty_'+liftingProductId+'" type="hidden" value="'+qty+'" readonly>'+
                    '</td>'+
                    '<td align="center">'+
                        '<span class="btn btn-success item_remove" onclick="availableProductTransfer(' +liftingProductId+ ')">Transfer</span>'+
                    '</td>'+
                '</tr>'
            );

            var totalQty = parseInt($('#totalQty').val());

            totalQty = totalQty - parseInt(qty);
            $('#totalQty').val(totalQty);

            $('#transferedProductRow_'+liftingProductId).remove();
        }
    </script>
@endsection
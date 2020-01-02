@extends('admin.layouts.masterAddEdit')

@section('custom_css')
    <style type="text/css">
        .table th{
            background: #00c292;
            text-align: center;
        }
    </style>
@endsection

@section('card_body')
    <style type="text/css">
        .chosen-single{
            height: 35px !important;
        }
    </style>
    @php
        $requisitionNo = "";   
        use App\ProductIssue;

        $maxProductIssueId = ProductIssue::max('id');

        if (@$maxProductIssueId)
        {
            $productIssueNo = 100000000 + $maxProductIssueId + 1;
        }
        else
        {
            $productIssueNo = 100000000 + 1;
        }
    @endphp

    <div class="card-body">
        @if ($issuedProduct->issue_type == 'With Approval')
            <div class="row">
                <div class="col-md-3">
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input issueType" name="issueType" value="With Approval">With Approval
                        </label>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input issueType" name="issueType" value="Without Approval">Without Approval
                        </label>
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="issue-no">Issue No</label>
                    <div class="form-group {{ $errors->has('productIssueNo') ? ' has-danger' : '' }}">
                        <input type="text" class="form-control" name="productIssueNo" value="{{ $productIssueNo }}" required readonly/>
                        @if ($errors->has('productIssueNo'))
                            @foreach($errors->get('productIssueNo') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="issue-date">Issue Date</label>
                    <div class="form-group {{ $errors->has('issueDate') ? ' has-danger' : '' }}">
                        <input type="text" class="form-control add_datepicker" name="issueDate" value="{{ old('issueDate') }}" readonly>
                        @if ($errors->has('issueDate'))
                            @foreach($errors->get('issueDate') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        @endif

        @if ($issuedProduct->issue_type == 'Without Approval')
            {{-- expr --}}
        @endif
        <div class="row">
            <div class="col-md-3">
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input issueType" name="issueType" value="With Approval">With Approval
                    </label>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input issueType" name="issueType" value="Without Approval">Without Approval
                    </label>
                </div>
            </div>

            <div class="col-md-3">
                <label for="issue-no">Issue No</label>
                <div class="form-group {{ $errors->has('productIssueNo') ? ' has-danger' : '' }}">
                    <input type="text" class="form-control" name="productIssueNo" value="{{ $productIssueNo }}" required readonly/>
                    @if ($errors->has('productIssueNo'))
                        @foreach($errors->get('productIssueNo') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="col-md-3">
                <label for="issue-date">Issue Date</label>
                <div class="form-group {{ $errors->has('issueDate') ? ' has-danger' : '' }}">
                    <input type="text" class="form-control add_datepicker" name="issueDate" value="{{ old('issueDate') }}" readonly>
                    @if ($errors->has('issueDate'))
                        @foreach($errors->get('issueDate') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <input type="text" class="form-control" id="dealerId" name="dealerId" value="" readonly>
            </div>
        </div>

        <div id="withAprrovalSection">
            <div class="row">
                <div class="col-md-3">
                    <label for="dealer">Requisitions No</label>
                    <div class="form-group">
                        <select class="form-control chosen-select" id="dealerRequisitionId" name="dealerRequisitionId" required="">
                            <option value=" ">Select Reuisition Number</option>
                            @foreach ($dealerRequisitions as $dealerRequisition)
                                <option value="{{ $dealerRequisition->id }}">{{ $dealerRequisition->requisition_no }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="dealer-code">Dealer Code</label>
                    <div class="form-group">
                        <input type="text" class="form-control" id="dealerCode" name="dealerCode" value="" readonly>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="dealer-name">Dealer Name</label>
                    <div class="form-group">
                        <input type="text" class="form-control" id="dealerName" name="dealerName" value="" readonly>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <label for="dealer-address">Dealer Address</label>
                    <div class="form-group">
                        <textarea class="form-control" id="dealerAddress" name="dealerAddress" rows="5"></textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-sm approveProducts">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th width="200px">Model</th>
                                <th width="80px">Qty</th>
                                <th width="80px">Issue Qty</th>
                                <th width="200px">Serial No</th>
                                <th width="10px"><i class="fa fa-plus" style="color: white;"></i></th>
                            </tr>
                        </thead>

                        <tbody id="tbody">
                        </tbody>
                    </table>
                </div>
            </div>            
        </div>

        <div id="withoutAprrovalSection">
            <div class="row">
                <div class="col-md-3">
                    <label for="dealer">Dealer</label>
                    <div class="form-group">
                        <select class="form-control chosen-select dealer" id="dealer" name="dealer">
                            <option value="">Select Dealer</option>
                            @foreach ($dealers as $dealer)
                                <option value="{{$dealer->id}}">{{ $dealer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="product">Products</label>
                    <div class="form-group">
                        <select class="form-control chosen-select product" id="product" name="product">
                            <option value="">Select Product</option>
                            @foreach ($products as $product)
                                <option value="{{$product->id}}">{{ $product->name }} ( {{ $product->code }} - {{ $product->color }} - {{ $product->model_no }}  )</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="serial-no">Serial No</label>
                    <div class="form-group" id="serial-no-select-menu">
                        <select class="form-control chosen-select serialNo" id="serialNo" name="serialNo">
                            <option value="">Select Serial No</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <span class="btn btn-outline-success addItem" style="width: 100%;">
                        <i class="fa fa-arrow-down"></i> Add Product
                    </span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label></label>
                <div class="form-group">
                    <table class="table table-bordered table-striped table-sm gridTable issueProductList" >
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th width="200px">Model</th>
                                <th width="150px">Serial</th>
                                <th width="110px">Commision (%)</th>
                                <th width="80px">Rate</th>
                                <th width="40px">Qty</th>
                                <th width="80px">Amount</th>
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
        $('#withAprrovalSection').hide();
        $('#withoutAprrovalSection').hide();

        $('.issueType').click(function(event) {
            var issueType = $("input[name='issueType']:checked").val();

            if (issueType == "With Approval")
            {
                $('#withAprrovalSection').show();
                $('#withoutAprrovalSection').hide();
            }

            if (issueType == "Without Approval")
            {
                $('#withAprrovalSection').hide();
                $('#withoutAprrovalSection').show();
            }
        })

        $(document).on('change', '#product', function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var productId = $('#product').val();

            $.ajax({
                type:'post',
                url:'{{ route('productIssue.productSerialInfo') }}',
                data:{productId:productId},
                success:function(data){
                    $('#serial-no-select-menu').html(data);
                    $(".chosen-select").chosen();
                }
            });
        });

        $(document).on('change','#dealerRequisitionId',function(){
            var dealerRequisitionId = $('#dealerRequisitionId').val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('productIssue.dealerRequisitionInfo') }}",
                data:{dealerRequisitionId:dealerRequisitionId},
                success: function(response) {
                    $('.approveProductRow').remove();
                    var product = response.dealerRequisition;
                    var dealer = response.dealer;
                    var dealerRequisitionProducts = response.dealerRequisitionProducts;
                    var productSerials = response.productSerials;
                    var productIssueLists = response.productIssueLists;

                    $('#dealerId').val(dealer.id);
                    $('#dealerCode').val(dealer.code);
                    $('#dealerName').val(dealer.name);
                    $('#dealerAddress').val(dealer.address);
                        

                    for (var dealerRequisitionProduct of dealerRequisitionProducts)
                    {
                        var productSerialOption = '';
                        for (var productSerial of productSerials)
                        {
                            if (productSerial.product_id == dealerRequisitionProduct.product_id)
                            {
                                productSerialOption += '<option value="'+productSerial.serial_no+'">'+productSerial.serial_no+'</option>';
                            }
                        }

                        var totalIssueQty = 0;
                        for (var productIssueList of productIssueLists)
                        {
                            if (productIssueList.product_id == dealerRequisitionProduct.product_id)
                            {
                                totalIssueQty = totalIssueQty + parseInt(productIssueList.qty);
                            }
                        }

                        $(".approveProducts tbody").append(
                            '<tr class="approveProductRow" id="approveProductRow_'+dealerRequisitionProduct.id+'">' +
                                '<td>'+
                                    '<input class="form-control productName_'+dealerRequisitionProduct.id+'" type="text" value="'+dealerRequisitionProduct.productName+'" readonly>'+
                                    '<input class="form-control productId_'+dealerRequisitionProduct.id+'" type="text" value="'+dealerRequisitionProduct.product_id+'" readonly>'+
                                '</td>'+
                                '<td>'+
                                    '<input class="form-control productModelNo_'+dealerRequisitionProduct.id+'" type="text" value="'+dealerRequisitionProduct.model_no+'" readonly>'+
                                '</td>'+
                                '<td>'+
                                    '<input style="text-align: right;" class="form-control approveQty approveQty_'+dealerRequisitionProduct.id+'" type="number" value="'+dealerRequisitionProduct.approved_qty+'" readonly>'+
                                    '<input style="text-align: right;" class="form-control price_'+dealerRequisitionProduct.id+'" type="number" value="'+dealerRequisitionProduct.price+'" readonly>'+
                                '</td>'+
                                '<td>'+
                                    '<input style="text-align: right;" class="form-control issueQty issueQty_'+dealerRequisitionProduct.id+'" type="number" name="issueQty[]" value="'+totalIssueQty+'" readonly>'+
                                '</td>'+
                                '<td>'+
                                    '<select class="form-control chosen-select productSerialNo_'+dealerRequisitionProduct.id+'" id="productSerialNo'+dealerRequisitionProduct.id+'" name="serialNo[]">'+
                                        '<option value="">Select Serial No</option>'+productSerialOption+
                                    '</select>'+
                                '</td>'+
                                '<td align="center">'+
                                    '<span class="btn btn-info btn-sm item_remove" onclick="issuProductAdd('+dealerRequisitionProduct.id+')" style="width: 100%;">'+
                                        '<i class="fa fa-plus"></i>'+
                                    '</span>'+
                                '</td>'+
                            '</tr>'
                        );
                    }
                },
                error: function(response) {

                }
            });
        });

        function issuProductAdd(dealerRequisitionProductId)
        {
            var approveQty = parseInt($('.approveQty_'+dealerRequisitionProductId).val());
            var issueQty = parseInt($('.issueQty_'+dealerRequisitionProductId).val());

            if (approveQty == issueQty)
            {
                swal("You Can't Issue More Than Approve Quantity","","warning");
            }
            else
            {
                issueQty = issueQty + 1;
                $('.issueQty_'+dealerRequisitionProductId).val(issueQty);

                var productId = $('.productId_'+dealerRequisitionProductId).val();
                var productName = $('.productName_'+dealerRequisitionProductId).val();
                var productModelNo = $('.productModelNo_'+dealerRequisitionProductId).val();
                var productSerialNo = $('.productSerialNo_'+dealerRequisitionProductId).val();
                var productPrice = $('.price_'+dealerRequisitionProductId).val();

                var totalQty = parseInt($('.totalQty').val());
                totalQty = totalQty + 1;
                $('.totalQty').val(totalQty);

                var totalAmount = parseInt($('.totalAmount').val());
                totalAmount = totalAmount + parseFloat(productPrice);
                $('.totalAmount').val(totalAmount);

                $(".issueProductList tbody").append(
                    '<tr id="issueProductRow_' + dealerRequisitionProductId + '">' +                
                        '<td>'+
                            '<input class="productId_'+dealerRequisitionProductId+'" type="text" name="productId[]" value="'+productId+'">'+
                            '<input class="productName_'+dealerRequisitionProductId+'" type="text" name="productName[]" value="'+productName+'" readonly>'+
                        '</td>'+
                        '<td>'+
                            '<input class="productModel_'+dealerRequisitionProductId+'" type="text" name="productModel[]" value="'+productModelNo+'" readonly>'+
                        '</td>'+
                        '<td>'+
                            '<input class="productSerial_'+dealerRequisitionProductId+'" type="text" name="productSerial[]" value="'+productSerialNo+'" readonly>'+
                        '</td>'+
                            '<td>'+
                                '<input style="text-align: right;" class="productCommision_'+productId+'" type="number" name="commission[]" value="0" readonly>'+
                            '</td>'+
                        '<td>'+
                            '<input style="text-align: right;" class="productPrice productPrice_'+dealerRequisitionProductId+'" type="text" name="productPrice[]" value="'+productPrice+'" required readonly>'+
                        '</td>'+
                        '<td>'+
                            '<input style="text-align: right;" class="productQty productQty_'+dealerRequisitionProductId+'" type="number" name="productQty[]" value="1" readonly>'+
                        '</td>'+

                        '<td>'+
                            '<input style="text-align: right;" class="amount amount_'+dealerRequisitionProductId+'" type="number" name="amount[]" value="'+productPrice+'" readonly>'+
                        '</td>'+
                        '<td align="center">'+
                            '<span class="btn btn-outline-danger btn-sm item_remove" onclick="itemRemove('+dealerRequisitionProductId+')" style="width: 100%;">'+
                                '<i class="fa fa-trash"></i>'+
                            '</span>'+
                        '</td>'+
                    '</tr>'
                );
            }
        }

        $(document).on('change', '#dealer', function(){
            var dealerId = $("#dealer option:selected").val();
            $("#dealerId").val(dealerId);
        });

        $(".addItem").click(function () {
            if ($("#dealer option:selected").val() == "")
            {
                swal("Please! Select A Dealer", "", "warning");
            }
            else
            {
                if ($("#product option:selected").val() == "")
                {
                    swal("Please! Select A Product", "", "warning");
                }
                else
                {
                    if ($("#serialNo option:selected").val() == "")
                    {
                        swal("Please! Select A Serial", "", "warning");
                    }
                    else
                    {
                        var productId = $("#product option:selected").val();
                        var serialNo = $("#serialNo option:selected").val();

                        $(".issueProductList tbody").append(
                            '<tr id="issueProductRow_' + productId + '">' +                
                                '<td>'+
                                    '<input class="productId_'+productId+'" type="text" name="productId[]" value="">'+
                                    '<input class="productName_'+productId+'" type="text" name="productName[]" value="" readonly>'+
                                '</td>'+
                                '<td>'+
                                    '<input class="productModel_'+productId+'" type="text" name="productModel[]" value="" readonly>'+
                                '</td>'+
                                '<td>'+
                                    '<input class="productSerial_'+productId+'" type="text" name="productSerial[]" value="" readonly>'+
                                '</td>'+
                                '<td>'+
                                    '<input style="text-align: right;" class="productCommision_'+productId+'" type="number" name="commission[]" value="0" readonly>'+
                                '</td>'+
                                '<td>'+
                                    '<input style="text-align: right;" class="productPrice productPrice_'+productId+'" type="number" name="productPrice[]" value="" required readonly>'+
                                '</td>'+
                                '<td>'+
                                    '<input style="text-align: right;" class="productQty productQty_'+productId+'" type="number" name="productQty[]" value="1" readonly>'+
                                '</td>'+

                                '<td>'+
                                    '<input style="text-align: right;" class="amount amount_'+productId+'" type="number" name="amount[]" value="" readonly>'+
                                '</td>'+
                                '<td align="center">'+
                                    '<span class="btn btn-outline-danger btn-sm item_remove" onclick="itemRemove('+productId+')" style="width: 100%;">'+
                                        '<i class="fa fa-trash"></i>'+
                                    '</span>'+
                                '</td>'+
                            '</tr>'
                        );

                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: "POST",
                            url: "{{ route('productIssue.productInfo') }}",
                            data:{productId:productId},
                            success: function(response) {
                                var product = response.product;

                                $('.productId_'+productId).val(product.id);
                                $('.productName_'+productId).val(product.name);
                                $('.productModel_'+productId).val(product.model_no);
                                $('.productSerial_'+productId).val(serialNo);
                                $('.price_'+productId).val(product.price);
                                $('.productPrice_'+productId).val(product.price);
                                $('.amount_'+productId).val(product.price);

                                var totalQty = parseInt($('.totalQty').val());
                                totalQty = totalQty + 1;
                                $('.totalQty').val(totalQty);

                                var totalAmount = parseInt($('.totalAmount').val());
                                totalAmount = totalAmount + parseFloat(product.price);
                                $('.totalAmount').val(totalAmount);
                            },
                            error: function(response) {

                            }
                        });
                    }
                }
            }            
        });

        function itemRemove(i)
        {            
            var issueQty = parseInt($('.issueQty_'+i).val());
            issueQty = issueQty - 1;
            $('.issueQty_'+i).val(issueQty);

            var productPrice = parseFloat($('.productPrice_'+i).val());

            var totalQty = parseInt($('.totalQty').val());
            totalQty = totalQty - 1;
            $('.totalQty').val(totalQty);

            var totalAmount = parseInt($('.totalAmount').val());
            totalAmount = totalAmount - productPrice;
            $('.totalAmount').val(totalAmount);

            $('#issueProductRow_'+i).remove();
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
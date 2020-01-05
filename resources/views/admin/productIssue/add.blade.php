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
            <div class="col-md-6">
                <input type="hidden" class="form-control" id="dealerId" name="dealerId" value="" readonly>
            </div>
            <div class="col-md-6">
                <input type="hidden" class="form-control row_count" value="0">
            </div>
        </div>

        <div id="withAprrovalSection">
            <div class="row">
                <div class="col-md-3">
                    <label for="dealer">Requisitions No</label>
                    <div class="form-group">
                        <select class="form-control chosen-select" id="dealerRequisitionId" name="dealerRequisitionId">
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

                <div class="col-md-3">
                    <label for="dealer-name">Dealer Name</label>
                    <div class="form-group">
                        <input type="text" class="form-control" id="dealerName" name="dealerName" value="" readonly>
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="dealer-address">Dealer Address</label>
                    <div class="form-group">
                        <input type="text" class="form-control" id="dealerAddress" name="dealerAddress" value="" readonly>
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
                                <th width="10px">
                                    <i class="fa fa-plus" style="color: white;"></i>
                                </th>
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
            $('.totalQty').val(0);
            $('.totalAmount').val(0);
            $('.issueProductRow').remove();
            $('#dealerId').val("");

            if (issueType == "With Approval")
            {
                $('#withAprrovalSection').show();
                $('#withoutAprrovalSection').hide();
                $('#dealer').val("").trigger('chosen:updated');
                $('#product').val("").trigger('chosen:updated');
                $('#serialNo').val("").trigger('chosen:updated');
            }

            if (issueType == "Without Approval")
            {
                $('#withAprrovalSection').hide();
                $('#withoutAprrovalSection').show();
                $('.approveProductRow').remove();
                $('#dealerRequisitionId').val("").trigger('chosen:updated');
                $('#dealerCode').val("");
                $('#dealerName').val("");
                $('#dealerAddress').val("");
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
                    var productSerials = data.productSerials;

                    var productSerialOption = '';
                    if (productSerials)
                    {
                        productSerialOption += '<select class="form-control chosen-select serialNo" id="serialNo" name="serialNo">';
                        productSerialOption += '<option value="">Select Serial No</option>';          
                        for (productSerial of productSerials)
                        {
                            if (productSerial.serial_no != $('.serialNo_'+productSerial.serial_no).val())
                            {
                                productSerialOption += '<option id="serialNo_'+productSerial.serial_no+'" value="'+productSerial.serial_no+'">'+productSerial.serial_no+'</option>';
                            }
                        }
                        productSerialOption += '</select>';         
                    }
                    else
                    {
                        productSerialOption += '<select class="form-control chosen-select serialNo" id="serialNo" name="serialNo">';
                        productSerialOption += '<option value="">Select Serial No</option>';
                        productSerialOption += '</select>';
                    } 
                    $('#serial-no-select-menu').html(productSerialOption);
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
                    $('.issueProductRow').remove();
                    $('.approveProductRow').remove();

                    var product = response.dealerRequisition;
                    var dealer = response.dealer;
                    var dealerRequisitionProducts = response.dealerRequisitionProducts;
                    var productSerials = response.productSerials;
                    var productIssueLists = response.productIssueLists;
                    var allCommissions = response.allCommissions;

                    $('#dealerId').val(dealer.id);
                    $('#dealerCode').val(dealer.code);
                    $('#dealerName').val(dealer.name);
                    $('#dealerAddress').val(dealer.address);
                        

                    for (var dealerRequisitionProduct of dealerRequisitionProducts)
                    {
                        var productSerialOption = '';
                        var serialCount = 1;
                        for (var productSerial of productSerials)
                        {
                            if (productSerial.product_id == dealerRequisitionProduct.product_id)
                            {
                                productSerialOption += '<option id="serialNo_'+productSerial.serial_no+'" value="'+productSerial.serial_no+'">'+productSerial.serial_no+'</option>';
                                serialCount = serialCount + 1;
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

                        var commissionRate = 0;
                        for (var commission of allCommissions)
                        {
                            if (commission.category_id == dealerRequisitionProduct.categoryId)
                            {
                                commissionRate = commission.commission_rate;
                            }
                        }

                        $(".approveProducts tbody").append(
                            '<tr class="approveProductRow" id="approveProductRow_'+dealerRequisitionProduct.id+'">' +
                                '<td>'+
                                    '<input class="form-control productName_'+dealerRequisitionProduct.id+'" type="text" value="'+dealerRequisitionProduct.productName+'" readonly>'+
                                    '<input class="form-control productId_'+dealerRequisitionProduct.id+'" type="hidden" value="'+dealerRequisitionProduct.product_id+'" readonly>'+
                                '</td>'+
                                '<td>'+
                                    '<input class="form-control productModelNo_'+dealerRequisitionProduct.id+'" type="text" value="'+dealerRequisitionProduct.model_no+'" readonly>'+
                                '</td>'+
                                '<td>'+
                                    '<input style="text-align: right;" class="form-control approveQty approveQty_'+dealerRequisitionProduct.id+'" type="number" value="'+dealerRequisitionProduct.approved_qty+'" readonly>'+
                                    '<input style="text-align: right;" class="form-control price_'+dealerRequisitionProduct.id+'" type="hidden" value="'+dealerRequisitionProduct.price+'" readonly>'+
                                '</td>'+
                                '<td>'+
                                    '<input style="text-align: right;" class="form-control issueQty issueQty_'+dealerRequisitionProduct.id+'" type="number" name="issueQty[]" value="'+totalIssueQty+'" readonly>'+
                                    '<input style="text-align: right;" class="form-control commissionRate_'+dealerRequisitionProduct.id+'" type="hidden" value="'+commissionRate+'" readonly>'+
                                '</td>'+
                                '<td>'+
                                    '<select class="form-control chosen-select productSerialNo_'+dealerRequisitionProduct.id+'" id="productSerialNo_'+dealerRequisitionProduct.id+'" name="serialNo[]">'+
                                        '<option value="">Select Serial No</option>'+productSerialOption+
                                    '</select>'+
                                '</td>'+
                                '<td align="center">'+
                                    '<span class="btn btn-info btn-sm item_remove" onclick="issueProductAdd('+dealerRequisitionProduct.id+')" style="width: 100%;">'+
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

        function issueProductAdd(dealerRequisitionProductId)
        {
            var approveQty = parseInt($('.approveQty_'+dealerRequisitionProductId).val());
            var issueQty = parseInt($('.issueQty_'+dealerRequisitionProductId).val());

            if ($('.productSerialNo_'+dealerRequisitionProductId).val() == "")
            {
                swal("Select Serial Number","","warning");
            }
            else
            {
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
                    var commissionRate = $('.commissionRate_'+dealerRequisitionProductId).val();

                    var totalQty = parseInt($('.totalQty').val());
                    totalQty = totalQty + 1;
                    $('.totalQty').val(totalQty);

                    var totalAmount = parseInt($('.totalAmount').val());
                    totalAmount = totalAmount + parseFloat(productPrice);
                    $('.totalAmount').val(totalAmount);

                    var row_count = $('.row_count').val();
                    var total = parseInt(row_count) + 1;

                    $(".issueProductList tbody").append(
                        '<tr class="issueProductRow" id="issueProductRow_'+total+'">' +                
                            '<td>'+
                                '<input class="productId_'+total+'" type="hidden" name="productId[]" value="'+productId+'">'+
                                '<input class="productName_'+total+'" type="text" name="productName[]" value="'+productName+'" readonly>'+
                            '</td>'+
                            '<td>'+
                                '<input class="productModel_'+total+'" type="text" name="productModel[]" value="'+productModelNo+'" readonly>'+
                            '</td>'+
                            '<td>'+
                                '<input class="productSerial_'+total+'" type="text" name="productSerial[]" value="'+productSerialNo+'" readonly>'+
                            '</td>'+
                                '<td>'+
                                    '<input style="text-align: right;" class="productCommision_'+total+'" type="number" name="commission[]" value="'+commissionRate+'" readonly>'+
                                '</td>'+
                            '<td>'+
                                '<input style="text-align: right;" class="productPrice productPrice_'+total+'" type="text" name="productPrice[]" value="'+productPrice+'" required readonly>'+
                            '</td>'+
                            '<td>'+
                                '<input style="text-align: right;" class="productQty productQty_'+total+'" type="number" name="productQty[]" value="1" readonly>'+
                            '</td>'+

                            '<td>'+
                                '<input style="text-align: right;" class="amount amount_'+total+'" type="number" name="amount[]" value="'+productPrice+'" readonly>'+
                            '</td>'+
                            '<td align="center">'+
                                '<span class="btn btn-outline-danger btn-sm item_remove" onclick="withApprovalRowRemove('+total+','+dealerRequisitionProductId+')" style="width: 100%;">'+
                                    '<i class="fa fa-trash"></i>'+
                                '</span>'+
                            '</td>'+
                        '</tr>'
                    );
                    $('#serialNo_'+productSerialNo).remove();
                    $('.row_count').val(total);
                }
            }
        }

        $(document).on('change', '#dealer', function(){
            var dealerId = $("#dealer option:selected").val();
            $("#dealerId").val(dealerId);
            $('.issueProductRow').remove();
            $('#product').val("").trigger('chosen:updated');
            $('#serialNo').val("").trigger('chosen:updated');
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
                        var dealerId = $("#dealerId").val();
                        var serialNo = $(".serialNo").val();

                        var row_count = $('.row_count').val();
                        var total = parseInt(row_count) + 1;

                        $(".issueProductList tbody").append(
                            '<tr class="issueProductRow" id="issueProductRow_'+total+'">' +                
                                '<td>'+
                                    '<input class="productId_'+total+'" type="text" name="productId[]" value="">'+
                                    '<input class="productName_'+total+'" type="text" name="productName[]" value="" readonly>'+
                                '</td>'+
                                '<td>'+
                                    '<input class="productModel_'+total+'" type="text" name="productModel[]" value="" readonly>'+
                                '</td>'+
                                '<td>'+
                                    '<input class="productSerial_'+total+'" type="text" name="productSerial[]" value="" readonly>'+
                                    '<input class="serialNo_'+serialNo+'" type="text" name="productSerial[]" value="'+serialNo+'" readonly>'+
                                '</td>'+
                                '<td>'+
                                    '<input style="text-align: right;" class="productCommision_'+total+'" type="number" name="commission[]" value="" readonly>'+
                                '</td>'+
                                '<td>'+
                                    '<input style="text-align: right;" class="productPrice productPrice_'+total+'" type="number" name="productPrice[]" value="" required readonly>'+
                                '</td>'+
                                '<td>'+
                                    '<input style="text-align: right;" class="productQty productQty_'+total+'" type="number" name="productQty[]" value="1" readonly>'+
                                '</td>'+

                                '<td>'+
                                    '<input style="text-align: right;" class="amount amount_'+total+'" type="number" name="amount[]" value="" readonly>'+
                                '</td>'+
                                '<td align="center">'+
                                    '<span class="btn btn-outline-danger btn-sm item_remove" onclick="withoutApprovalRowRemove('+total+')" style="width: 100%;">'+
                                        '<i class="fa fa-trash"></i>'+
                                    '</span>'+
                                '</td>'+
                            '</tr>'
                        );
                        $('.serialNo option[value='+serialNo+']').remove();
                        $('.serialNo').trigger('chosen:updated');
                        $('.row_count').val(total);

                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: "POST",
                            url: "{{ route('productIssue.productInfo') }}",
                            data:{productId:productId,dealerId:dealerId},
                            success: function(response) {
                                var product = response.product;
                                var commissionRate = response.commissionRate;

                                $('.productId_'+total).val(product.id);
                                $('.productName_'+total).val(product.name);
                                $('.productModel_'+total).val(product.model_no);
                                $('.productSerial_'+total).val(serialNo);
                                $('.productCommision_'+total).val(commissionRate);
                                $('.productPrice_'+total).val(product.price);
                                $('.amount_'+total).val(product.price);

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

        function withApprovalRowRemove(i,id)
        {
            var issueQty = parseInt($('.issueQty_'+id).val());
            issueQty = issueQty - 1;
            $('.issueQty_'+id).val(issueQty);

            var totalQty = parseInt($('.totalQty').val());
            totalQty = totalQty - 1;
            $('.totalQty').val(totalQty);

            var productPrice = parseFloat($('.productPrice_'+i).val());
            var totalAmount = parseInt($('.totalAmount').val());
            totalAmount = totalAmount - productPrice;
            $('.totalAmount').val(totalAmount);

            var productSerialNo = $('.productSerial_'+i).val();

            $('.productSerialNo_'+id).append(
                '<option id="serialNo_'+productSerialNo+'" value="'+productSerialNo+'">'+productSerialNo+'</option>'
            );

            $('#issueProductRow_'+i).remove();
        }

        function withoutApprovalRowRemove(i)
        {
            var totalQty = parseInt($('.totalQty').val());
            totalQty = totalQty - 1;
            $('.totalQty').val(totalQty);

            var productPrice = parseFloat($('.productPrice_'+i).val());
            var totalAmount = parseInt($('.totalAmount').val());
            totalAmount = totalAmount - productPrice;
            $('.totalAmount').val(totalAmount);

            var serialNo = $('.productSerial_'+i).val();

            $('.serialNo').append(
                '<option id="serialNo_'+serialNo+'" value="'+serialNo+'">'+serialNo+'</option>'
            );
            
            $('.serialNo').trigger('chosen:updated');

            $('#issueProductRow_'+i).remove();
        }          
    </script>

@endsection
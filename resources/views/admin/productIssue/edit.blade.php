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

   

    <div class="card-body">
        @if ($issuedProduct->issue_type == 'With Approval')
            @include('admin/productIssue/edit/editWithApproval')
        @endif

        @if ($issuedProduct->issue_type == 'Without Approval')
            @include('admin/productIssue/edit/editWithoutApproval')
        @endif
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
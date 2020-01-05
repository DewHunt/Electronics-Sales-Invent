@extends('admin.layouts.masterAddEdit')

@php
    use App\DealerSetup;
    use App\LiftingProduct;

    $dealerInfo = DealerSetup::where('id',$issuedProduct->dealer_id)->first();
@endphp

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
        <div class="row">
            <div class="col-md-4">
                <label for="issue-type">Issue Type</label>
                <div class="form-group">
                    <input type="text" class="form-control" name="issueType" value="{{ $issuedProduct->issue_type }}" readonly>
                </div>
            </div>

            <div class="col-md-4">
                <label for="issue-no">Issue No</label>
                <div class="form-group {{ $errors->has('productIssueNo') ? ' has-danger' : '' }}">
                    <input type="text" class="form-control" name="productIssueNo" value="{{ $issuedProduct->issue_no }}" required readonly>
                    @if ($errors->has('productIssueNo'))
                        @foreach($errors->get('productIssueNo') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="col-md-4">
                <label for="issue-date">Issue Date</label>
                <div class="form-group {{ $errors->has('issueDate') ? ' has-danger' : '' }}">
                    <input type="text" class="form-control datepicker" name="issueDate" value="{{ date('Y-m-d', strtotime($issuedProduct->date)) }}" readonly>
                    @if ($errors->has('issueDate'))
                        @foreach($errors->get('issueDate') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <input type="text" class="form-control" id="dealerId" name="dealerId" value="{{ $issuedProduct->dealer_id }}" readonly>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" id="issueId" name="issueId" value="{{ $issuedProduct->id }}" readonly>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" id="dealerRequisitionId" name="dealerRequisitionId" value="{{ $issuedProduct->requisition_id }}" readonly>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <label for="dealer">Requisitions No</label>
                <div class="form-group">
                    <input type="text" class="form-control" name="issueType" value="{{ $issuedProduct->requisitionNo }}" readonly="">
                </div>
            </div>

            <div class="col-md-4">
                <label for="dealer-code">Dealer Code</label>
                <div class="form-group">
                    <input type="text" class="form-control" id="dealerCode" name="dealerCode" value="{{ $dealerInfo->code }}" readonly>
                </div>
            </div>

            <div class="col-md-4">
                <label for="dealer-name">Dealer Name</label>
                <div class="form-group">
                    <input type="text" class="form-control" id="dealerName" name="dealerName" value="{{ $dealerInfo->name }}" readonly>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label for="dealer-address">Dealer Address</label>
                <div class="form-group">
                    <textarea class="form-control" id="dealerAddress" name="dealerAddress" rows="5">{{ $dealerInfo->address }}</textarea>
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
                        @foreach ($issuedProductLists as $issuedProductList)
                            @php
                                $productSerials = LiftingProduct::where('product_id',$issuedProductList->product_id)->where('status','1')->get();
                            @endphp
                            <tr class="issueProductRow_{{ $issuedProductList->product_id }} '">                
                                <td>
                                    <input class="productId_{{ $issuedProductList->product_id }}" type="hidden" name="productId[]" value="{{ $issuedProductList->product_id }}">
                                    <input class="productName_{{ $issuedProductList->product_id }}" type="text" name="productName[]" value="{{ $issuedProductList->productName }}" readonly>
                                </td>
                                <td>
                                    <input class="productModel_{{ $issuedProductList->product_id }}" type="text" name="productModel[]" value="{{ $issuedProductList->model_no }}" readonly>
                                </td>
                                <td>
                                    <select class="form-control chosen-select productSerialNo_{{ $issuedProductList->product_id }}" id="productSerialNo_{{ $issuedProductList->product_id }}" name="productSerial[]">
                                        <option value="">Select Serial No</option>
                                        @foreach ($productSerials as $productSerial)
                                            @php
                                                if ($productSerial->serial_no == $issuedProductList->serial_no)
                                                {
                                                    $select = "selected";
                                                }
                                                else
                                                {
                                                    $select = "";
                                                }                                            
                                            @endphp
                                            <option value="{{ $productSerial->serial_no }}" {{ $select }}>{{ $productSerial->serial_no }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                    <td>
                                        <input style="text-align: right;" class="productCommision_{{ $issuedProductList->product_id }}" type="number" name="commission[]" value="{{ $issuedProductList->commission_rate }}" readonly>
                                    </td>
                                <td>
                                    <input style="text-align: right;" class="productPrice productPrice_{{ $issuedProductList->product_id }}" type="number" name="productPrice[]" value="{{ $issuedProductList->price }}" required readonly>
                                </td>
                                <td>
                                    <input style="text-align: right;" class="productQty productQty_{{ $issuedProductList->product_id }}" type="number" name="productQty[]" value="{{ $issuedProductList->qty }}" readonly>
                                </td>

                                <td>
                                    <input style="text-align: right;" class="amount amount_{{ $issuedProductList->product_id }}" type="number" name="amount[]" value="{{ $issuedProductList->amount }}" readonly>
                                </td>
                                <td align="center">
                                    <span class="btn btn-outline-danger btn-sm item_remove" onclick="itemRemove({{ $issuedProductList->product_id }})" style="width: 100%;">
                                        <i class="fa fa-trash"></i>
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="total-qty">Total Quantity</label>
                <div class="form-group">
                    <input style="text-align: right;" class="form-control totalQty" type="number" name="totalQty" value="{{ $issuedProduct->total_qty }}" readonly>
                </div>
            </div>

            <div class="col-md-6">
                <label for="taotal-amount">Total Amount</label>
                <div class="form-group">
                    <input style="text-align: right;" class="form-control totalAmount" type="number" name="totalAmount" value="{{ $issuedProduct->total_amount }}" readonly>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
    <script type="text/javascript">
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

            $('.issueProductRow_'+i).remove();
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
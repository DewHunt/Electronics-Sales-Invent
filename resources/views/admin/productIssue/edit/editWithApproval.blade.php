@php
    use App\DealerSetup;

    $dealerInfo = DealerSetup::where('id',$issuedProduct->dealer_id)->first();
@endphp

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
        <div class="col-md-12">
            <input type="text" class="form-control" id="dealerId" name="dealerId" value="{{ $issuedProduct->dealer_id }}" readonly>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <label for="dealer">Requisitions No</label>
            <div class="form-group">
                <input type="text" class="form-control" name="issueType" value="{{ $issuedProduct->issue_type }}">
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
                    @foreach ($issuedProductLists as $issuedProductList)
                        '<tr id="issueProductRow_{{ $issuedProductList->product_id }} '">' +                
                            <td>
                                <input class="productId_{{ $issuedProductList->product_id }}" type="text" name="productId[]" value="'+productId+'">
                                <input class="productName_{{ $issuedProductList->product_id }}" type="text" name="productName[]" value="'+productName+'" readonly>
                            </td>
                            <td>
                                <input class="productModel_{{ $issuedProductList->product_id }}" type="text" name="productModel[]" value="'+productModelNo+'" readonly>
                            </td>
                            <td>
                                <input class="productSerial_{{ $issuedProductList->product_id }}" type="text" name="productSerial[]" value="'+productSerialNo+'" readonly>
                            </td>
                                <td>
                                    <input style="text-align: right;" class="productCommision_'+productId+'" type="number" name="commission[]" value="0" readonly>
                                </td>
                            <td>
                                <input style="text-align: right;" class="productPrice productPrice_{{ $issuedProductList->product_id }}" type="text" name="productPrice[]" value="'+productPrice+'" required readonly>
                            </td>
                            <td>
                                <input style="text-align: right;" class="productQty productQty_{{ $issuedProductList->product_id }}" type="number" name="productQty[]" value="1" readonly>
                            </td>

                            <td>
                                <input style="text-align: right;" class="amount amount_{{ $issuedProductList->product_id }}" type="number" name="amount[]" value="'+productPrice+'" readonly>
                            </td>
                            <td align="center">
                                <span class="btn btn-outline-danger btn-sm item_remove" onclick="itemRemove('+{{ $issuedProductList->product_id }})" style="width: 100%;">
                                    <i class="fa fa-trash"></i>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
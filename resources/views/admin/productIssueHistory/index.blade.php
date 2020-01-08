@extends('admin.layouts.masterReport')

@section('search_card_body')
    <input type="hidden" name="print" value="print">
    <div class="row">
        <div class="col-md-6 form-group">
            <label for="from-date">From Date</label>
            <input  type="text" class="form-control datepicker" id="{{ $print == 'print' ? '' : 'from_date' }}" name="fromDate" value="{{ date('d-m-Y',strtotime($fromDate)) }}" placeholder="Select Date From">
        </div>
        <div class="col-md-6 form-group">
            <label for="to-date">To Date</label>
            <input  type="text" class="form-control datepicker" id="{{ $print == 'print' ? '' : 'to_date' }}" name="toDate" value="{{ date('d-m-Y',strtotime($toDate)) }}" placeholder="Select Date To">
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label for="dealer">Dealer</label>
            <div class="form-group">
                <select class="form-control chosen-select" id="dealer" name="dealer[]" multiple>
                    @foreach ($dealers as $dealerInfo)
                        @php
                            $select = "";
                            if ($dealer)
                            {
                                if (in_array($dealerInfo->id, $dealer))
                                {
                                    $select = "selected";
                                }
                                else
                                {
                                    $select = "";
                                }
                            }
                        @endphp
                        <option value="{{ $dealerInfo->id }}" {{ $select }}>{{ $dealerInfo->name }}</option>
                    @endforeach
                </select>
            </div>  
        </div>

        <div class="col-md-6">
            <label for="category">Category</label>
            <div class="form-group">
                <select class="form-control chosen-select" id="category" name="category[]" multiple>
                    @foreach ($categories as $categoryInfo)
                        @php
                            $select = "";
                            if ($category)
                            {
                                if (in_array($categoryInfo->id, $category))
                                {
                                    $select = "selected";
                                }
                                else
                                {
                                    $select = "";
                                }
                            }
                        @endphp
                        <option value="{{ $categoryInfo->id }}" {{ $select }}>{{ $categoryInfo->name }}</option>
                    @endforeach
                </select>
            </div>  
        </div>
    </div>
@endsection

@section('print_card_header')
    @if ($dealer)
        @foreach ($dealer as $dealerInfo)
            <input type="hidden" name="dealer[]" value="{{ $dealerInfo }}">
        @endforeach
    @endif

    @if ($category)
        @foreach ($category as $categoryInfo)
            <input type="hidden" name="category[]" value="{{ $categoryInfo }}">
        @endforeach
    @endif

    <input type="hidden" name="fromDate" value="{{ $fromDate }}">
    <input type="hidden" name="toDate" value="{{ $toDate }}">
    <input type="hidden" id="print_value" name="print" value="{{ $print }}">
@endsection

@section('print_card_body')
	<table id="dataTable" name="paymentRecordTable" class="table table-bordered table-sm">
		<thead>
			<tr>
                <th width="20px">Sl</th>
                <th width="80px">Date</th>
                <th>Dealer Name</th>
                <th>Category Name</th>
                <th width="150px">Product Name</th>
                <th width="90px">Serial No</th>
                <th width="80px">Qty</th>
                <th width="80px">Amount</th>
			</tr>
		</thead>

		<tbody>
            @php
                $sl = 1;
            @endphp

            @foreach ($productIssueHistories as $productIssueHistory)
                <tr>
                    <td>{{ $sl++ }}</td>
                    <td>{{ date('Y-m-d',strtotime($productIssueHistory->date))}}</td>
                    <td>{{ $productIssueHistory->dealerName }}</td>
                    <td>{{ $productIssueHistory->categoryName }}</td>
                    <td>{{ $productIssueHistory->productName }}</td>
                    <td>{{ $productIssueHistory->productSerialNO }}</td>
                    <td align="right">{{ $productIssueHistory->issueQty }}</td>
                    <td align="right">{{ $productIssueHistory->issueAmount }}</td>
                </tr>
            @endforeach
		</tbody>
	</table>
@endsection
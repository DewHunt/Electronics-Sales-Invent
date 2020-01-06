@extends('admin.layouts.masterReport')

@section('search_card_body')
    <input type="hidden" name="print" value="print">
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
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="from-date">From Date</label>
                    <input  type="text" class="form-control datepicker" id="from_date" name="fromDate" placeholder="Select Date From">
                </div>
                <div class="col-md-6 form-group">
                    <label for="to-date">To Date</label>
                    <input  type="text" class="form-control datepicker" id="to_date" name="toDate" placeholder="Select Date To">
                </div>
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

    <input type="hidden" name="fromDate" value="{{ $fromDate }}">
    <input type="hidden" name="toDate" value="{{ $toDate }}">
    <input type="hidden" id="print_value" name="print" value="{{ $print }}">
@endsection

@section('print_card_body')
	<table id="dataTable" name="paymentRecordTable" class="table table-bordered table-sm">
		<thead>
			<tr>
                <th width="20px">Sl</th>
				<th>Dealer Name</th>
                <th>Category</th>
				<th width="110px">Sale Amount</th>
                <th width="130px">Commission Rate</th>
                <th width="100px">Commission</th>
			</tr>
		</thead>

		<tbody>
            @php
                $sl = 0;
            @endphp

            @foreach ($dealerCommissionStatements as $dealerCommissionStatement)
                <tr>
                    <td>{{ $sl++ }}</td>
                    <td>{{ $dealerCommissionStatement->dealerName }}</td>
                    <td>{{ $dealerCommissionStatement->categoryName }}</td>
                    <td>{{ $dealerCommissionStatement->saleAmount }}</td>
                    <td>{{ $dealerCommissionStatement->commissionRate }}</td>
                    <td>{{ $dealerCommissionStatement->commissionAmount }}</td>
                </tr>
            @endforeach
		</tbody>
	</table>
@endsection
@extends('admin.layouts.masterReport')

@section('search_card_body')
    <input type="hidden" name="print" value="print">
    <div class="row">
        <div class="col-md-6">
            <label for="customer">Customer</label>
            <div class="form-group">
                <select class="form-control chosen-select" id="customer" name="customer[]" multiple>
                    @foreach ($customers as $customerInfo)
                        @php
                            $select = "";
                            if ($customer)
                            {
                                if (in_array($customerInfo->id, $customer))
                                {
                                    $select = "selected";
                                }
                                else
                                {
                                    $select = "";
                                }
                            }
                        @endphp
                        <option value="{{ $customerInfo->id }}" {{ $select }}>{{ $customerInfo->name }}</option>
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
    @if ($customer)
        @foreach ($customer as $customerInfo)
            <input type="hidden" name="customer[]" value="{{ $customerInfo }}">
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
                @php
                    if ($previousBalances)
                    {
                        $previousBalance = $previousBalances->salesAmount - $previousBalances->collection;
                    }
                    else
                    {
                        $previousBalance = 0;
                    }                                        
                @endphp
                <th colspan="5" style="text-align: right; font-weight: bold;">Previous Balance</th>
                <th style="text-align: right;">{{ $previousBalance }}</th>
            </tr>
			<tr>
                <th width="20px">Sl</th>
				<th width="100px">Date</th>
				<th>Customer Name</th>
				<th width="100px">Sales</th>
                <th width="100px">Collection</th>
                <th width="100px">Balance</th>
			</tr>
		</thead>

		<tbody>
            @php
                $sl = 0;
            @endphp
            @foreach ($customerStatements as $customerStatement)
                @php
                    $sl++;
                    if ($sl == 1)
                    {
                        $balance = $previousBalance + $customerStatement->salesAmount - $customerStatement->collection;
                    }
                    else
                    {
                        $balance = $balance + ($customerStatement->salesAmount - $customerStatement->collection); 
                    }                                        
                @endphp
                <tr>
                    <td>{{ $sl++ }}</td>
                    <td>{{ Date('d-m-Y',strtotime($customerStatement->date)) }}</td>
                    <td>{{ $customerStatement->customerName }}</td>
                    <td style="text-align: right;">{{ $customerStatement->salesAmount }}</td>
                    <td style="text-align: right;">{{ $customerStatement->collection }}</td>
                    <td style="text-align: right;">{{ $balance }}</td>
                </tr>
            @endforeach
		</tbody>
	</table>
@endsection
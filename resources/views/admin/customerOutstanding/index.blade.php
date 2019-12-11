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
                <th width="20px">Sl</th>
				<th>Cutomer Name</th>
				<th width="100px">Mobile No</th>
				<th width="110px">Sales Amount</th>
                <th width="100px">Collection</th>
                <th width="100px">Outstanding</th>
			</tr>
		</thead>

		<tbody>
		</tbody>
	</table>
@endsection
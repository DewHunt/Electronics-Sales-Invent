@extends('admin.layouts.masterReport')

@section('search_card_body')
    <div class="row">
        <div class="col-md-12">
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
    </div>
@endsection

@section('print_card_header')
    @if ($customer)
        @foreach ($customer as $customerInfo)
            <input type="hidden" name="customer[]" value="{{ $customerInfo }}">
        @endforeach
    @endif
    <input type="hidden" id="print_value" name="print" value="Print">
@endsection

@section('print_card_body')
	<table id="dataTable" name="paymentRecordTable" class="table table-bordered table-sm">
		<thead>
			<tr>
                <th width="20px">Sl</th>
				<th>Cutomer Name</th>
				<th width="100px">Mobile No</th>
                <th width="100px">Invoice No</th>
                <th width="200px">Product Name</th>
				<th width="110px">Sales Amount</th>
                <th width="100px">Collection</th>
                <th width="100px">Outstanding</th>
			</tr>
		</thead>

		<tbody>
            @php
                $sl = 0;
            @endphp
            @foreach ($customerOutstandings as $customerOutstanding)
                <tr>
                    <td>{{ $sl++ }}</td>
                    <td>{{ $customerOutstanding->customerName }}</td>
                    <td>{{ $customerOutstanding->customerPhoneNo }}</td>
                    <td>{{ $customerOutstanding->invoiceNo }}</td>
                    <td>{{ $customerOutstanding->productName }}</td>
                    <td>{{ $customerOutstanding->salesAmount }}</td>
                    <td>
                        @php
                            $collection = 0;
                            if ($customerOutstanding->collection)
                            {
                                $collection = $customerOutstanding->collection;
                            }                           
                        @endphp
                        {{ $collection }}
                    </td>
                    <td>
                        @php
                            $balance = $customerOutstanding->salesAmount;
                            if ($customerOutstanding->collection)
                            {
                                $balance = $customerOutstanding->balance;
                            }                           
                        @endphp
                        {{ $balance }}
                    </td>
                </tr>
            @endforeach
		</tbody>
	</table>
@endsection
@extends('admin.layouts.masterReport')

@section('search_card_body')
    <input type="hidden" name="print" value="print">
    <div class="row">
        <div class="col-md-6">
            <label for="vendor">Vendor</label>
            <div class="form-group">
                <select class="form-control chosen-select" id="vendor" name="vendor[]" multiple>
                    @foreach ($vendors as $vendorInfo)
                        @php
                            $select = "";
                            if ($vendor)
                            {
                                if (in_array($vendorInfo->id, $vendor))
                                {
                                    $select = "selected";
                                }
                                else
                                {
                                    $select = "";
                                }
                            }
                        @endphp
                        <option value="{{ $vendorInfo->id }}" {{ $select }}>{{ $vendorInfo->name }}</option>
                    @endforeach
                </select>
            </div>  
        </div>

        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="from-date">From Date</label>
                    <input  type="text" class="form-control datepicker" id="{{ $print == "print" ? "" : "from_date" }}" name="fromDate" placeholder="Select Date From" value="{{ date('d-m-Y',strtotime($fromDate)) }}" readonly>
                </div>
                <div class="col-md-6 form-group">
                    <label for="to-date">To Date</label>
                    <input  type="text" class="form-control datepicker" id="{{ $print == "print" ? "" : "to_date" }}" name="toDate" placeholder="Select Date To" value="{{ date('d-m-Y',strtotime($toDate)) }}" readonly>
                </div>
            </div>                                  
        </div>
    </div>
@endsection

@section('print_card_header')
    @if ($vendor)
        @foreach ($vendor as $vendorInfo)
            <input type="hidden" name="vendor[]" value="{{ $vendorInfo }}">
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
				<th width="100px">Date</th>
				<th>Name</th>
				<th width="120px">Payment Price</th>
			</tr>
		</thead>

		<tbody>
            @php
                $sl = 0;
            @endphp
			@foreach ($productRecords as $productRecord)
				<tr>
                    <td>{{ $sl++ }}</td>
					<td>{{ $productRecord->paymentDate }}</td>
					<td>{{ $productRecord->vendorName }}</td>
					<td>{{ $productRecord->price }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{{-- {{ $productLists->render() }} --}}
@endsection
@extends('admin.layouts.masterReport')

@section('search_card_body')
    <input type="hidden" name="print" value="print">
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

    <div class="row">
        <div class="col-md-6">
            <label for="host">Host</label>
            <div class="form-group">
                <select class="form-control chosen-select host" id="host" name="host">
                    <option value="">Select Host</option>
                    @foreach ($storeAndShowrooms as $storeAndShowroom)
                        @php
                            if ($storeAndShowroom->type == $hostType AND $storeAndShowroom->id == $hostId)
                            {
                                $select = "selected";
                            }
                            else
                            {
                                $select = "";
                            }                            
                        @endphp
                        <option value="{{ $storeAndShowroom->id }},{{ $storeAndShowroom->type }}" {{ $select }}>{{ $storeAndShowroom->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <label for="destination">Destination</label>
            <div class="form-group" id="destination-select-menu">
                <select class="form-control chosen-select destination" id="destination" name="destination">
                    <option value="">Select Destination</option>
                    @foreach ($storeAndShowrooms as $storeAndShowroom)
                        @php
                            if ($storeAndShowroom->type == $destinationType AND $storeAndShowroom->id == $destinationId)
                            {
                                $select = "selected";
                            }
                            else
                            {
                                $select = "";
                            }                            
                        @endphp
                        <option value="{{ $storeAndShowroom->id }},{{ $storeAndShowroom->type }}" {{ $select }}>{{ $storeAndShowroom->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
@endsection

@section('print_card_header')
    <input type="hidden" name="fromDate" value="{{ $fromDate }}">
    <input type="hidden" name="toDate" value="{{ $toDate }}">

    <input type="hidden" name="hostType" value="{{ $hostType }}">
    <input type="hidden" name="hostId" value="{{ $hostId }}">
    <input type="hidden" name="destinationType" value="{{ $destinationType }}">
    <input type="hidden" name="destinationId" value="{{ $destinationId }}">
    <input type="hidden" id="print_value" name="print" value="{{ $print }}">
@endsection

@section('print_card_body')
	<table id="dataTable" name="liftingRecord" class="table table-bordered table-sm">
		<thead>
			<tr>
                <th width="20px">Sl</th>
				<th>Host</th>
				<th>Destination</th>
				<th>Date</th>
                <th>Product Name</th>
                <th>Model</th>
                <th>Qty</th>
			</tr>
		</thead>

		<tbody>
            @php
                $sl = 1;
            @endphp

            @foreach ($transferReports as $transferReport)
                <tr>
                    <td>{{ $sl++ }}</td>
                    @php
                        $hostName = DB::table('view_store_and_showroom')
                            ->where('type',$transferReport->hostType)
                            ->where('id',$transferReport->hostId)
                            ->first();
                        $destinationName = DB::table('view_store_and_showroom')
                            ->where('type',$transferReport->destinationType)
                            ->where('id',$transferReport->destinationId)
                            ->first();
                    @endphp
                    <td>{{ @$hostName->name }}</td>
                    <td>{{ @$destinationName ->name}}</td>
                    <td>{{ $transferReport->date }}</td>
                    <td>{{ $transferReport->productName }}</td>
                    <td>{{ $transferReport->productModelNo }}</td>
                    <td>{{ $transferReport->productQty }}</td>
                </tr>
            @endforeach
		</tbody>
	</table>
@endsection
@extends('admin.layouts.masterReport')

@section('search_card_body')
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
    @if ($vendor)
        @foreach ($vendor as $vendorInfo)
            <input type="hidden" name="vendor[]" value="{{ $vendorInfo }}">
        @endforeach

        <input type="hidden" name="formDate" value="{{ $formDate }}">
        <input type="hidden" name="toDate" value="{{ $toDate }}">
    @endif
@endsection

@section('print_card_body')
	<table id="paymentRecordTable" name="paymentRecordTable" class="table table-bordered table-sm">
		<thead class="thead-light">
			<tr>
                <th width="20px">Sl</th>
				<th width="100px">Date</th>
				<th>Name</th>
				<th width="120px">Payment Price</th>
			</tr>
		</thead>

		<tbody>
{{--             @php
                $sl = 0;
            @endphp
			@foreach ($productRecords as $productRecord)
				<tr>
                    <td>{{ $sl++ }}</td>
					<td>{{ $productRecord->paymentDate }}</td>
					<td>{{ $productRecord->vendorName }}</td>
					<td>{{ $productRecord->price }}</td>
				</tr>
			@endforeach --}}
		</tbody>
	</table>
	{{-- {{ $productLists->render() }} --}}
@endsection

@section('custom-js')

    <!-- This is data table -->
    <script src="{{ asset('/public/admin-elite/assets/node_modules/datatables/jquery.dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var updateThis ;

            // Switchery
            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            $('.js-switch').each(function() {
                new Switchery($(this)[0], $(this).data());
            });

            var table = $('#paymentRecordTable').DataTable( {
                "order": [[0, "asc"]]
            } );

            table.on('order.dt search.dt', function () {
                table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();
        });
    </script>
@endsection
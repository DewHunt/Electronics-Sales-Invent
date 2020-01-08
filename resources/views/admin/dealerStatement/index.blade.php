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
                    <input  type="text" class="form-control datepicker" id="{{ $print == 'print' ? '' : 'from_date' }}" name="fromDate" value="{{ date('d-m-Y',strtotime($fromDate)) }}" placeholder="Select Date From">
                </div>
                <div class="col-md-6 form-group">
                    <label for="to-date">To Date</label>
                    <input  type="text" class="form-control datepicker" id="{{ $print == 'print' ? '' : 'to_date' }}" name="toDate" value="{{ date('d-m-Y',strtotime($toDate)) }}" placeholder="Select Date To">
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
                <th colspan="5" style="text-align: right;"><b>Previous Balance</b></th>
                <th style="text-align: right;">{{ $previousBalance->previousBalance == '' ? 0 : $previousBalance->previousBalance }}</th>
            </tr>
			<tr>
                <th width="20px">Sl</th>
                <th>Dealer Name</th>
                <th width="80px">Date</th>
                <th width="80px">Sales</th>
                <th width="90px">Collection</th>
                <th width="80px">Balance</th>
			</tr>
		</thead>

		<tbody>
            @php
                $sl = 1;
                $loops = 1;
            @endphp

            @foreach ($dealerStatements as $dealerStatement)
                @php
                    if ($loops == 1)
                    {
                        $balance = $previousBalance->previousBalance + ($dealerStatement->sales - $dealerStatement->collection);
                    }
                    else
                    {
                        $balance = $balance + ($dealerStatement->sales - $dealerStatement->collection);;
                    }
                    $loops++;
                @endphp
                <tr>
                    <td>{{ $sl++ }}</td>
                    <td>{{ $dealerStatement->dealerName }}</td>
                    <td>{{ date('d-m-y',strtotime($dealerStatement->date))}}</td>
                    <td align="right">{{ $dealerStatement->sales }}</td>
                    <td align="right">{{ $dealerStatement->collection }}</td>
                    <td align="right">{{ $balance }}</td>
                </tr>
            @endforeach
		</tbody>
	</table>
@endsection
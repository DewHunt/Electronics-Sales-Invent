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

        <div class="col-md-3">
            <label for="month">Month</label>
            <div class="form-group">
                @php
                    $months = array('1' => 'January', '2' => 'February', '3' => 'March', '4' => 'April', '5' => 'May', '6' => 'June', '7' => 'July', '8' => 'August', '9' => 'September', '10' => 'October', '11' => 'November', '12' => 'December');
                @endphp
                <select class="form-control" id="month" name="month">
                    <option value="">Select Month</option>
                    @php
                        $select = "";
                        if ($month == "")
                        {
                            $month = date('m');
                        }
                    @endphp
                    @foreach ($months as $key => $value)
                        @php
                            if ($key == $month)
                            {
                                $select = "selected";
                            }
                            else
                            {
                                $select = "";
                            }
                        @endphp
                        <option value="{{ $key }}" {{ $select }}>{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <label for="from_date">Year</label>
            <div class="form-group">
                <select class="form-control" id="year" name="year">
                    <option value="">Select Year</option>
                    @php
                        $select = "";
                        if ($year == "")
                        {
                            $year = date('Y');
                        }
                        $currentYear = date('Y');
                    @endphp
                    @for ($i = $currentYear; $i >= 1900; $i--)
                        @php
                            if ($i == $year)
                            {
                                $select = "selected";
                            }
                            else
                            {
                                $select = "";
                            }
                        @endphp
                        <option value="{{ $i }}" {{ $select }}>{{ $i }}</option>
                    @endfor
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

    <input type="hidden" name="month" value="{{ $month }}">
    <input type="hidden" name="year" value="{{ $year }}">
    <input type="hidden" id="print_value" name="print" value="{{ $print }}">
@endsection

@section('print_card_body')
	<table id="dataTable" name="paymentRecordTable" class="table table-bordered table-sm">
		<thead>
            <tr>
                <th width="20px" rowspan="2" style="vertical-align: middle;">Sl</th>
                <th rowspan="2" style="vertical-align: middle;">Dealer Name</th>
                <th width="110px" rowspan="2" style="vertical-align: middle;">Previous Year</th>
                <th colspan="3" style="text-align: center;"><b>For The Year Of {{ $year == "" ? "" : $year }}</b></th>
                <th colspan="3" style="text-align: center;"><b>For The Month Of {{ $month == "" ? "" : date('F', mktime(0, 0, 0,$month, 10)) }}</b></th>
                <th width="120px" rowspan="2" style="vertical-align: middle;">Current Balance</th>
            </tr>
			<tr>
                <th width="70px">Sales</th>
                <th width="80px">Realization</th>
                <th width="70px">Inc/Dec</th>
                <th width="7px">Sales</th>
                <th width="80px">Realization</th>
                <th width="70px">Inc/Dec</th>
			</tr>
		</thead>

		<tbody>
            @php
                $sl = 1;
                $currentId = 0;
            @endphp

            @foreach ($realizations as $realization)
                @php
                    $sl++;
                    $yearlySales = 0;
                    $yearlyCollection = 0;
                    $monthlySales = 0;
                    $monthlyCollection = 0;                                    
                @endphp
                @if ($realization->dealerId != $currentId)
                    @foreach ($realizations as $value)
                        @php
                            if ($realization->dealerId == $value->dealerId)
                            {
                                $yearlySales = $yearlySales + $value->yearlySales;
                                $yearlyCollection = $yearlyCollection + $value->yearlyCollection;
                                $monthlySales = $monthlySales + $value->monthlySales;
                                $monthlyCollection = $monthlyCollection + $value->monthlyCollection;
                            }
                            $currentId = $realization->dealerId;
                        @endphp
                    @endforeach
                    <tr>
                        <td>{{ $sl++ }}</td>
                        <td>{{ $realization->dealerName }}</td>
                        <td align="right">{{ $realization->previousYearBalance }}</td>
                        <td align="right">{{ $yearlySales }}</td>
                        <td align="right">{{ $yearlyCollection }}</td>
                        <td align="right">{{ $yearlySales - $yearlyCollection }}</td>
                        <td align="right">{{ $monthlySales }}</td>
                        <td align="right">{{ $monthlyCollection }}</td>
                        <td align="right">{{ $monthlySales - $monthlyCollection }}</td>
                        <td align="right">{{ $realization->previousYearBalance + $yearlySales - $yearlyCollection }}</td>
                    </tr>
                @endif
            @endforeach
		</tbody>
	</table>
@endsection
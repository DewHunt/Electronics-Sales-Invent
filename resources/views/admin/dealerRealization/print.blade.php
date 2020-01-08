@extends('admin.layouts.masterPrint')

@section('content')
    <table id="report-header">
        <tr>
            <td>Dealer Realization For {{ date('F', mktime(0, 0, 0,$month, 10)) }} Month  Of {{ $year }} Year</td>
        </tr>
    </table>

    <div id="pad-bottom"></div>

    <table  id="report-table">
        <thead>
            <tr>
                <th width="20px" rowspan="2" style="vertical-align: middle;">Sl</th>
                <th width="150px" rowspan="2" style="vertical-align: middle;">Dealer Name</th>
                <th width="110px" rowspan="2" style="vertical-align: middle;">Previous Year</th>
                <th colspan="3" style="text-align: center;"><b>For The Year Of {{ $year == "" ? "" : $year }}</b></th>
                <th colspan="3" style="text-align: center;"><b>For The Month Of {{ $month == "" ? "" : date('F', mktime(0, 0, 0,$month, 10)) }}</b></th>
                <th width="120px" rowspan="2" style="vertical-align: middle;">Current Balance</th>
            </tr>
            <tr>
                <th>Sales</th>
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
                $totalPreviousrealization = 0;

                $yearlyRealization = 0;
                $totalYearlyRealization = 0;

                $monthlyRealization = 0;
                $totalMonthlyRealization = 0;

                $currentRealization = 0;
                $totalCurrentRealization = 0;
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
                    @php
                        $totalPreviousrealization = $totalPreviousrealization + $realization->previousYearBalance;

                        $yearlyRealization = $yearlySales - $yearlyCollection;
                        $totalYearlyRealization = $totalYearlyRealization + $yearlyRealization;

                        $monthlyRealization = $monthlySales - $monthlyCollection;
                        $totalMonthlyRealization = $totalMonthlyRealization + $monthlyRealization;

                        $currentRealization = $realization->previousYearBalance + $yearlyRealization;
                        $totalCurrentRealization = $totalCurrentRealization + $currentRealization;
                    @endphp
                    <tr>
                        <td>{{ $sl++ }}</td>
                        <td>{{ $realization->dealerName }}</td>
                        <td align="right">{{ $realization->previousYearBalance }}</td>
                        <td align="right">{{ $yearlySales }}</td>
                        <td align="right">{{ $yearlyCollection }}</td>
                        <td align="right">{{ $yearlyRealization }}</td>
                        <td align="right">{{ $monthlySales }}</td>
                        <td align="right">{{ $monthlyCollection }}</td>
                        <td align="right">{{ $monthlyRealization }}</td>
                        <td align="right">{{ $currentRealization }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <div id="pad-bottom"></div>

    <table  id="report-table">
        <tfoot>
            <tr>
                <th style="text-align: right;"><b>Total Previous Realization : </b></th>
                <td style="text-align: right;">{{ $totalPreviousrealization }}</td>
            </tr>

            <tr>
                <th style="text-align: right;"><b>Total Yearly Realization : </b></th>
                <td style="text-align: right;">{{ $totalYearlyRealization }}</td>
            </tr>

            <tr>
                <th style="text-align: right;"><b>Total Monthly Realization : </b></th>
                <td style="text-align: right;">{{ $totalMonthlyRealization }}</td>
            </tr>

            <tr>
                <th style="text-align: right;"><b>Total Current Realization : </b></th>
                <td style="text-align: right;">{{ $totalCurrentRealization }}</td>
            </tr>
        </tfoot>
    </table>
@endsection

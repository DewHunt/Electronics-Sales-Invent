@extends('admin.layouts.masterPrint')

@section('content')
    <table id="report-header">
        <tr>
            <td>Dealer Statement ON {{ $fromDate }} To {{ $toDate }}</td>
        </tr>
    </table>

    <div id="pad-bottom"></div>

    <table  id="report-table">
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
                $currentDealerId = 0;
                $totalSales = 0;
                $totalCollection = 0;
                $totalBalance = 0;
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
                    $totalSales = $totalSales + $dealerStatement->sales;
                    $totalCollection = $totalCollection + $dealerStatement->collection;
                    $totalBalance = $totalBalance + $balance;
                @endphp
                @if ($dealerStatement->dealerId != $currentDealerId)
                    @php
                        $currentDealerId = $dealerStatement->dealerId;
                        $rowSpan = DB::table('view_dealer_statement')
                            ->whereBetween('date', array($fromDate,$toDate))
                            ->where('dealerId',$dealerStatement->dealerId)
                            ->groupBY('date')
                            ->get();
                    @endphp
                    <tr>
                        <td>{{ $sl++ }}</td>
                        <td rowspan="{{ count($rowSpan) }}">{{ $dealerStatement->dealerName }}</td>
                        <td>{{ date('d-m-Y',strtotime($dealerStatement->date))}}</td>
                        <td align="right">{{ $dealerStatement->sales }}</td>
                        <td align="right">{{ $dealerStatement->collection }}</td>
                        <td align="right">{{ $balance }}</td>
                    </tr>
                @else
                    <tr>
                        <td>{{ $sl++ }}</td>
                        <td>{{ date('d-m-Y',strtotime($dealerStatement->date))}}</td>
                        <td align="right">{{ $dealerStatement->sales }}</td>
                        <td align="right">{{ $dealerStatement->collection }}</td>
                        <td align="right">{{ $balance }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <div id="pad-bottom"></div>

    <table  id="report-table">
        <tfoot>
            <tr>
                <th style="text-align: right;"><b>Total Sales : </b></th>
                <td style="text-align: right;">{{ $totalSales }}</td>
            </tr>

            <tr>
                <th style="text-align: right;"><b>Total Collection : </b></th>
                <td style="text-align: right;">{{ $totalCollection }}</td>
            </tr>

            <tr>
                <th style="text-align: right;"><b>Total Balance : </b></th>
                <td style="text-align: right;">{{ $totalBalance }}</td>
            </tr>
        </tfoot>
    </table>
@endsection

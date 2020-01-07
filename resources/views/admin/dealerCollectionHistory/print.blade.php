@extends('admin.layouts.masterPrint')

@section('content')
    <table id="report-header">
        <tr>
            <td>Dealer Collection History ON {{ $fromDate }} To {{ $toDate }}</td>
        </tr>
    </table>

    <div id="pad-bottom"></div>

    <table  id="report-table">
        <thead>
            <tr>
                <th width="20px">Sl</th>
                <th>Dealer Name</th>
                <th width="80px">Date</th>
                <th width="150px">Money Receipt</th>
                <th width="90px">Pay Mode</th>
                <th width="80px">Amount</th>
            </tr>
        </thead>

        <tbody>
            @php
                $sl = 1;
                $currentDealerId = 0;
                $totalAmount = 0;
            @endphp

            @foreach ($collectionHistories as $collectionHistory)
                @php
                    $totalAmount = $totalAmount + $collectionHistory->paymentAmount;
                @endphp
                @if ($collectionHistory->dealerId != $currentDealerId)
                    @php
                        $currentDealerId = $collectionHistory->dealerId;
                        $rowSpan = DB::table('tbl_dealer_collections')
                            ->whereBetween('payment_date', array($fromDate,$toDate))
                            ->where('dealer_id',$collectionHistory->dealerId)
                            ->count('dealer_id');
                    @endphp
                    <tr>
                        <td>{{ $sl++ }}</td>
                        <td rowspan="{{ $rowSpan }}">{{ $collectionHistory->dealerName }}</td>
                        <td>{{ date('Y-m-d',strtotime($collectionHistory->date))}}</td>
                        <td>{{ $collectionHistory->moneyReceiptNo }}</td>
                        <td>{{ $collectionHistory->moneyReceiptType }}</td>
                        <td align="right">{{ $collectionHistory->paymentAmount }}</td>
                    </tr>
                @else
                    <tr>
                        <td>{{ $sl++ }}</td>
                        <td>{{ date('Y-m-d',strtotime($collectionHistory->date))}}</td>
                        <td>{{ $collectionHistory->moneyReceiptNo }}</td>
                        <td>{{ $collectionHistory->moneyReceiptType }}</td>
                        <td align="right">{{ $collectionHistory->paymentAmount }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <div id="pad-bottom"></div>

    <table  id="report-table">
        <tfoot>
            <tr>
                <th style="text-align: right;"><b>Total Amount : </b></th>
                <td style="text-align: right;">{{ $totalAmount }}</td>
            </tr>
        </tfoot>
    </table>
@endsection

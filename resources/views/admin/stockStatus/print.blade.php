@extends('admin.layouts.masterPrint')

@section('content')
    <table  id="report-table">
        <caption>Stock Status Report On {{ $fromDate }} To {{ $toDate }}</caption>
        <thead>
            <tr>
                <th width="20px">Sl</th>
                <th>Product</th>
                <th width="60px">Model</th>
                <th width="60px">Color</th>
                <th width="60px">Opening</th>
                <th width="85px">Lifting Qty</th>
                <th width="75px">Sales Qty</th>
                <th width="60px">Balance</th>
                <th width="60px">Amount</th>
            </tr>
        </thead>

        <tbody>
            @php
                $sl = 1;
                $totalOpening = 0;                                       
                $totalLiftingQty = 0;                                       
                $totalSalesQty = 0;
                $totalAmount = 0;
                $balance = 0;
                $totalBalance = 0;
            @endphp
            @foreach ($stockStatusReports as $stockStatusReport)
                @php
                    $totalOpening = $totalOpening + $stockStatusReport->opening;
                    $totalLiftingQty = $totalLiftingQty + $stockStatusReport->liftingQty;
                    $totalSalesQty = $totalSalesQty + $stockStatusReport->salesQty;
                    $currentId = $stockStatusReport->productId;
                    $balance = $stockStatusReport->liftingQty - $stockStatusReport->salesQty;
                    $totalBalance = $totalBalance + $balance;
                    $totalAmount = $totalAmount + ($stockStatusReport->price * $balance);
                @endphp
                <tr>
                    <td>{{ $sl++ }}</td>
                    <td>{{ $stockStatusReport->productName }}</td>
                    <td>{{ $stockStatusReport->modelNo }}</td>
                    <td>{{ $stockStatusReport->color }}</td>
                    <td style="text-align: right;">{{ $stockStatusReport->opening }}</td>
                    <td style="text-align: right;">{{ $stockStatusReport->liftingQty }}</td>
                    <td style="text-align: right;">{{ $stockStatusReport->salesQty }}</td>
                    <td style="text-align: right;">{{ $balance }}</td>
                    <td style="text-align: right;">{{ $stockStatusReport->price * $balance }}</td>
                </tr>
            @endforeach
        </tbody>

        <tfoot>
            <tr>
                <th colspan="4">Total</th>
                <th style="text-align: right;">{{ $totalOpening }}</th>
                <th style="text-align: right;">{{ $totalLiftingQty }}</th>
                <th style="text-align: right;">{{ $totalSalesQty }}</th>
                <th style="text-align: right;">{{ $totalBalance }}</th>
                <th style="text-align: right;">{{ $totalAmount }}</th>
            </tr>
        </tfoot>
    </table>
@endsection

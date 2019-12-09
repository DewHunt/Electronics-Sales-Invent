@extends('admin.layouts.masterPrint')

@section('content')
    <table id="report-table">
        <caption>Stock Valuation Report</caption>
        <thead>
            <tr>
                <th width="20px">Sl</th>
                <th>Product</th>
                <th width="60px">Serial No</th>
                <th width="80px">Model No</th>
                <th width="50px">Color</th>
                <th width="60px">Sales Price</th>
                <th width="60px">Avg Lifting Price</th>
                <th width="30px">Qty</th>
                <th width="60px">Sales</th>
                <th width="60px">Lifting</th>
            </tr>
        </thead>

        <tbody>
            @php
                $sl = 0;
                $sales = 0;
                $lifting = 0;
                $totalSales = 0;
                $totalLifting = 0;
            @endphp

            @foreach ($stockValuationReports as $stockValuationReport)
                @php
                    $sales = $stockValuationReport->salesPrice * $stockValuationReport->stockQty;
                    $lifting = $stockValuationReport->avgLifting * $stockValuationReport->stockQty;
                    $totalSales = $totalSales + $sales;
                    $totalLifting = $totalLifting + $lifting;
                @endphp
                <tr>
                    <td>{{ $sl++ }}</td>
                    <td>{{ $stockValuationReport->productName }}</td>
                    <td>{{ $stockValuationReport->serialNo }}</td>
                    <td>{{ $stockValuationReport->modelNo }}</td>
                    <td>{{ $stockValuationReport->color }}</td>
                    <td style="text-align: right;">{{ $stockValuationReport->salesPrice }}</td>
                    <td style="text-align: right;">{{ number_format($stockValuationReport->avgLifting,'2','.','') }}</td>
                    <td style="text-align: right;">{{ $stockValuationReport->stockQty }}</td>
                    <td style="text-align: right;">{{ number_format($sales,'2','.','') }}</td>
                    <td style="text-align: right;">{{ number_format($lifting,'2','.','') }}</td>
                </tr>                                  
            @endforeach
        </tbody>
    </table>

    <div style="padding-bottom: 10px;"></div>

    <table width="100%">
        <tr>
            <th colspan="4" style="text-align: center;">Total Sales : {{ number_format($totalSales,'2','.','') }}</th>
            <th colspan="4" style="text-align: center;">Total Lifting : {{ number_format($totalLifting,'2','.','') }}</th>
        </tr>
    </table> 
@endsection

@extends('admin.layouts.masterPrint')

@section('content')
    <table id="report-header">
        <tr>
            <td>Out Of Stock</td>
        </tr>
    </table>

    <div id="pad-bottom"></div>

    <table id="report-table">
        <thead>
            <tr>
                <th width="20px">Sl</th>
                <th width="130px">Category</th>
                <th>Product</th>
                <th width="70px">Model</th>
                <th width="70px">Color</th>
                <th width="100px">Available Qty</th>
            </tr>
        </thead>

        <tbody>
            @php
                $sl = 0;
            @endphp

            @foreach ($stockOutReports as $stockOutReport)
                @php
                    $sl++;
                @endphp
                @if ($stockOutReport->remainingQty <= $stockOutReport->reorderQty)
                    <tr>
                        <td>{{ $sl++ }}</td>
                        <td>{{ $stockOutReport->categoryName }}</td>
                        <td>{{ $stockOutReport->productName }}</td>
                        <td>{{ $stockOutReport->modelNo }}</td>
                        <td>{{ $stockOutReport->color }}</td>
                        <td style="text-align: right;">{{ $stockOutReport->remainingQty }}</td>
                    </tr>
                @endif                                  
            @endforeach
        </tbody>
    </table>
@endsection

@extends('admin.layouts.masterPrint')

@section('content')
    <table id="report-header">
        {{-- <tr> --}}
            @if ($btnPrintSummary == "Print Summary")
                <tr><td>Lifting Summary On {{ $fromDate }} To {{ $toDate }}</td></tr>
                @if (@$vendorName->name)
                    <tr><td>Suppler Name: {{ @$vendorName->name }}</td></tr>
                @endif                                
            @endif

            @if ($btnPrintRecord == "Print Record")
                <tr><td>Lifting History On {{ $fromDate }} To {{ $toDate }}</td></tr>                
            @endif
        {{-- </tr> --}}
    </table>

    <div id="pad-bottom"></div>

    @if ($btnPrintSummary == "Print Summary")
        <table id="report-table">
            <thead class="thead-light">
                <tr>
                    <th width="20px">Sl</th>
                    <th>Product Name</th>
                    <th width="150px">Model</th>
                    <th width="100px">Total Lifting</th>
                    <th width="100px">Toal Amount</th>
                </tr>
            </thead>

            <tbody>
                @php
                    $sl = 1;
                    $totalQty = 0;
                    $totalPrice = 0;
                @endphp
                @foreach ($liftingSummaries as $liftingSummary)
                    @php
                        $totalQty = $totalQty + $liftingSummary->totalLifting;
                        $totalPrice = $totalPrice + $liftingSummary->totalLiftingPrice;
                    @endphp
                    <tr>
                        <td>{{ $sl++ }}</td>
                        <td>{{ $liftingSummary->productName }}</td>
                        <td>{{ $liftingSummary->productModelNo }}</td>
                        <td align="right">{{ $liftingSummary->totalLifting }}</td>
                        <td align="right">{{ $liftingSummary->totalLiftingPrice }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if ($btnPrintRecord == "Print Record")
        <table id="report-table">
            <thead class="thead-light">
                <tr>
                    <th width="20px">Sl</th>
                    <th>Date</th>
                    <th>Lifting No</th>
                    <th>Vendor</th>
                    <th>Store/Showroom Name</th>
                    <th>Category</th>
                    <th>Product</th>
                    <th>Serial</th>
                    <th>Model</th>
                    <th>Color</th>
                    <th>Qty</th>
                    <th>Price</th>
                </tr>
            </thead>

            <tbody>
                @php
                    $sl = 1;
                    $totalQty = 0;
                    $totalPrice = 0;
                @endphp
                @foreach ($liftingRecords as $liftingRecord)
                    @php
                        $totalQty = $totalQty + $liftingRecord->productQty;
                        $totalPrice = $totalPrice + $liftingRecord->price;
                    @endphp
                    <tr>
                        <td>{{ $sl++ }}</td>
                        <td>{{ $liftingRecord->liftingDate }}</td>
                        <td>{{ $liftingRecord->liftingNo }}</td>
                        <td>{{ $liftingRecord->vendorName }}</td>
                        <td>{{ $liftingRecord->storeOrShowroomName }}</td>
                        <td>{{ $liftingRecord->categoryName }}</td>
                        <td>{{ $liftingRecord->productName }}</td>
                        <td>{{ $liftingRecord->productSerialNo }}</td>
                        <td>{{ $liftingRecord->productModelNo }}</td>
                        <td>{{ $liftingRecord->productColor }}</td>
                        <td>{{ $liftingRecord->productQty }}</td>
                        <td>{{ $liftingRecord->price }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div id="pad-bottom"></div>

    <table  id="report-table">
        <tfoot>
            <tr>
                <th style="text-align: right;"><b>Total Qty : </b></th>
                <td style="text-align: right;">{{ $totalQty }}</td>
            </tr>

            <tr>
                <th style="text-align: right;"><b>Total Price : </b></th>
                <td style="text-align: right;">{{ $totalPrice }}</td>
            </tr>
        </tfoot>
    </table>
@endsection

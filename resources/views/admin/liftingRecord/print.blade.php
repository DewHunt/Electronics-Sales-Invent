@extends('admin.layouts.masterPrint')

@section('content')
    <table id="report-header">
        <tr>
            <td>Lifting History On {{ $fromDate }} To {{ $toDate }}</td>
        </tr>
    </table>

    <div id="pad-bottom"></div>

    <table  id="report-table">
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

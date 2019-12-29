@extends('admin.layouts.masterPrint')

@section('content')
    <table id="report-header">
        <tr>
            <td>Lifting Return history On {{ $fromDate }} To {{ $toDate }}</td>
        </tr>
    </table>

    <div id="pad-bottom"></div>

    <table  id="report-table">
        <thead class="thead-light">
            <tr>
                <th>SL</th>
                <th>Date</th>
                <th>Return No</th>
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
            @foreach ($liftingReturnRecords as $liftingReturnRecord)
                @php
                    $totalQty = $totalQty + $liftingReturnRecord->productQty;
                    $totalPrice = $totalPrice + $liftingReturnRecord->price;
                @endphp
                <tr>
                    <td>{{ $sl++ }}</td>
                    <td>{{ $liftingReturnRecord->liftingReturnDate }}</td>
                    <td>{{ $liftingReturnRecord->liftingReturnNo }}</td>
                    <td>{{ $liftingReturnRecord->vendorName }}</td>
                    <td>{{ $liftingReturnRecord->storeOrShowroomName }}</td>
                    <td>{{ $liftingReturnRecord->categoryName }}</td>
                    <td>{{ $liftingReturnRecord->productName }}</td>
                    <td>{{ $liftingReturnRecord->productSerialNo }}</td>
                    <td>{{ $liftingReturnRecord->productModelNo }}</td>
                    <td>{{ $liftingReturnRecord->productColor }}</td>
                    <td>{{ $liftingReturnRecord->productQty }}</td>
                    <td>{{ $liftingReturnRecord->price }}</td>
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

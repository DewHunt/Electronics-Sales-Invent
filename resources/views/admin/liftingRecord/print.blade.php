@extends('admin.layouts.masterPrint')

@section('content')
    <table  id="report-table">
        <caption>Lifting Record On {{ $fromDate }} To {{ $toDate }}</caption>
        <thead class="thead-light">
            <tr>
                <th width="20px">Sl</th>
                <th>Date</th>
                <th>Lifting No</th>
                <th>Vendor</th>
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
                $sl = 0;
            @endphp
            @foreach ($liftingRecords as $liftingRecord)
                <tr>
                    <td>{{ $sl++ }}</td>
                    <td>{{ $liftingRecord->liftingDate }}</td>
                    <td>{{ $liftingRecord->liftingNo }}</td>
                    <td>{{ $liftingRecord->vendorName }}</td>
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
@endsection

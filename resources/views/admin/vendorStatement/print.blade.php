@extends('admin.layouts.masterPrint')

@section('content')
    <table id="report-table">
        <thead>
            <tr>
                <th width="80px">Date</th>
                <th>Name</th>
                <th width="110px">Payment Price</th>
            </tr>
        </thead>

        <tbody>
            @php
                print_r($productRecords);
            @endphp
            @foreach ($productRecords as $productRecord)
                <tr>
                    <td>{{ $productRecord->paymentDate }}</td>
                    <td>{{ $productRecord->vendorName }}</td>
                    <td>{{ $productRecord->price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

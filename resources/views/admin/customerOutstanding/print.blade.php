@extends('admin.layouts.masterPrint')

@section('content')
    <table  id="report-table">
        <caption>Customer Outstandings</caption>
        <thead>
            <tr>
                <th width="20px">Sl</th>
                <th>Cutomer Name</th>
                <th width="80px">Mobile No</th>
                <th width="90px">Invoice No</th>
                <th width="120px">Product Name</th>
                <th width="60px">Sales Amount</th>
                <th width="65px">Collection</th>
                <th width="90px">Outstanding</th>
            </tr>
        </thead>

        <tbody>
            @php
                $sl = 1;
            @endphp
            @foreach ($customerOutstandings as $customerOutstanding)
                <tr>
                    <td>{{ $sl++ }}</td>
                    <td>{{ $customerOutstanding->customerName }}</td>
                    <td>{{ $customerOutstanding->customerPhoneNo }}</td>
                    <td>{{ $customerOutstanding->invoiceNo }}</td>
                    <td>{{ $customerOutstanding->productName }}</td>
                    <td align="right">{{ $customerOutstanding->salesAmount }}</td>
                    <td align="right">
                        @php
                            $collection = 0;
                            if ($customerOutstanding->collection)
                            {
                                $collection = $customerOutstanding->collection;
                            }                           
                        @endphp
                        {{ $collection }}
                    </td>
                    <td align="right">
                        @php
                            $balance = $customerOutstanding->salesAmount;
                            if ($customerOutstanding->collection)
                            {
                                $balance = $customerOutstanding->balance;
                            }                           
                        @endphp
                        {{ $balance }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

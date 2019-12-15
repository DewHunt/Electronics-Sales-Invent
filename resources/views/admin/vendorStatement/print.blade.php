@extends('admin.layouts.masterPrint')

@section('content')
    <table id="report-header">
        <tr>
            <td>Vendor Statement On {{ $fromDate }} To {{ $toDate }}</td>
        </tr>
    </table>

    <div id="pad-bottom"></div>

    <table  id="report-table">
        <thead class="thead-light">
            <tr>
                @php
                    if ($previousBalances)
                    {
                        $previousBalance = $previousBalances->lifting - ($previousBalances->payment + $previousBalances->others);
                    }
                    else
                    {
                        $previousBalance = 0;
                    }                                        
                @endphp
                <th colspan="6" style="text-align: right; font-weight: bold;">Previous Balance</th>
                <th style="text-align: right;">{{ $previousBalance }}</th>
            </tr>
            <tr>
                <th width="20px">Sl</th>
                <th width="100px">Date</th>
                <th>Vendor Name</th>
                <th width="100px">Lifting</th>
                <th width="100px">Payment</th>
                <th width="100px">Others</th>
                <th width="100px">Balance</th>
            </tr>
        </thead>

        <tbody>
            @php
                $sl = 0;
            @endphp
            @foreach ($vendorStatements as $vendorStatement)
                @php
                    $sl++;
                    if ($sl == 1)
                    {
                        $balance = ($previousBalance + $vendorStatement->lifting) - ($vendorStatement->payment + $vendorStatement->others);
                    }
                    else
                    {
                        $balance = $balance - ($vendorStatement->lifting - $vendorStatement->payment - $vendorStatement->others); 
                    }                                        
                @endphp
                <tr>
                    <td>{{ $sl++ }}</td>
                    <td>{{ Date('d-m-Y',strtotime($vendorStatement->date)) }}</td>
                    <td>{{ $vendorStatement->vendorName }}</td>
                    <td style="text-align: right;">{{ $vendorStatement->lifting }}</td>
                    <td style="text-align: right;">{{ $vendorStatement->payment }}</td>
                    <td style="text-align: right;">{{ $vendorStatement->others }}</td>
                    <td style="text-align: right;">{{ $balance }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

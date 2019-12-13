@extends('admin.layouts.masterPrint')

@section('content')
    <table  id="report-table">
        <caption>Customer Statement On {{ $fromDate }} To {{ $toDate }}</caption>
        <thead>
            <tr>
                @php
                    if ($previousBalances)
                    {
                        $previousBalance = $previousBalances->salesAmount - $previousBalances->collection;
                    }
                    else
                    {
                        $previousBalance = 0;
                    }                                        
                @endphp
                <th colspan="5" style="background-color: #778899; text-align: right; font-weight: bold; padding-right: 5px;">Previous Balance</th>
                <td style="text-align: right;">{{ $previousBalance }}</td>
            </tr>
            <tr>
                <th width="20px">Sl</th>
                <th width="70px">Date</th>
                <th>Customer Name</th>
                <th width="70px">Sales</th>
                <th width="80px">Collection</th>
                <th width="70px">Balance</th>
            </tr>
        </thead>

        <tbody>
            @php
                $sl = 0;
                $totalSale = 0;
                $totalCollection = 0;
                $totalBalance = 0;
            @endphp
            @foreach ($customerStatements as $customerStatement)
                @php
                    $sl++;
                    if ($sl == 1)
                    {
                        $balance = $previousBalance + $customerStatement->salesAmount - $customerStatement->collection;
                    }
                    else
                    {
                        $balance = $balance + ($customerStatement->salesAmount - $customerStatement->collection); 
                    }
                    $totalSale += $customerStatement->salesAmount;                                        
                    $totalCollection += $customerStatement->collection;                                        
                    $totalBalance += $balance;                                        
                @endphp
                <tr>
                    <td>{{ $sl }}</td>
                    <td>{{ Date('d-m-Y',strtotime($customerStatement->date)) }}</td>
                    <td>{{ $customerStatement->customerName }}</td>
                    <td style="text-align: right;">{{ $customerStatement->salesAmount }}</td>
                    <td style="text-align: right;">{{ $customerStatement->collection }}</td>
                    <td style="text-align: right;">{{ $balance }}</td>
                </tr>
            @endforeach
        </tbody>

        <tfoot>
            <tr>
                <th class="align-center" colspan="3">Total</th>
                <td class="align-right" width="70px">{{ $totalSale }}</td>
                <td class="align-right" width="80px">{{ $totalCollection }}</td>
                <td class="align-right" width="70px">{{ $totalBalance }}</td>
            </tr>
        </tfoot>
    </table>
@endsection

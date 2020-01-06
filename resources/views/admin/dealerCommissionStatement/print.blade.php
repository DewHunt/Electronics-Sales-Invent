@extends('admin.layouts.masterPrint')

@section('content')
    <table id="report-header">
        <tr>
            <td>Dealer Commission Statements</td>
        </tr>
    </table>

    <div id="pad-bottom"></div>

    <table  id="report-table">
        <thead>
            <tr>
                <th width="20px">Sl</th>
                <th>Dealer Name</th>
                <th>Category</th>
                <th width="110px">Sale Amount</th>
                <th width="130px">Commission Rate</th>
                <th width="100px">Commission</th>
            </tr>
        </thead>

        <tbody>
            @php
                $sl = 1;
                $currentDealerId = 0;
                $totalCommissionAmount = 0;
            @endphp

            @foreach ($dealerCommissionStatements as $dealerCommissionStatement)
                @php
                    $totalCommissionAmount = $totalCommissionAmount + $dealerCommissionStatement->commissionAmount;
                @endphp
                
                @if ($dealerCommissionStatement->dealerId != $currentDealerId)
                    @php
                        $currentDealerId = $dealerCommissionStatement->dealerId;
                        $rowSpan = DB::table('view_dealer_commission_statement')
                            ->whereBetween('view_dealer_commission_statement.date', array($fromDate,$toDate))
                            ->where('dealerId',$dealerCommissionStatement->dealerId)
                            ->count('dealerId');
                    @endphp
                    <tr>
                        <td>{{ $sl++ }}</td>
                        <td rowspan="{{ $rowSpan }}">
                            <p><b>Name:</b> {{ $dealerCommissionStatement->dealerName }}</p>
                            <p><b>Phone:</b> {{ $dealerCommissionStatement->dealerPhone }}</p>
                            <p><b>Address:</b> {{ $dealerCommissionStatement->dealerAddress }}</p>
                        </td>
                        <td>{{ $dealerCommissionStatement->categoryName }}</td>
                        <td>{{ $dealerCommissionStatement->saleAmount }}</td>
                        <td>{{ $dealerCommissionStatement->commissionRate }}</td>
                        <td>{{ $dealerCommissionStatement->commissionAmount }}</td>
                    </tr>
                @else
                <tr>
                    <td>{{ $sl++ }}</td>
                    <td>{{ $dealerCommissionStatement->categoryName }}</td>
                    <td>{{ $dealerCommissionStatement->saleAmount }}</td>
                    <td>{{ $dealerCommissionStatement->commissionRate }}</td>
                    <td>{{ $dealerCommissionStatement->commissionAmount }}</td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <div id="pad-bottom"></div>

    <table  id="report-table">
        <tfoot>
            <tr>
                <th style="text-align: right;"><b>Total Commission Amount : </b></th>
                <td style="text-align: right;">{{ $totalCommissionAmount }}</td>
            </tr>
        </tfoot>
    </table>
@endsection

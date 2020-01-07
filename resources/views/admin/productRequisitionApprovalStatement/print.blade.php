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
                <th width="200px">Dealer Name</th>
                <th width="200px">Product Name</th>
                <th width="200px">Model</th>
                <th width="50px">Qty</th>
                <th width="90px">Approve Qty</th>
            </tr>
        </thead>

        <tbody>
            @php
                $sl = 1;
                $currentDealerId = 0;
                // $totalCommissionAmount = 0;
            @endphp

            @foreach ($requisitionApprovalStatements as $requisitionApprovalStatement)                
                @if ($requisitionApprovalStatement->dealerId != $currentDealerId)
                    @php
                        $currentDealerId = $requisitionApprovalStatement->dealerId;
                        $rowSpan = DB::table('view_product_requisition_approval_statement')
                            ->whereBetween('date', array($fromDate,$toDate))
                            ->where('dealerId',$requisitionApprovalStatement->dealerId)
                            ->count('dealerId');
                    @endphp
                    <tr>
                        <td>{{ $sl++ }}</td>
                        <td rowspan="{{ $rowSpan }}">{{ $requisitionApprovalStatement->dealerName }}</td>
                        <td>{{ $requisitionApprovalStatement->productName }}</td>
                        <td>{{ $requisitionApprovalStatement->productModelNo }}</td>
                        <td align="right">{{ $requisitionApprovalStatement->requisitionQty }}</td>
                        <td align="right">{{ $requisitionApprovalStatement->approvedQty }}</td>
                    </tr>
                @else
                    <tr>
                        <td>{{ $sl++ }}</td>
                        <td>{{ $requisitionApprovalStatement->productName }}</td>
                        <td>{{ $requisitionApprovalStatement->productModelNo }}</td>
                        <td align="right">{{ $requisitionApprovalStatement->requisitionQty }}</td>
                        <td align="right">{{ $requisitionApprovalStatement->approvedQty }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <div id="pad-bottom"></div>

{{--     <table  id="report-table">
        <tfoot>
            <tr>
                <th style="text-align: right;"><b>Total Commission Amount : </b></th>
                <td style="text-align: right;">{{ $totalCommissionAmount }}</td>
            </tr>
        </tfoot>
    </table> --}}
@endsection

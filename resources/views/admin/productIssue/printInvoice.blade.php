@extends('admin.layouts.masterPrint')

@section('custome-css')
    <style>
        #report-table td, #report-table th {
            border: 1px solid #ddd;
        }

        #report-table tbody td{
            vertical-align: top;
        }

        #invoice-table{
            width: 100%;
            border-collapse: collapse;
        }

        #invoice-table td{
            width: 50%;
            border: 0px solid black;
        }

        #invoice-header{
            background-color: lightgray;
            width: 100%;
            padding: 5px;
            text-align: center;
            font-weight: bold;
            font-size: 20px;
        }

        #invoice-footer{
            background-color: lightgray;
            width: 100%;
        }

        #invoice-footer th{
            border: 0px solid white;
            padding: 5px;
            text-align: right;
            font-size: 14px;
            width: 180px;
        }

        #invoice-footer td{
            border: 1px solid black;
            padding: 5px;
        }
    </style>
@endsection

@section('content')
    <table id="invoice-header">
        <tr>
            <td>Invoice</td>
        </tr>
    </table>

    <div id="pad-bottom"></div>

    <table width="100%">
        <tbody>
            <tr>
                <td width="105px"><b>Issue No</b></td>
                <td width="10px"><b>:</b></td>
                <td>#{{ @$productIssue->issue_no }}</td>

                <td align="right">{{date('d-m-Y')}}</td>
                <td align="right" width="10px"><b>:</b></td>
                <td align="right" width="105px"><b>Print Date</b></td>
            </tr>
            <tr>
                <td width="105px"><b>Dealer Name</b></td>
                <td width="10px"><b>:</b></td>
                <td>{{ $productIssue->dealerName }}</td>

                <td align="right">{{ $productIssue->dealerCode }}</td>
                <td align="right" width="10px"><b>:</b></td>
                <td align="right" width="105px"><b>Dealer Code</b></td>
            </tr>
            <tr>
                <td width="105px"><b>Upazila</b></td>
                <td width="10px"><b>:</b></td>
                <td>{{ $productIssue->upazilaEnglishName }}</td>

                <td align="right">{{ $productIssue->dealerMobile }}</td>
                <td align="right" width="10px"><b>:</b></td>
                <td align="right" width="105px"><b>Phone</b></td>
            </tr>
            <tr>
                <td width="105px"><b>Address</b></td>
                <td width="10px"><b>:</b></td>
                <td colspan="4">{{ $productIssue->dealerAddress }}</td>
            </tr>
        </tbody>
    </table>

    <div id="pad-bottom"></div>

    <table id="report-table">
        <thead>
            <tr>
                <th width="20px">SL#</th>
                <th>Name</th>
                <th width="135px">Model</th>
                <th width="90px">Serial No</th>
                <th width="40px">Qty</th>
                <th width="60px">Amount</th>
            </tr>
        </thead>

        <tbody>
            @php
                $sl = 1;
            @endphp

            @foreach ($productIssueLists as $productIssueList)
                <tr>
                    <td>{{ $sl++ }}</td>
                    <td>{{ $productIssueList->productName }}</td>
                    <td>{{ $productIssueList->model_no }}</td>
                    <td>{{ $productIssueList->serial_no }}</td>
                    <td align="right">{{ $productIssueList->qty }}</td>
                    <td align="right">{{ $productIssueList->price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div id="pad-bottom"></div>

    <table id="invoice-footer">
        <tbody>
            <tr>
                <th>Total Price Amount : </th>
                <td align="right">{{ $productIssue->total_amount }}</td>
            </tr>
            <tr>
                <th>Total Payable Amount : </th>
                <td align="right">{{ $productIssue->total_amount }}</td>
            </tr>
            <tr>
                <th>In Words : </th>
                @php
                    $inWords = \App\HelperClass::numberToWords($productIssue->total_amount);
                @endphp
                <td>{{ $inWords }} Taka Only.</td>
            </tr>
        </tbody>
    </table>

    <div style="padding-bottom: 60px;"></div>

    <table id="invoice-table">
        <tr>
            <td>
                <span><h3 class="overline">Receive By</h3></span>
            </td>
            <td align="right">
                <span>
                    <span><h3 class="overline">Prepaired By</h3></span>
                </span>
            </td>
        </tr>
    </table>
@endsection
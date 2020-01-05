@extends('admin.layouts.masterPrint')

@section('custome-css')
    <style>
        #report-table td, #report-table th {
            border: 1px solid #ddd;
        }

        #report-table tbody td{
            vertical-align: top;
        }

        #chalan-table{
            width: 100%;
            border-collapse: collapse;
        }

        #chalan-table td{
            width: 50%;
            border: 0px solid black;
        }

        #chalan-header{
            background-color: lightgray;
            width: 100%;
            padding: 5px;
            text-align: center;
            font-weight: bold;
            font-size: 20px;
        }

        #chalan-footer{
            background-color: lightgray;
            width: 100%;
        }

        #chalan-footer th{
            border: 0px solid white;
            padding: 5px;
            text-align: right;
            font-size: 14px;
            width: 180px;
        }

        #chalan-footer td{
            border: 1px solid black;
            padding: 5px;
        }
    </style>
@endsection

@section('content')
    <table id="chalan-header">
        <tr>
            <td>Chalan</td>
        </tr>
    </table>

    <div id="pad-bottom"></div>

    <table id="chalan-table">
    </table>

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
                <th width="80px">Serial No</th>
                <th width="40px">Qty</th>
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
                </tr>
            @endforeach
        </tbody>
    </table>


    <div style="padding-bottom: 60px;"></div>

    <table id="chalan-table">
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
@extends('admin.layouts.masterPrint')

@section('custome-css')
    <style>
        table{
            font-family: Times, "Times New Roman", serif;
        }
        .moneyReceiptHeader{
            font-size: 13px;
        }

        .bottom{
            border-bottom: 1px solid #000000;
            /*padding: 10px;*/
            vertical-align: text-bottom;
        }

        .moneyReceiptAmountTable{
            border-collapse: collapse;
        }

        .moneyReceiptAmountTable td{
            border: 1px solid #333;
            padding: 5px;
        }
    </style>
@endsection

@php
    use App\Product;
    use App\ShowroomSetup;
    $collectionDate = Date('d-m-Y',strtotime($cashCollection->collection_date));
@endphp

@section('content')
    <caption style="text-decoration: none;"><h2>Money Receipt</h2></caption>
    <table width="100%">
        <tr>
            <td width="50%">
                <span class="moneyReceiptHeader"><b>Receipt No</b> #{{$cashCollection->collection_no}}</span>
                <br>
                <span class="moneyReceiptHeader"><b>Invoice No</b> #{{$invoice->invoice_no}}</span>
            </td>
            <td width="50%" align="right">
                <span class="moneyReceiptHeader">
                    <b>Collection Date</b> : {{$collectionDate}}
                    <br>
                    <b>Print Date</b> : {{date('d-m-Y')}}
                </span>
            </td>
        </tr>
    </table>

    <div id="pad-bottom"></div>

    <table border="0">
        <tr>
            <td width="160px"><strong>Cash Received From</strong> </td>
            <td class="bottom" width="365px">{{$customer->name}}</td>
            <td width="40px"><strong>BDT</strong> </td>
            <td class="bottom" width="190px">{{$cashCollection->collection_amount}}</td>
        </tr>
    </table>

    <div id="pad-bottom"></div>

    <table>
        <tr>
            <td width="40px"><strong>For</strong> </td>
            <td class="bottom" width="780px">{{$product->name}}({{$product->code}})</td>
        </tr>
    </table>

    <div id="pad-bottom"></div>
    <div id="pad-bottom"></div>

    <table width="100%">
        <tr>
            <td width="60%">
                <table class="moneyReceiptAmountTable">
                    <tr>
                        <td width="200px" align="right">Total Invoice Amount</td>
                        <td width="150px" align="right">{{$cashCollection->invoice_amount}}</td>
                    </tr>
                    <tr>
                        <td align="right">Received Amount</td>
                        <td align="right">{{$cashCollection->collection_amount}}</td>
                    </tr>

                    <tr>
                        <td align="right">Due Amount</td>
                        <td align="right">{{$cashCollection->current_due}}</td>
                    </tr>
                </table>
            </td>
            <td width="40%">
                <table width="500px" style="padding-bottom: -80px;">
                    <tr>
                        <td style="border-bottom: 1px solid #333;"></td>
                    </tr>
                    <tr>
                        <td align="center">Received By</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
@endsection
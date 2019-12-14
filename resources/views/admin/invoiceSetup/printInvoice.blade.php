@extends('admin.layouts.masterPrint')

@section('custome-css')
    <style>
        #report-table td, #report-table th {
            border: 1px solid #ddd;
        }

        #report-table tbody td{
            height: 500px;
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

@php
    $invoiceDate = date('d-m-Y',strtotime($invoice->created_at));
@endphp

@section('content')
    <table id="invoice-header">
        <tr>
            <td>Invoice</td>
        </tr>
    </table>

    <div id="pad-bottom"></div>

    <table width="100%" border="0">
        <tbody>
            <tr>
                <td align="right" colspan="2">
                    <span style="border-bottom: 1px solid black;"><b>Invoice To</b></span>
                </td>
            </tr>
            <tr>
                <td>
                    <table width="100%" border="0">
                        <tr>
                            <td width="105px"><span><b>Invoice No </b></span></td>
                            <td width="10px">:</td>
                            <td>{{ @$invoice->invoice_no }}</td>
                        </tr>
                        <tr>
                            <td width="105px"><span><b>Invoice Date </b></span></td>
                            <td width="10px">:</td>
                            <td> {{ @$invoiceDate }}</td>
                        </tr>
                        <tr>
                            <td width="105px"><span><b>Print Date </b></span></td>
                            <td width="10px">:</td>
                            <td>{{date('d-m-Y')}}</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table width="100%" border="0">
                        <tr>
                            <td align="right"><span>{{ $invoice->customerName }}</span></td>
                        </tr>
                        <tr>
                            <td align="right">{{ $invoice->customerPhoneNo }}</td>
                        </tr>
                        <tr>
                            <td align="right">{{ $invoice->customer_product_usage_address }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <div id="pad-bottom"></div>

    <table id="report-table">
        <thead>
            <tr>
                <th width="20px">SL#</th>
                <th style="text-align: left;">Name</th>
                <th width="80px">Model</th>
                <th width="80px">Serial No</th>
                <th width="40px">Qty</th>
                <th width="70px">Rate</th>
                <th width="70px">Price</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>1</td>
                <td>{{ $invoice->productName }}</td>
                <td>{{ $invoice->product_serial_no }}</td>
                <td>{{ $invoice->customer_product_model }}</td>
                <td align="right">{{ $invoice->qty }}</td>
                <td align="right">{{ $invoice->customer_product_price }}</td>
                <td align="right">{{ $invoice->qty * $invoice->customer_product_price }}</td>
            </tr>
        </tbody>
    </table>

    <div id="pad-bottom"></div>

    <table id="invoice-footer">
        <tbody>
            <tr>
                <th>Total Price Amount : </th>
                <td align="right">{{ $invoice->customer_product_price }}</td>
            </tr>
            <tr>
                <th>Total Payable Amount : </th>
                <td align="right">{{ $invoice->qty * $invoice->customer_product_price }}</td>
            </tr>
            <tr>
                <th>In Words : </th>
                @php
                    $inWords = \App\HelperClass::numberToWords($invoice->qty * $invoice->customer_product_price);
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
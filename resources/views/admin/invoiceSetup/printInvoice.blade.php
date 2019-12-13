@extends('admin.layouts.masterPrint')

@section('custome-css')
    <style>
        #report-table td, #report-table th {
            border: 1px solid #ddd;
        }

        #invoice-table{
            width: 100%;
            border-collapse: collapse;
        }

        #invoice-table td{
            width: 50%;
            border: 0px solid black;
        }
    </style>
@endsection

@php
    $invoiceDate = date('d-m-Y',strtotime($invoice->created_at));
@endphp

@section('content')
    <table id="invoice-table">
        <tr>
            <td colspan="2" align="right">
                <span style="border-bottom: 1px solid black;"><b>Invoice To</b></span>
            </td>
        </tr>
        <tr>
            <td>
                <span><b>Invoice No</b></span> #{{@$invoice->invoice_no}}
            </td>
            <td align="right">
                <span>{{ $invoice->customerName}}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span><b>Invoice Date : </b></span> {{@$invoiceDate}}
            </td>
            <td align="right">
                <span>{{ $invoice->customerPhoneNo}}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span><b>Invoice Print Date : </b></span> {{date('d-m-Y')}}
            </td>
            <td align="right">
                <span>{{$invoice->customer_product_usage_address }}</span>
            </td>
        </tr>
    </table>

    <div id="pad-bottom"></div>

    <table id="report-table">
        <thead>
            <tr>
                <th width="140px" style="text-align: left;">Showroom</th>
                <th>Code</th>
                <th style="text-align: left;">Name</th>
                <th>Price</th>
                <th>Model</th>
                <th>Color</th>
                <th>Warranty</th>
                <th>Purchase Date</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>{{$invoice->showroomName}}</td>
                <td>{{$invoice->productCode}}</td>
                <td>{{$invoice->productName}}</td>
                <td>{{$invoice->customer_product_price}}</td>
                <td>{{$invoice->customer_product_model}}</td>
                <td>{{$invoice->customer_product_color}}</td>
                <td>{{$invoice->customer_product_waranty}} Years</td>
                <td>{{$invoice->customer_product_purchase_date}}</td>
            </tr>
        </tbody>
    </table> 

    
@endsection
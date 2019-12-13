@extends('admin.layouts.masterPrint')

@section('custome-css')
    <style>
        #report-table td, #report-table th {
            border: 1px solid #ddd;
        }

        #chalan-table{
            width: 100%;
            border-collapse: collapse;
        }

        #chalan-table td{
            width: 50%;
            border: 0px solid black;
        }
    </style>
@endsection

@php
    use App\Product;
    use App\ShowroomSetup;
    $invoiceDate = date('d-m-Y',strtotime($invoice->created_at));
    $chalanNo = str_replace('inv', 'chalan', $invoice->invoice_no);
@endphp

@section('content')
    <table id="chalan-table">
        <tr>
            <td>
                <span><b>Chanaln No</b></span> #{{@$chalanNo}}   
            </td>

            <td align="right">               
                <span><b>Chalan Print Date : </b></span> {{date('d-m-Y')}}
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
                <td>{{$invoice->customer_product_model}}</td>
                <td>{{$invoice->customer_product_color}}</td>
                <td>{{$invoice->customer_product_waranty}} Years</td>
                <td>{{$invoice->customer_product_purchase_date}}</td>
            </tr>
        </tbody>
    </table> 

    
@endsection
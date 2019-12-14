@extends('admin.layouts.masterPrint')

@section('custome-css')
    <style>
        #report-table td, #report-table th {
            border: 1px solid #ddd;
        }

        #report-table tbody td{
            height: 630px;
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

{{-- @section('custome-css')
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
@endsection --}}

@php
    $chalanNo = str_replace('inv', 'chalan', $invoice->invoice_no);
@endphp

@section('content')
    <table id="chalan-header">
        <tr>
            <td>Chalan</td>
        </tr>
    </table>

    <div id="pad-bottom"></div>

    <table id="chalan-table">
        <tr>
            <td>
                <span><b>Chanaln No</b></span> #{{@$chalanNo}}   
            </td>

            <td align="right">               
                <span><b>Print Date : </b></span> {{date('d-m-Y')}}
            </td>
        </tr>
    </table>

    <div id="pad-bottom"></div>

    <table id="report-table">
        <thead>
            <tr>
                <th width="20px">SL#</th>
                <th>Name</th>
                <th width="80px">Model</th>
                <th width="80px">Serial No</th>
                <th width="40px">Qty</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>1</td>
                <td>{{ $invoice->productName }}</td>
                <td>{{ $invoice->product_serial_no }}</td>
                <td>{{ $invoice->customer_product_model }}</td>
                <td align="right">{{ $invoice->qty }}</td>
            </tr>
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
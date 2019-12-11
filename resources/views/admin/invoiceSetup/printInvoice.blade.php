@extends('admin.layouts.masterPrint')

@section('custome-css')
    <style>
        #report-table td, #report-table th {
            border: 0px solid #ddd;
           /* padding: 5px;*/
        }

        #up-header{
            background-color: white;
        }
    </style>
@endsection

@php
    use App\Product;
    use App\ShowroomSetup;
    $invoiceDate = date('d-m-Y',strtotime($invoice->created_at));
@endphp

@section('content')
    <table width="100%">
        <tr>
            <td width="50%">
                <div>
                    <span><b>Invoice No</b></span> #{{@$invoice->invoice_no}}
                </div>

                <div>
                    <span>Invoice Date : </span> {{@$invoiceDate}}
                </div>

                <div>
                    <span>Invoice Print Date : </span> {{date('d-m-Y')}}
                </div>
                
            </td>

            <td width="50%" align="right">
                <div>
                    <span style="border-bottom: 1px solid black;"><b>Invoice To</b></span>
                </div>
                <br>
                <div>
                    <span>{{ $customer->name}}</span>
                </div>
                <div>
                    <span>{{ $customer->phone_no}}</span>
                </div>

                <div>
                    <span>{{$invoice->customer_product_usage_address }}</span>
                </div>
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
                <td>{{$showRoom->name}}</td>
                <td>{{$productInfo->code}}</td>
                <td>{{$productInfo->name}}</td>
                <td>{{$invoice->customer_product_price}}</td>
                <td>{{$invoice->customer_product_model}}</td>
                <td>{{$invoice->customer_product_color}}</td>
                <td>{{$invoice->customer_product_waranty}} Years</td>
                <td>{{$invoice->customer_product_purchase_date}}</td>
            </tr>
        </tbody>
    </table> 

    
@endsection